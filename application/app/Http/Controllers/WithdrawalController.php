<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Mail\Withdrawal\withdrawalRequestUserEmail;
use App\Mail\Withdrawal\withdrawalRequestAdminNotificationEmail;
use App\Mail\Withdrawal\withdrawalCompletedUserNotificationEmail;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\WithdrawalMethod;

class WithdrawalController extends Controller
{
    public function index(Request $request){
    	$withdrawals = Withdrawal::with(['Method','Status'])->where('user_id', Auth::user()->id)->orderby('id', 'desc')->paginate(10);
    	return view('withdrawals.index')
    	->with('withdrawals', $withdrawals);

    }

    public function getWithdrawalRequestForm(Request $request, $method_id = false){

    	 $methods = Auth::user()->currentCurrency()->WithdrawalMethods()->get();
        if ($method_id) {

            $current_method = WithdrawalMethod::where('id', $method_id)->first();

            if ($current_method == null) {
                dd('please contact admin to link a withdrawal method to '.Auth::user()->currentCurrency()->name.' currency');
            }
        }else{
            if (isset($methods[0]) ) {
               $current_method = $methods[0];
            } else{
                dd('please contact admin to link a withdraw method to '.Auth::user()->currentCurrency()->name.' currency');
            }
        }

        
        $currencies = Currency::where('id' , '!=', Auth::user()->currentCurrency()->id)->get();

    	return view('withdrawals.withdrawalRequestForm')
    	->with('current_method', $current_method)
        ->with('currencies', $currencies)
    	->with('methods', $methods);
    }

    public function makeRequest(Request $request){
        
        $wallet = Wallet::where('user_id', Auth::user()->id)->where('currency_id', Auth::user()->currentCurrency()->id)->first();

        $this->validate($request, [
            'withdrawal_method' => 'integer|exists:withdrawal_methods,id',
            'platform_id' => 'required',
            'withdrawal_currency'   =>  'required|integer|exists:currencies,id',
            'amount'   =>  'required|numeric|between:5,'.(float)$wallet->amount,
        ]);

        if ( Auth::user()->account_status == 0 ) {
            flash(__('Your account is under a withdrawal request review proccess. Please wait until your request is complete in a few minutes to continue with your activities.') , 'info');
             return  back();
        }

        $current_method = WithdrawalMethod::findOrFail($request->withdrawal_method);
        

        $fee = (($current_method->percentage_fee/100)* $request->amount) + $current_method->fixed_fee ; 
    	
        $withdrawal = Withdrawal::create([
            'user_id'   =>  Auth::user()->id,
            'transaction_state_id'  =>  3,
            'withdrawal_method_id'  =>  $request->withdrawal_method,
            'platform_id'  =>  $request->platform_id,
            'send_to_platform_name' =>  $current_method->method_identifier_field__name,
            'gross' =>  $request->amount,
            'fee'   =>  $fee,
            'currency_id'   =>  Auth::user()->currentCurrency()->id,
            'currency_symbol'   =>  Auth::user()->currentCurrency()->symbol,
            'wallet_id' => $wallet->id,
            'net'   =>  $request->amount - $fee,
        ]);

        // Send Alert to Admin 
        Mail::send(new withdrawalRequestAdminNotificationEmail($withdrawal, Auth::user()));

        //Send new deposit request notification Mail to user
        Mail::send(new withdrawalRequestUserEmail( $withdrawal, Auth::user()));

        return redirect(route('withdrawal.index'));
    }

    public function confirmWithdrawal(Request $request){

        
        if (!Auth::user()->isAdministrator()) {
            abort (404);
        }

        $withdrawal = Withdrawal::with('Method')->findOrFail($request->id);

        if ($withdrawal->transaction_state_id == 1 ) {
            flash(__('Transaction Already completed !'), 'info' );
            //return redirect(url('/').'/admin/withdrawals/'.$withdrawal->id);

            return back();
        }

        $user = User::findOrFail($request->user_id);

        $wallet = Wallet::where('user_id', $user->id)->where('currency_id',$user->currentCurrency()->id)->first();

        if ($wallet->amount < $withdrawal->gross) {
            flash('User doesen\'t have enought funds to withdraw '.$withdrawal->gross.' $', 'danger' );

            return back();
        }

        $wallet->amount = (double)$wallet->amount - (double)$withdrawal->gross;

        $user->RecentActivity()->save($withdrawal->Transactions()->create([
            'user_id' => $user->id,
            'entity_id'   =>  $user->id,
            'entity_name' =>  $withdrawal->Method->name,
            'transaction_state_id'  =>  1, // waiting confirmation
            'money_flow'    => '-',
            'activity_title'    =>  'Withdrawal',
            'balance'   =>   $wallet->amount,
            'thumb' =>  $withdrawal->Method->thumb,
            'gross' =>  $withdrawal->gross,
            'fee'   =>  $withdrawal->fee,
            'net'   =>  $withdrawal->net,
            'currency_id'   =>  $withdrawal->currency_id,
            'currency_symbol'   =>  $withdrawal->currency_symbol,
        ]));

        
        $withdrawal->transaction_state_id = 1;

        $withdrawal->save();
        $user->account_status = 1;
        $wallet->save();
        $user->save();

        //Send Notification to User
        Mail::send(new withdrawalCompletedUserNotificationEmail($withdrawal, $user));
        
        return redirect(url('/').'/admin/withdrawals/'.$withdrawal->id);
        
    }
}
