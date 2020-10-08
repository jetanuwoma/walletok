<?php

namespace App\Http\Controllers;
use Auth;
use Storage;
use App\User;
use App\Models\Send;
use App\Models\Currency;
use App\Models\Receive;
use App\Models\Transaction;
use Validator;
use Illuminate\Http\Request;

class MoneyTransferController extends Controller
{
    public function sendMoneyForm(Request $request){
        $currencies = Currency::where('id' , '!=', Auth::user()->currentCurrency()->id)->get();
    	return view('sendmoney.index')->with('currencies', $currencies);
    }

    public function requestMoneyForm(Request $request){
        $currencies = Currency::where('id' , '!=', Auth::user()->currentCurrency()->id)->get();
        return view('requestmoney.index')->with('currencies', $currencies);
    }

    public function sendMoney(Request $request){
        $currency = Currency::find(Auth::user()->currency_id);

        $auth_wallet = Auth::user()->walletByCurrencyId($currency->id);

        if($currency->symbol == '(BTC)') {
            if ($request->amount <= 0) {
                flash(__('Please insert an amount greater than 0'),'danger');
                    return back();
            }

            $this->validate($request, [
                'amount'    =>  'required|numeric|between:0,'.Auth::user()->getBtcAmount(),
                'address'   =>  'required|string',
            ]);
        }

        // if($currency->symbol != '(BTC)' ) {
        //     $this->validate($request, [
        //         'amount'    =>  'required|numeric|between:0,'.Auth::user()->currentWallet()->amount,
        //         'wallet_number' =>  'required|numer|exists:users,wallet_number',
        //     ]);
        // }
       

        if((boolean)$currency == false ){
          flash(__('Wops, something went wrong... looks like we do not support this currency. please contact support if this error persists !'), 'danger');
            return back();
        }

        if ( Auth::user()->account_status == 0 ) {
            flash(__('Your account is under a withdrawal request review proccess. please wait for a few minutes and try again') , 'info');
             return  back();
        }


        // if ($request->wallet_number == Auth::user()->wallet_number && $currency->symbol == '(BTC)') {
        //     flash(__('You can\'t send money to the same account you are in') , 'danger');
        //     return  back();
        // } 

       

        if($currency->symbol == '(BTC)') {
            $send = Send::create([
                'user_id'   =>  Auth::user()->id,
                'transaction_state_id'  =>  3, // waiting confirmation 
                'gross'    =>  $request->amount,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'fee'   =>  0,
                'net'   =>  0,
                 'description' => $request->address,

            ]);
            Auth::user()->RecentActivity()->save($send->Transactions()->create([
                'user_id' =>  Auth::user()->id,
                'entity_id'   =>  $send->id,
                'entity_name' =>   Auth::user()->name,
                'transaction_state_id'  =>  3, // waiting confirmation
                'money_flow'    => '-',
                'thumb' =>   Auth::user()->avatar,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Payment Sent',
                'gross' =>  $send->gross,
                'fee'   =>  $send->fee,
                'net'   =>  $send->net
            ]));
            $send->save();
            flash('Bitcoin transfer request has been sent for processing', 'success');
        } else {
            if ($request->payment_type == 'User Wallet') {
                if (filter_var($request->account, FILTER_VALIDATE_INT)) {
                    $user = User::where('wallet_number', $request->account)->first();
                } else {
                    flash('No user found with that account number' , 'danger');
                    return  back();
                }

                $send_fee = 0; //free to send money
                $receive_fee = ((setting('money-transfers.mt_percentage_fee')/100)* (double)$request->amount) + setting('money-transfers.mt_fixed_fee') ;
                if ( ($request->amount - $receive_fee) < 0 ) {
                    flash(__('The minimum amount to send is').' <strong>'.abs($request->amount - $receive_fee) .'</strong>', 'danger');
                    return  back();
                }

                $receive = Receive::create([
                    'user_id'   =>   $user->id,
                    'from_id'        => Auth::user()->id,
                    'transaction_state_id'  =>  1, // waiting confirmation
                    'gross'    =>  $request->amount,
                    'currency_id' =>  $currency->id,
                    'currency_symbol' =>  $currency->symbol,
                    'fee'   =>  $receive_fee,
                    'net'   =>  $request->amount - $receive_fee,
                    'description'   =>  $request->description,
                    'send_id'    =>  0
                ]);

                $send = Send::create([
                    'user_id'   =>  Auth::user()->id,
                    'to_id'        =>  $user->id,
                    'transaction_state_id'  =>  1, // waiting confirmation 
                    'gross'    =>  $request->amount,
                    'currency_id' =>  $currency->id,
                    'currency_symbol' =>  $currency->symbol,
                    'fee'   =>  $send_fee,
                    'net'   =>  $request->amount - $send_fee,
                    'description'   =>  $request->description,
                    'receive_id'    =>  $receive->id
                ]);

                $receive->send_id = $send->id;
            $receive->save();
    
            $user->RecentActivity()->save($receive->Transactions()->create([
                'user_id' => $receive->user_id,
                'entity_id'   =>  $receive->id,
                'entity_name' =>  Auth::user()->name,
                'transaction_state_id'  =>  1, // waiting confirmation
                'money_flow'    => '+',
                'currency_id' =>  $currency->id,
                'thumb' =>  Auth::user()->avatar,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Payment Received',
                'gross' =>  $receive->gross,
                'fee'   =>  $receive->fee,
                'net'   =>  $receive->net,
            ]));
    
            Auth::user()->RecentActivity()->save($send->Transactions()->create([
                'user_id' =>  Auth::user()->id,
                'entity_id'   =>  $send->id,
                'entity_name' =>  $user->name,
                'transaction_state_id'  =>  1, // waiting confirmation
                'money_flow'    => '-',
                'thumb' =>  $user->avatar,
                'currency_id' =>  $currency->id,
                'currency_symbol' =>  $currency->symbol,
                'activity_title'    =>  'Payment Sent',
                'gross' =>  $send->gross,
                'fee'   =>  $send->fee,
                'net'   =>  $send->net
            ]));

            $user->setBalanceAttribute($user->currentWalletBalance() + $request->amount);
            Auth::user()->setBalanceAttribute(Auth::user()->currentWalletBalance() - $request->amount);
            flash(__('Your money has been successfully sent'), 'success');
           
        } else {
                $send = Send::create([
                    'user_id'   =>  Auth::user()->id,
                    'to_id'        =>  Auth::user()->id,
                    'transaction_state_id'  =>  3, // waiting confirmation 
                    'gross'    =>  $request->amount,
                    'currency_id' =>  $currency->id,
                    'currency_symbol' =>  $currency->symbol,
                    'fee'   =>  0,
                    'net'   =>  $request->amount - 0,
                    'description'   =>  $request->description,
                    'receive_id'    =>  0
                ]);

                Auth::user()->RecentActivity()->save($send->Transactions()->create([
                    'user_id' =>  Auth::user()->id,
                    'entity_id'   =>  $send->id,
                    'entity_name' =>  'Paypal',
                    'transaction_state_id'  =>  3, // waiting confirmation
                    'money_flow'    => '-',
                    'thumb' =>  Auth::user()->avatar,
                    'currency_id' =>  $currency->id,
                    'currency_symbol' =>  $currency->symbol,
                    'activity_title'    =>  'Payment request to '. $request->paypal,
                    'gross' =>  $send->gross,
                    'fee'   =>  $send->fee,
                    'net'   =>  $send->net
                ]));

            }
           
            flash(__('Your Paypay withdrawal request has been sent for processing'), 'success');   

        }
        

        
        return  redirect(route('home'));

    }

    public function requestMoney(Request $request){

        if ($request->amount <= 0) {
            flash(__('Please insert an amount greater than 0'),'danger');
                return back();
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
          
            $this->validate($request, [
                'amount'    =>  'required|numeric|between:0,'.Auth::user()->currentWallet()->amount,
                'description'   =>  'required|string',
                'email' =>  'required|email|exists:users,email',
            ]);

        } else {
           
            $this->validate($request, [
                'amount'    =>  'required|numeric|between:0,'.Auth::user()->currentWallet()->amount,
                'description'   =>  'required|string',
                
            ]);

            $valid_user = User::where('name', $request->email)->first();



            if (is_null($valid_user)) {

                flash(__('The Username '). $request->email .__(' is invalid'), 'danger');
                return back();
            }
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email)->first();
        }else{
            $user = $valid_user ;
        }

        

        $currency = Currency::find(Auth::user()->currency_id);

        $auth_wallet = $user->walletByCurrencyId($currency->id);

        if((boolean)$currency == false ){
          flash(__('Wops, something went wrong... looks like we do not support this currency. please contact support if this error persists !'), 'danger');
            return back();
        }

        if ( Auth::user()->account_status == 0 ) {
            flash( $user->name . __(' account is under a withdrawal request review proccess. please wait for a few minutes and try again') , 'info');
             return  back();
        }


        if ($request->email == Auth::user()->email) {
            flash(__('You can\'t request money to the same account you are in') , 'danger');
            return  back();
        } 

        if ($request->amount > $auth_wallet->amount) {
            flash( $user->name . __(' has insufficient funds to send').' <strong>'.$request->amount.__('to'). __('you') .'</strong>', 'danger');
            return  back();
        }

        // if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
        //     $user = User::where('email', $request->email)->first();
        // }else{
        //     $user = $valid_user ;
        // }
        
        $send_fee = 0; //free to send money
        $receive_fee = ((setting('money-transfers.mt_percentage_fee')/100)* (double)$request->amount) + setting('money-transfers.mt_fixed_fee') ;

        if ( ($request->amount - $receive_fee) < 0 ) {
            flash(__('The minimum amount to send is').' <strong>'.abs($request->amount - $receive_fee) .'</strong>', 'danger');
            return  back();
        }

        $receive = Receive::create([
            'user_id'   =>   Auth::user()->id,
            'from_id'        => $user->id,
            'transaction_state_id'  =>  3, // waiting confirmation
            'gross'    =>  $request->amount,
            'currency_id' =>  $currency->id,
            'currency_symbol' =>  $currency->symbol,
            'fee'   =>  $receive_fee,
            'net'   =>  $request->amount - $receive_fee,
            'description'   =>  $request->description,
            'send_id'    =>  0
        ]);

        $send = Send::create([
            'user_id'   =>  $user->id,
            'to_id'        =>  Auth::user()->id,
            'transaction_state_id'  =>  3, // waiting confirmation 
            'gross'    =>  $request->amount,
            'currency_id' =>  $currency->id,
            'currency_symbol' =>  $currency->symbol,
            'fee'   =>  $send_fee,
            'net'   =>  $request->amount - $send_fee,
            'description'   =>  $request->description,
            'receive_id'    =>  $receive->id
        ]);

        $receive->send_id = $send->id;
        $receive->save();

        Auth::user()->RecentActivity()->save($receive->Transactions()->create([
            'user_id' => $receive->user_id,
            'entity_id'   =>  $receive->id,
            'entity_name' =>  Auth::user()->name,
            'transaction_state_id'  =>  3, // waiting confirmation
            'money_flow'    => '+',
            'currency_id' =>  $currency->id,
            'thumb' =>  Auth::user()->avatar,
            'currency_symbol' =>  $currency->symbol,
            'activity_title'    =>  'Payment Received',
            'gross' =>  $receive->gross,
            'fee'   =>  $receive->fee,
            'net'   =>  $receive->net,
        ]));

        $user->RecentActivity()->save($send->Transactions()->create([
            'user_id' =>  Auth::user()->id,
            'entity_id'   =>  $send->id,
            'entity_name' =>  $user->name,
            'transaction_state_id'  =>  3, // waiting confirmation
            'money_flow'    => '-',
            'thumb' =>  $user->avatar,
            'currency_id' =>  $currency->id,
            'currency_symbol' =>  $currency->symbol,
            'activity_title'    =>  'Payment Sent',
            'gross' =>  $send->gross,
            'fee'   =>  $send->fee,
            'net'   =>  $send->net
        ]));
        
        return  redirect(route('home'));

    }


    public function sendMoneyConfirm(Request $request){
        $this->validate($request, [
            'tid'   => 'required|numeric',
        ]);

        $transaction = Transaction::find($request->tid);

        $currency = Currency::find($transaction->currency_id);

        $auth_wallet = Auth::user()->walletByCurrencyId($currency->id);

        if((boolean)$transaction == false ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        if ( Auth::user()->account_status == 0 ) {
            flash(__('Your account is under a withdrawal request review proccess. please wait for a few minutes and try again') , 'info');
             return  back();
        }
        
        if(Auth::user()->id != $transaction->user_id ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        $send = Send::find($transaction->transactionable_id);

         if((boolean)$send == false ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        if(Auth::user()->id != $send->user_id ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'),'danger');
            return back();
        }

        $receive = Receive::find($send->receive_id);

        if((boolean)$receive == false ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        $user = User::find($receive->user_id);

        $user_wallet = $user->walletByCurrencyId($currency->id);

        if((boolean)$user == false ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        $receive_transaction = transaction::where('transactionable_type', 'App\Models\Receive')->where('user_id', $user->id)->where('transaction_state_id', 3)->where('money_flow', '+')->where('transactionable_id', $receive->id)->first();

        if((boolean)$receive_transaction == false ){
            flash(__('Wops, something went wrong... please contact support if this error persists !'), 'danger');
            return back();
        }

        if((double)$auth_wallet->amount < (double)$transaction->net ){
             flash(__('You have insufficient funds to send').' <strong>'.$request->amount.__('to').$request->email .'</strong>', 'danger');
            return  back();
        }

        $receive->send_id = $send->id;
        $receive->transaction_state_id = 1;
        $receive->save();

        $send->transaction_state_id = 1;
        $send->save();

        $transaction->transaction_state_id = 1;
        $transaction->balance = (double)$auth_wallet->amount - (double)$transaction->net;
        $transaction->save();

        $receive_transaction->transaction_state_id = 1;
        $receive_transaction->balance =  (double)  $user_wallet->amount + $receive_transaction->net;
        $receive_transaction->save();

        $auth_wallet->amount = (double)$auth_wallet->amount - (double)$transaction->net ;
        $auth_wallet->save();

        $user_wallet->amount =  $user_wallet->amount + $receive_transaction->net ;
        $user_wallet->save();


        flash(__('Transaction Complete'), 'success');

        return  back();
    }
    public function sendMoneyCancel(Request $request){
        $this->validate($request, [
            'tid'   => 'required|numeric',
        ]);

        $transaction = Transaction::findOrFail($request->tid);
        $send = Send::findOrFail($transaction->transactionable_id);

        $receive = Receive::findOrFail($send->receive_id);

        $receive->delete();
        $send->delete();
        $transaction->delete();
        
        flash(__('Transaction Canceled'), 'success');

        return  back();
    }
}
