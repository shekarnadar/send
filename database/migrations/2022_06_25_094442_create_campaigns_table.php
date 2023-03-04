<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('client_user_id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            // $table->string('image')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->boolean('is_sms')->default(0);
            $table->boolean('is_whatsapp')->default(0);
            $table->boolean('is_mail')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('approval_status')->default(0)->comment('0 for pending, 1 for approved, 2 for rejected');
            $table->boolean('is_asked_gift_expert')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
