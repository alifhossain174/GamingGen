<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id')->nullable();
            $table->string('game_code')->nullable();
            $table->string('title')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('status')->default(1);
            $table->string('amount')->nullable();
            $table->string('first')->nullable();
            $table->string('second')->nullable();
            $table->string('third')->nullable();
            $table->string('participants')->nullable();
            $table->string('joining_link')->nullable();
            $table->string('room_no')->nullable();
            $table->text('description')->nullable();
            $table->integer('close')->default(0);
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
        Schema::dropIfExists('contests');
    }
}
