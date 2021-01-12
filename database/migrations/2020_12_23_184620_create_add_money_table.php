<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_money', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('amount')->nullable();
            $table->string('refference_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('add_money');
    }
}
