<?php

 /**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO DE PRODUCTOS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: migration for products images
    **Date: 11/01/2019
     * 
     **/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('order')->nullable();
            $table->integer('idProduct')->unsigned();

            $table->foreign('idProduct')->references('id')->on('products');
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
        Schema::dropIfExists('product_images');
    }
}
