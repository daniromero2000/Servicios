<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLiquidatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidator', function (Blueprint $table) {
            
            $table->integer('idCreditLine')->unsigned()->nullable();
            $table->foreign('idCreditLine')->references('id')->on('libranza_lines');
            $table->integer('idPagaduria')->unsigned()->nullable();
            $table->foreign('idPagaduria')->references('id')->on('pagaduria');
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
