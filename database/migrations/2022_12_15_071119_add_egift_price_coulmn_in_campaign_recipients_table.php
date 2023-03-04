<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEgiftPriceCoulmnInCampaignRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_recipients', function (Blueprint $table) {
            //
             $table->decimal('egift_price', 10, 2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_recipients', function (Blueprint $table) {
            //
            $table->dropColumn(['egift_price']);
        });
    }
}
