<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['deposit', 'withdraw', 'transfer']);
            $table->integer('sender_id');
            $table->string('receiver_name');
            $table->integer('card_id')->nullable();
            $table->string("bank_account_number")->nullable();
            $table->integer('bank_account_id')->nullable();
            $table->string('amount');
            $table->text('content')->nullable();
            $table->date('date');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
