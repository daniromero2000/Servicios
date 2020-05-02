<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('brands_id')->nullable();
            $table->foreign('brands_id')->references('id')->on('brands');
            $table->string('sku');
            $table->string('name');
            $table->string('reference');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->string('description_image1')->nullable();
            $table->string('description_image2')->nullable();
            $table->string('description_image3')->nullable();
            $table->string('description_image4')->nullable();
            $table->string('specification_image')->nullable();
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->integer('months');
            $table->integer('pays');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
}
