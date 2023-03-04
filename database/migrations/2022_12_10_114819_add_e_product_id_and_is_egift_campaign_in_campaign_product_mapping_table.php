<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEProductIdAndIsEgiftCampaignInCampaignProductMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_product_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('e_product_id')->nullable();
            $table->boolean('is_egift_campaign')->default(0);
            $table->foreign('e_product_id')->references('id')->on('e_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_product_mapping', function (Blueprint $table) {
            $table->dropColumn(['e_product_id']);
            $table->dropColumn(['is_egift_campaign']);
        });
    }
}
