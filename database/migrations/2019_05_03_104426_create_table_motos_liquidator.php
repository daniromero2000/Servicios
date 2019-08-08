<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMotosLiquidator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motos_liquidator',function(Blueprint $table){
            
            $table->increments('id');
            $table->integer('idMoto')->nullable()->unsigned();
            $table->foreign('idMoto')->references('id')->on('motos');
            $table->integer('initialFee')->default(0);
            $table->integer('timeLimit')->nullable()->unsigned();
            $table->foreign('timeLimit')->references('id')->on('motos_timelimits');

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
