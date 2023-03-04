<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAccessMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_access_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_master_id');
            $table->unsignedBigInteger('access_master_id');
            $table->timestamps();
            $table->foreign('role_master_id')->references('id')->on('role_master')->onDelete('cascade');
            $table->foreign('access_master_id')->references('id')->on('access_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_access_mapping');
    }
}
