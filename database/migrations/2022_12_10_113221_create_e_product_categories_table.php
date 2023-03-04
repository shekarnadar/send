<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_product_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->comment('category id referes to the category number of e gift products, it does not relate with any table as foreign key.');
            $table->string('name')->nullable();
            $table->text('description')->nullable();            
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
        Schema::dropIfExists('e_product_categories');
    }
}
