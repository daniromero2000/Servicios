<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('textButton')->nullable();
            $table->integer('category')->nullable()->unsigned();
            $table->binary('isSlider')->nullable();
            $table->foreign('category')->references('id')->on('images_category');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
}
