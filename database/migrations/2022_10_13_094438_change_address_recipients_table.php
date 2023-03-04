<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAddressRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('recipients', function (Blueprint $table) {
            $table->text('address_line_1')->change();
            $table->text('address_line_2')->change();
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
          Schema::table('recipients', function (Blueprint $table) {
            $table->text('address_line_1')->change();
            $table->text('address_line_2')->change();
        });
    }
}
