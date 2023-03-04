<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_product_redeem_details_id');
            $table->string('order_id',100);
            $table->string('tracking_id',100);
            $table->boolean('status');
            $table->json('order_response');
            $table->timestamps();
            $table->foreign('recipient_product_redeem_details_id')->references('id')->on('recipient_product_redeem_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
