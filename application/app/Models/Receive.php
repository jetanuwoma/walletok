<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{

	protected $with = ['User', 'From'];
    protected $fillable = ['user_id', 'from_id', 'send_id', 'transaction_state_id', 'gross', 'fee', 'net',	'description', 'json_data','currency_id', 'currency_symbol'];

    public function User(){
    	return $this->belongsTo(\App\User::class);
    }

    public function From(){
    	return $this->belongsTo(\App\User::class, 'from_id');
    }

    public function Transactions(){
        return $this->morphMany('App\Models\Transaction', 'Transactionable');
    }
}
