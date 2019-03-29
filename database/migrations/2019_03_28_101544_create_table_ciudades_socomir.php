<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCiudadesSocomir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades_soc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city');
            $table->string('address')->nullable();
            $table->string('office')->nullable();
            $table->string('responsable')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('state');
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
