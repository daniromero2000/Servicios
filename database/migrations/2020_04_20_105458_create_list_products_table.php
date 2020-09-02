<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('sku');
            $table->text('item');
            $table->integer('base_cost');
            $table->integer('iva_cost');
            $table->integer('protection');
            $table->integer('min_tolerance');
            $table->integer('max_tolerance');
            $table->string('type_product');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_products');
    }
}