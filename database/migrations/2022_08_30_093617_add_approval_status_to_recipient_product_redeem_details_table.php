<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalStatusToRecipientProductRedeemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipient_product_redeem_details', function (Blueprint $table) {
            $table->tinyInteger('approval_status')->default(0)->comment('0 for pending, 1 for dispatch, 2 for rejected');
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
        });
    }
}
