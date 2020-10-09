<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Sale;
use App\Models\Voucher;
use App\Models\Wallet;
use App\Models\Merchant;
use App\Models\Currency;
use App\Models\PurchaseRequest;

class FlutterwaveController extends Controller
{
	private $SECRET_KEY; 

	public function __construct()
	{
		$this->SECRET_KEY = "sk_test_170eded692183972be3b4c35b24bfe2a9f7ce284";
	}

	public function buyvoucher(Request $request){

		$user = Auth::user();
        $user->currency_id = 10;
        $user->save();
        return view('flutterwave.buyvoucher');
    }
   
   


    private function Money($value)
    {
    	return number_format((float)$value, 2, '.', '');
    }

}
