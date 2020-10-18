<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Escrow;
use App\User;
use Illuminate\Http\Request;
use Log;

//use the Rave Facade
use Rave;

class RaveController extends Controller
{

  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize()
  {
    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback(Request $request)
  {

    //$data = Rave::verifyTransaction(request()->txref);

    $decoded = json_encode($request->all());    

     $spread =  $request->resp;
     $data = json_decode($spread);
     $status = $data->data->status;

     if ($status == "success") {
      Auth::user()->setBalanceAttributeById(10, Auth::user()->currentWalletBalanceById(10) + $data->tx->amount);
      return  redirect(route('home'));
     }
    
  }

  public function withdrawal_callback(Request $request)
  {
    $file = fopen("test.txt","w");
    echo fwrite($file,"Called back");
    fclose($file);
    Log::notice('blocked second notification post request');
  }
}