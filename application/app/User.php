<?php

namespace App;
use App\Models\Wallet;
use Storage;
use App\Models\Ticketcomment;
use App\Models\Currency;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Client\AddressClient;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar', 'whatsapp', 'phonenumber', 'first_name', 'last_name', 'verified','role_id', 'settings', 'merchant', 'currency_id' ,'social', 'account_status', 'verification_token', 'balance', 'json_data', 'is_ticket_admin',
        'btc_address', 'public_key', 'private_key', 'wallet_number', 'account_token'
    ];

    protected $with = ['profile'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function profile(){
        return $this->hasOne(\App\Models\Profile::class);
    }

    public function RecentActivity(){
        return $this->hasMany(\App\Models\Transaction::class);
    }

    public function balance(){
       return $this->currentWallet()->amount;
    }

    public function isAdministrator(){
        if ($this->role_id == 1) {
            return true;
        }
        return false;
    }

    public function currentCurrency(){
        if (!is_null($this->currentWallet())) {
             return $this->currentWallet()->currency;
        }

        $currency = Currency::first();
        $wallet = $this->newWallet($currency->id);

        $this->currency_id  =  $currency->id;
        $this->save();
        return $currency;
      
    }

    public function walletsCollection(){
         return $this->hasMany(\App\Models\Wallet::class);
    }

    public function getWalletNumber() {
        if ($this->wallet_number == null) {
            $part1 = rand(1000000, 9000000);
            $part2 = rand(30000, 90000);
            $wallet_number = sprintf("%s%s", $part1, $part2);
            $this->wallet_number = $wallet_number;
            $this->save();
            return $wallet_number;
        }

        return $this->wallet_number;
    }

    public function wallets(){
        
        $collection = $this->walletsCollection()->with('Currency')->get();

        foreach ($collection as $key => $value) {
             if(is_null($value->currency)){
                $collection->forget($key);
             } else if($value->currency->symbol == '(BTC)') {
                 $value->amount = $this->getBtcAmount();
             }
        }
       
        return $collection ;
    }

    public function getBtcAmount() {
       if ($this->btc_address == null) {
           return 0;
       } else {
        $apiContext = ApiContext::create(
            'main', 'btc', 'v1',
            new SimpleTokenCredential(env('BLOCKCYPHER_TOKEN', '')),
            array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
        );

        $addressClient = new AddressClient($apiContext);
        $addressBalance = $addressClient->getBalance($this->btc_address);
        return $addressBalance->final_balance;
       }
    }

    public function currentWallet(){

        // check if the user curency_id property is an existing currency id
        // if it returns NULL that mean the currency was deleted and the user is using an obsolet currency as a default currency

        if(Currency::where('id', $this->currency_id)->first() != NULL ){

            //check if the user has a wallet on that currency if true return that wallet, else create a new wallet on that currency
            
            $currentWallet = $this->walletsCollection()->with('Currency')->where('currency_id', $this->currency_id)->first();

            if ($currentWallet != NULL) {

                return $currentWallet;
            
            } else {
                // The currency exists in the database but the user does not have a wallet on that currency.
                //Create a new wallet on that currency and  return it

                $wallet = $this->newWallet( $this->currency_id);
                return Wallet::with('Currency')->where('currency_id', $this->currency_id)->where('user_id', $this->id)->first();

            }


        }

        $currency = Currency::orderBy('id','asc')->first();
        $wallet = $this->newWallet($currency->id);

        $this->currency_id  =  $currency->id;
        $this->save();
        return Wallet::with('Currency')->where('currency_id', $currency->id)->where('user_id', $this->id)->first();
    }

    public function currentWalletBalance(){
        return $this->currentWallet()->amount;
    }

    public function walletByCurrencyId($id){
        if (!is_null($this->walletsCollection()->with('Currency')->where('currency_id',$id)->first())) {
            return $this->walletsCollection()->with('Currency')->where('currency_id',$id)->first();
        }
        return $this->newWallet($id);
    }

    public function newWallet($currency_id){
        
        $wallet = Wallet::where('user_id', $this->id)->where('currency_id', $currency_id)->first();

        if (!is_null($wallet)) {
            return $wallet;
        }

        return Wallet::create([
            'user_id'   =>  $this->id,
            'currency_id'   =>  $currency_id,
            'amount'    =>  0
        ]);
    }

    public function getBalanceAttribute($value){
        return $this->currentWalletBalance();
    }

    public function setBalanceAttribute($value){
        $wallet = $this->currentWallet();
        $wallet->amount = $value;
        $wallet->save();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function avatar(){
        return $this->avatar;
    }
    public function isActivated(){
        return (bool)$this->verified;
    }

    public function canImpersonate()
    {
        // For example
        return $this->role_id == 1;
    }



}
