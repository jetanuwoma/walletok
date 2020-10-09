<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    $data = Rave::verifyTransaction(request()->txref);

   var_dump($data);
        

  }
}