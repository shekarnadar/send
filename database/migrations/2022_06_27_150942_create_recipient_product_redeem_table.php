<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientProductRedeemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient_product_redeem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_id');
            $table->unsignedBigInteger('product_id');
            $table->enum('medium',['sms', 'whatsapp','mail'])->nullable();
            $table->date('date_of_anniversary')->nullable();
            $table->tinyInteger('is_redeemed')->default(0);
            $table->dateTime('redeemed_at')->nullable();
            $table->timestamps();
            $table->foreign('recipient_id')->references('id')->on('recipients')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipient_product_redeem');
    }
}
