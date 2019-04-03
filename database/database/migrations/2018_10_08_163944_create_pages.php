<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();

            $table->integer('idUser')->nullable()->unsigned();

            $table->integer('idCategory')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('url')->unique()->nullable();
        });

        Schema::table('pages',function(Blueprint $table){
                $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
