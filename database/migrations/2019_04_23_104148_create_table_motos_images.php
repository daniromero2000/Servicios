<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMotosImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motos_images',function(Blueprint $table){
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('id_moto')->unsigned();
            $table->foreign('id_moto')->references('id')->on('motos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
