<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_master_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 20);
            $table->string('password');
            $table->string('phone',20)->nullable();
            $table->string('email_verification_token')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_deleted')->default(0);
            // $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_master_id')->references('id')->on('role_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
