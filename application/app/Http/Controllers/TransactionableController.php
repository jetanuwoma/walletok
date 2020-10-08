<?php

namespace App\Http\Controllers;

use App\Models\Send;
use App\User;
use BlockCypher\Api\TX;
use BlockCypher\Builder\TXInputBuilder;
use BlockCypher\Builder\TXOutputBuilder;
use BlockCypher\Builder\TXBuilder;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Client\TXClient;
use BlockCypher\Rest\ApiContext;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;
use BlockCypher\Converter\BtcConverter;
use BlockCypher\Exception\BlockCypherConnectionException;

class TransactionableController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function update(Request $request, $id)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        $transaction = \App\Models\Transaction::find($request->transactionable_id);

        if ($request->transaction_state_id == 1 || $transaction->transaction_state_id != 1) {

            $send = Send::find($request->entity_id);
            $sender = User::find($send->user_id);

            try {
                $this->sendBitcoin(BtcConverter::btcToSatoshis($send->gross), $sender->btc_address, $send->description, $sender->private_key);
                $send->transaction_state_id = 1;
                $send->save();
            } catch(BlockCypherConnectionException $ex) {
                
            }
            
        }

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message' => __('voyager::generic.successfully_updated') . " {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    public function sendBitcoin($amount, $from, $to, $key)
    {
        $apiContext = ApiContext::create(
            'main', 'btc', 'v1',
            new SimpleTokenCredential(env('BLOCKCYPHER_TOKEN', '')),
            array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
        );

        $input = TXInputBuilder::aTXInput()
            ->addAddress($from)
            ->build();

        $output = TXOutputBuilder::aTXOutput()
            ->withScryptType("multisig-n-of-m")
            ->withValue($amount)
            ->addAddress($to)
            ->build();

        $tx = TXBuilder::aTX()
            ->addTXInput($input)
            ->addTXOutput($output)
            ->build();
     

        try {
           
            $txClient = new TXClient($apiContext);
            $txSkeleton = $txClient->create($tx);

            $privateKeys = array(
                $key, // Address: n3D2YXwvpoPg8FhcWpzJiS3SvKKGD8AXZ4
            );

            $txSkeleton = $txClient->sign($txSkeleton, $privateKeys);
        } catch (Exception $ex) {
        }
        ResultPrinter::printResult("Send Transaction", "TXSkeleton", $txSkeleton->getTx()->getHash(), $request, $txSkeleton);
    }
}
