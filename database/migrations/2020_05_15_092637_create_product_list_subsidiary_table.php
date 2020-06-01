<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListSubsidiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_list_subsidiary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_list_id')->unsigned();
            $table->integer('codigo')->unsigned();
            $table->foreign('product_list_id')->references('id')->on('product_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_list_subsidiary');
    }
}
