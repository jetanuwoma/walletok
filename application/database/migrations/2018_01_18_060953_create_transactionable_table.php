<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('request_id')->nullable();
            $table->integer('transactionable_id');
            $table->string('transactionable_type');
            $table->integer('entity_id');
            $table->string('entity_name');
            $table->integer('transaction_state_id');
            $table->string('currency')->default('USD');
            $table->string('activity_title');
            $table->string('money_flow');
            $table->float('gross');
            $table->float('fee')->default(0.00);
            $table->float('net');
            $table->float('balance')->nullable()->default(NULL);
            $table->text('json_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactionable');
    }
}
