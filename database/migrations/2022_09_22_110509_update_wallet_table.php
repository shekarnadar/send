<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       
           Schema::table('wallet', function (Blueprint $table) {
             $table->double('pendingAmount')->default('0');
             $table->double('availableBalance')->default('0');
             $table->double('spentAmount')->default('0');
             $table->double('buget')->default('0');
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
