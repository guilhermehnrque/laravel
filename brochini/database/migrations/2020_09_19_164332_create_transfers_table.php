<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranfers', function (Blueprint $table) {
            $table->id();
            $table->double('value', 10, 2);
            $table->enum('status', ['approved', 'on_hold', 'rejected', 'done']);
            $table->unsignedBigInteger('wallet_source');
            $table->unsignedBigInteger('wallet_target');
            $table->timestamps();

            $table->foreign('wallet_source')->references('id')->on('wallets');
            $table->foreign('wallet_target')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
