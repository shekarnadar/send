<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('e_product_category_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->text('json_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_products');
    }
}
