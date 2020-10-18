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
use Log;

class WithdrawalController extends Controller
{
    
    public function index(Request $request){

        
    	$withdrawals = Withdrawal::with(['Method','Status'])->where('user_id', Auth::user()->id)->orderby('id', 'desc')->paginate(10);
    	return view('withdrawals.index')
    	->with('withdrawals', $withdrawals);

    }

    public function getWithdrawalRequestForm(Request $request, $method_id = false){
           
        $banks = '[{
            "Id": 132,
            "Code": "560",
            "Name": "Page MFBank"
          },
          {
            "Id": 133,
            "Code": "304",
            "Name": "Stanbic Mobile Money"
          },
          {
            "Id": 134,
            "Code": "308",
            "Name": "FortisMobile"
          },
          {
            "Id": 135,
            "Code": "328",
            "Name": "TagPay"
          },
          {
            "Id": 136,
            "Code": "309",
            "Name": "FBNMobile"
          },
          {
            "Id": 137,
            "Code": "011",
            "Name": "First Bank of Nigeria"
          },
          {
            "Id": 138,
            "Code": "326",
            "Name": "Sterling Mobile"
          },
          {
            "Id": 139,
            "Code": "990",
            "Name": "Omoluabi Mortgage Bank"
          },
          {
            "Id": 140,
            "Code": "311",
            "Name": "ReadyCash (Parkway)"
          },
          {
            "Id": 141,
            "Code": "057",
            "Name": "Zenith Bank"
          },
          {
            "Id": 142,
            "Code": "068",
            "Name": "Standard Chartered Bank"
          },
          {
            "Id": 143,
            "Code": "306",
            "Name": "eTranzact"
          },
          {
            "Id": 144,
            "Code": "070",
            "Name": "Fidelity Bank"
          },
          {
            "Id": 145,
            "Code": "023",
            "Name": "CitiBank"
          },
          {
            "Id": 146,
            "Code": "215",
            "Name": "Unity Bank"
          },
          {
            "Id": 147,
            "Code": "323",
            "Name": "Access Money"
          },
          {
            "Id": 148,
            "Code": "302",
            "Name": "Eartholeum"
          },
          {
            "Id": 149,
            "Code": "324",
            "Name": "Hedonmark"
          },
          {
            "Id": 150,
            "Code": "325",
            "Name": "MoneyBox"
          },
          {
            "Id": 151,
            "Code": "301",
            "Name": "JAIZ Bank"
          },
          {
            "Id": 152,
            "Code": "050",
            "Name": "Ecobank Plc"
          },
          {
            "Id": 153,
            "Code": "307",
            "Name": "EcoMobile"
          },
          {
            "Id": 154,
            "Code": "318",
            "Name": "Fidelity Mobile"
          },
          {
            "Id": 155,
            "Code": "319",
            "Name": "TeasyMobile"
          },
          {
            "Id": 156,
            "Code": "999",
            "Name": "NIP Virtual Bank"
          },
          {
            "Id": 157,
            "Code": "320",
            "Name": "VTNetworks"
          },
          {
            "Id": 158,
            "Code": "221",
            "Name": "Stanbic IBTC Bank"
          },
          {
            "Id": 159,
            "Code": "501",
            "Name": "Fortis Microfinance Bank"
          },
          {
            "Id": 160,
            "Code": "329",
            "Name": "PayAttitude Online"
          },
          {
            "Id": 161,
            "Code": "322",
            "Name": "ZenithMobile"
          },
          {
            "Id": 162,
            "Code": "303",
            "Name": "ChamsMobile"
          },
          {
            "Id": 163,
            "Code": "403",
            "Name": "SafeTrust Mortgage Bank"
          },
          {
            "Id": 164,
            "Code": "551",
            "Name": "Covenant Microfinance Bank"
          },
          {
            "Id": 165,
            "Code": "415",
            "Name": "Imperial Homes Mortgage Bank"
          },
          {
            "Id": 166,
            "Code": "552",
            "Name": "NPF MicroFinance Bank"
          },
          {
            "Id": 167,
            "Code": "526",
            "Name": "Parralex"
          },
          {
            "Id": 168,
            "Code": "035",
            "Name": "Wema Bank"
          },
          {
            "Id": 169,
            "Code": "084",
            "Name": "Enterprise Bank"
          },
          {
            "Id": 170,
            "Code": "063",
            "Name": "Diamond Bank"
          },
          {
            "Id": 171,
            "Code": "305",
            "Name": "Paycom"
          },
          {
            "Id": 172,
            "Code": "100",
            "Name": "SunTrust Bank"
          },
          {
            "Id": 173,
            "Code": "317",
            "Name": "Cellulant"
          },
          {
            "Id": 174,
            "Code": "401",
            "Name": "ASO Savings and & Loans"
          },
          {
            "Id": 175,
            "Code": "030",
            "Name": "Heritage"
          },
          {
            "Id": 176,
            "Code": "402",
            "Name": "Jubilee Life Mortgage Bank"
          },
          {
            "Id": 177,
            "Code": "058",
            "Name": "GTBank Plc"
          },
          {
            "Id": 178,
            "Code": "032",
            "Name": "Union Bank"
          },
          {
            "Id": 179,
            "Code": "232",
            "Name": "Sterling Bank"
          },
          {
            "Id": 180,
            "Code": "076",
            "Name": "Skye Bank"
          },
          {
            "Id": 181,
            "Code": "082",
            "Name": "Keystone Bank"
          },
          {
            "Id": 182,
            "Code": "327",
            "Name": "Pagatech"
          },
          {
            "Id": 183,
            "Code": "559",
            "Name": "Coronation Merchant Bank"
          },
          {
            "Id": 184,
            "Code": "601",
            "Name": "FSDH"
          },
          {
            "Id": 185,
            "Code": "313",
            "Name": "Mkudi"
          },
          {
            "Id": 186,
            "Code": "214",
            "Name": "First City Monument Bank"
          },
          {
            "Id": 187,
            "Code": "314",
            "Name": "FET"
          },
          {
            "Id": 188,
            "Code": "523",
            "Name": "Trustbond"
          },
          {
            "Id": 189,
            "Code": "315",
            "Name": "GTMobile"
          },
          {
            "Id": 190,
            "Code": "033",
            "Name": "United Bank for Africa"
          },
          {
            "Id": 191,
            "Code": "044",
            "Name": "Access Bank"
          }
        ]';

        $bank_decode = json_decode($banks);

        
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
        ->with('methods', $methods)
        ->with('banks', $bank_decode);
    }

    public function makeRequest(Request $request){
        
        $wallet = Wallet::where('user_id', Auth::user()->id)->where('currency_id', Auth::user()->currentCurrency()->id)->first();

        $this->validate($request, [
            'bank_code' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'amount'   =>  'required|numeric|between:5,'.(float)$wallet->amount,
        ]);

        if ( Auth::user()->account_status == 0 ) {
            flash(__('Your account is under a withdrawal request review proccess. Please wait until your request is complete in a few minutes to continue with your activities.') , 'info');
             return  back();
        }

        

        $fee = 5 * $request->amount / 100;
    	
        $withdrawal = Withdrawal::create([
            'user_id'   =>  Auth::user()->id,
            'transaction_state_id'  =>  3,
            'withdrawal_method_id'  =>  0,
            'platform_id'  =>  0,
            'send_to_platform_name' =>  'Bank',
            'gross' =>  $request->amount,
            'fee'   =>  $fee,
            'currency_id'   =>  Auth::user()->currentCurrency()->id,
            'currency_symbol'   =>  Auth::user()->currentCurrency()->symbol,
            'wallet_id' => $wallet->id,
            'net'   =>  $request->amount - $fee,
        ]);

        $endpoint = "https://api.ravepay.co/v2/gpx/transfers/create";
        $client = new \GuzzleHttp\Client();
        $account_bank = $request->bank_code;
        $account_number = $request->account_number;
        $amount = $request->amount;
        $currency = "NGN";
        $seckey = env('RAVE_SECRET_KEY');
        $beneficiary_name = $request->account_name;

        $response = $client->request('POST', $endpoint, ['form_params' => [
            'account_bank' => $account_bank, 
            'account_number' => $account_number,
            'amount' => $amount,
            'currency' => $currency,
            'seckey' => $seckey,
            'beneficiary_name' => $beneficiary_name,
            'callback_url' => route('withdrawal_callback')
        ]]);

        $file = fopen("logs/laravel.log","w");
            echo fwrite($file,"Hello World. Testing!");
            fclose($file);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        $data = json_decode($content);

        if($data->status == 'success') {
            Auth::user()->setBalanceAttribute(Auth::user()->currentWalletBalance() - $request->amount);
            flash(__('Your money has been successfully sent'), 'success');
            return redirect(route('home'));
        } else {
            flash(__('Error sending money'), 'success');
            return redirect(route('home'));
        }


        // Send Alert to Admin 
        Mail::send(new withdrawalRequestAdminNotificationEmail($withdrawal, Auth::user()));

        //Send new deposit request notification Mail to user
        Mail::send(new withdrawalRequestUserEmail( $withdrawal, Auth::user()));


        if($data->status == 'success') {

            flash(__('Your money has been successfully sent'), 'success');
            return redirect(route('home'));
        } else {
            flash(__('Error sending money'), 'warning');
            return redirect(route('home'));
        }
        //return redirect(route('home'));
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
