<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Escrow;
use App\User;
use Twilio;
use App\Models\Otp;
use App\Models\Transactions;
use App\Models\Currrency;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
use Jenssegers\Agent\Agent;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getPage']]);
    }

    public function getPage(Request $request, $id){
        
        $page = Page::where('id', $id)->first();

        if ($page != null) {
            return view('page.show')->with('page', $page);
        }

        return abort(404);
    }

    public function accountStatus(Request $request, $user){
        $user = User::findOrFail($user);
        $user->account_status = 0;
        $user->save();
        return back();
    }
    public function locale(Request $request, $locale){
        
        dd($locale);
        App::setLocale($locale);
        return view('welcome');
    }
    
    public function wallet(Request $request, $id){

        $currency = Auth::user()->walletByCurrencyId($id);
        if ($currency) {
            
            Auth::user()->currency_id = $id;
            Auth::user()->save();
        }
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $agent = new Agent();

        // Twilio::message('+258850586897', array(
        //     'body' => 'hihaa',
        //     'SERVICE SID'  =>  'Envato',
        // ));
        if (!Auth::user()->verified) {
            return view('otp.index');
        }

        $myEscrows = Escrow::with('toUser')->where('user_id', Auth::user()->id)->where('escrow_transaction_status', '!=' ,'completed')->orderby('id', 'desc')->get();
        $toEscrows = Escrow::with('user')->where('to', Auth::user()->id)->where('escrow_transaction_status', '!=' ,'completed')->orderby('id', 'desc')->get();

        $transactions = Auth::user()->RecentActivity()->with('Status')->orderby('id','desc')->where('transaction_state_id', '!=', 3)->paginate(10);
       

        $transactionsToConfirm =  Auth::user()->RecentActivity()->with('Status')->orderby('id','desc')->where('money_flow' , '!=', '+')->paginate(10);
        // if($agent->isMobile()){
        //     return view('_mobile.home.index')
        //     ->with('transactions', $transactions)
        //     ->with('transactions_to_confirm', $transactionsToConfirm);
        // }
        return view('home.index')
        ->with('transactions', $transactions)
        ->with('myEscrows', $myEscrows)
        ->with('toEscrows', $toEscrows)
        ->with('transactions_to_confirm', $transactionsToConfirm);
    }

    function tokenStatus() {
        $response = [];
        $token = Auth::user()->account_token;

        return response()->json([
          'hasToken' => $token == null ? 0: 1
        ]);
    }

    function checkpin(Request $request) {
        $currencies = [];
    if ($request->token == Auth::user()->account_token) {
        if (Auth::user()->currentCurrency()->symbol !== '(BTC)') {
            $currency =  \App\Helpers\Money::instance()->value(Auth::user()->balance(), Auth::user()->currentCurrency()->symbol);
        } else {
            $currency = \App\Helpers\Money::instance()->value(Auth::user()->getBtcAmount(), Auth::user()->currentCurrency()->symbol);
        }

        $currencies['general'] = $currency;
    } else {
        $currencies['hasError'] = $request->token;
    }
        
        return response()->json($currencies);
    }

    function setToken(Request $request) {
        $user = Auth::user();
        $user->account_token = $request->token;
        $user->save();
        return redirect(route('home'));
    }

    function getUserBalance(Request $request) {
        if (Auth::user()->currentCurrency()->symbol !== '(BTC)') {
            $currency =  \App\Helpers\Money::instance()->value(Auth::user()->balance(), Auth::user()->currentCurrency()->symbol);
        } else {
            $currency = \App\Helpers\Money::instance()->value(Auth::user()->getBtcAmount(), Auth::user()->currentCurrency()->symbol);
        }
       
    }
}
 