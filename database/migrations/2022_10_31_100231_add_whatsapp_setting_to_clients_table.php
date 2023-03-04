<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappSettingToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
             $table->string('template_name')->nullable();
             $table->string('broadcast_name')->nullable();
             $table->string('url')->nullable();
             $table->text('token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
             $table->string('template_name')->nullable();
             $table->string('broadcast_name')->nullable();
             $table->string('url')->nullable();
             $table->text('token')->nullable();
        });
    }
}
