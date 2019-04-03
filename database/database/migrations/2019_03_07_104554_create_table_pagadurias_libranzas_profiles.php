<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePagaduriasLibranzasProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagadurias_libranza_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPagaduria')->unsigned();
            $table->integer('idProfile')->unsigned();
            $table->foreign('idProfile')->references('id')->on('libranza_profiles');
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
