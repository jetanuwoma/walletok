<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Transaction;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Exchange;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Receive;
use App\Models\Send;
use App\Models\Merchant;
use Illuminate\Http\Request;

class TransactionController extends Controller
{ 


	public function show(Request $request, int $id){
		$transaction = Transaction::findOrFail($id);

		switch ($transaction->transactionable_type) {
			case 'App\Models\Sale':
				
					$sale = Sale::findOrFail($transaction->transactionable_id);
					$purchase = Purchase::findOrFail($sale->purchase_id);
					$client = User::findOrFail($purchase->user_id);
					$merchant = Merchant::findOrFail($sale->merchant_id);
					return view('Transactions.show')
					->with('transaction',$transaction)
					->with('sale', $sale)
					->with('client', $client)
					->with('invoice', json_decode($transaction->json_data))
					->with('merchant', $merchant)
					->with('purchase', $purchase);

				break;
			case 'App\Models\Purchase':
					$purchase = Purchase::findOrFail($transaction->transactionable_id);
					$merchant = Merchant::findOrFail($purchase->merchant_id);
					return view('Transactions.show')
					->with('transaction',$transaction)
					->with('invoice', json_decode($transaction->json_data))
					->with('merchant', $merchant)
					->with('purchase', $purchase);
				break;
			case 'App\Models\Receive':
				# code...
				break;
			case 'App\Models\Send':
				# code...
				break;
			case 'App\Models\Exchange':
				# code...
				break;
			case 'App\Models\Deposit':
				# code...
				break;
			case 'App\Models\Withdrawal':
				# code...
				break;
			case 'App\Models\Voucher':
				# code...
				break;
			
			default:
				# code...
				break;
		}
		
	}

	public function deleteMapper(Request $request){

		$this->validate($request, [
			'tid'	=>	'exists:transactionable,id|required'
		]);

		$transaction = Transaction::where('id', $request->tid)->first();

		$delete = str_replace('App\Models\\', 'delete', $transaction->transactionable_type);

		if ($delete == 'deletePurchase') {

			$this->deletePurchase($transaction);
			return back();
			
		}
		
	}

	private function deletePurchase(Transaction $trans){


		$purchase = Purchase::findOrFail($trans->transactionable_id);
		$sale = Sale::findOrFail($purchase->sale_id);
		
		$trans->delete();
		$purchase->delete();
		$sale->delete();

		flash(__('Transaction deleted'), 'danger');

		
	}
}
