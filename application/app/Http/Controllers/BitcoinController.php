<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\User;
use Illuminate\Http\Request;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Client\AddressClient;

class BitcoinController extends Controller
{
    public function clientContext() {
        $apiContext = ApiContext::create(
            'main', 'btc', 'v1',
            new SimpleTokenCredential(env('BLOCKCYPHER_TOKEN', '')),
            array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
        );

        return $apiContext;
    }

    public function getaddress() {
        $user = Auth::user();
        if ($user->btc_address == null) {
            $apiContext = $this->clientContext();
            $addressClient = new AddressClient($apiContext);
            $addressKeyChain = $addressClient->generateAddress();
            $user->btc_address = $addressKeyChain->address;
            $user->public_key = $addressKeyChain->public;
            $user->private_key = $addressKeyChain->private;
            $user->save();
        }

        return redirect('/home');
    }
}
