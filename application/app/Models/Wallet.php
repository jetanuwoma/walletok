<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
	protected $fillable = ['user_id', 'amount', 'currency_id'];

	public function User(){
		return $this->belongsTo(User::class);
	}

	public function Currency(){
		return $this->belongsTo(Currency::class);
	}

}