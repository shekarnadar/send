<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('managers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('address_line_1', 100);
        //     $table->string('address_line_2', 100);
        //     $table->string('postal_code', 20);
        //     $table->integer('city')->nullable();
        //     $table->integer('state')->nullable();
        //     $table->integer('country')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('managers');
    }
}
