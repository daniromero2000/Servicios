<?php

 /**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: migration for products
    **Fecha: 22/12/2018
     * 
     **/

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
            $table->string('name',70)->unique();
            $table->string('reference',70)->nullable();
            $table->text('specifications')->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('idBrand')->unsigned();
            $table->integer('idLine')->unsigned();
            $table->integer('idCity')->unsigned()->nullable();
            $table->softDeletes(); //Colum for soft delete
            $table->timestamps();

            $table->foreign('idBrand')->references('id')->on('brands');
            $table->foreign('idLine')->references('id')->on('lines');
            $table->foreign('idCity')->references('id')->on('ciudades');
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
