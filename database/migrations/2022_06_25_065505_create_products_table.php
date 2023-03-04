<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->text('tags')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->tinyInteger('approval_status')->default(0)->comment('0 for pending, 1 for approved, 2 for rejected');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('product_categories_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
