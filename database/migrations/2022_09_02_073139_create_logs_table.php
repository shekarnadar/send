<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_user_id')->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('redeem_link')->nullable();
            $table->boolean('status')->default(0)->comment('0 for failed, 1 for success');
            $table->enum('medium', ['email', 'whatsapp', 'sms'])->default('email');
            $table->string('description')->nullable();
            $table->timestamps();
            // $table->foreign('client_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
