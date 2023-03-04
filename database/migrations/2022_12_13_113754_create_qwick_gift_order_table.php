<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQwickGiftOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qwick_gift_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('campaign_recipient_id')->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('status');
            $table->string('order_id');
            $table->string('refno');
            $table->text('cancel');
            $table->text('currency');
            $table->text('payments');
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
        Schema::dropIfExists('qwick_gift_order');
    }
}
