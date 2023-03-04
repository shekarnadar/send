<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transaction_summary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_user_id');
            $table->unsignedBigInteger('reciever_user_id')->nullable();
            $table->unsignedBigInteger('campaign_recipient_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reciever_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('campaign_recipient_id')->references('id')->on('campaign_recipients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transaction_summary');
    }
}
