<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipient_product_redeem_details', function (Blueprint $table) {
            //
            
             $table->text('pickrr_order_status_code',20)->nullable();
             $table->text('pickrr_order_status',20)->nullable();
             $table->boolean('is_completed');
             $table->date('pickrr_current_status_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipient_product_redeem_details', function (Blueprint $table) {
            //
             $table->text('pickrr_order_status_code')->nullable();
             $table->text('pickrr_order_status')->nullable();
             $table->boolean('is_completed');
             $table->timestamps();
        });
    }
}
