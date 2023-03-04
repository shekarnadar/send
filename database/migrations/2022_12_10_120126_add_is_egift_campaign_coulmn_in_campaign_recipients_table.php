<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEgiftCampaignCoulmnInCampaignRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_recipients', function (Blueprint $table) {
            $table->boolean('is_egift_campaign')->default(0);
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
            $table->dropColumn(['is_egift_campaign']);
        });
    }
}
