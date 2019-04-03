<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTravelPackageToViajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viajes',function(Blueprint $table){

            $table->string('destination')->nullable();
            $table->integer('idImg')->nullable()->unsigned();
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('isLocal')->nullable();
            $table->string('textButton')->nullable();
            $table->timestamp('beginDate')->nullable();
            $table->timestamp('endingDate')->nullable();
            $table->foreign('idImg')->references('id')->on('imagenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('viajes',function(Blueprint $table){

            $table->dropColumn('destination');        
            $table->dropColumn('idImg');
            $table->dropColumn('description');
            $table->dropColumn('price');
            $table->dropColumn('isLocal');
            $table->dropColumn('textButton');
            $table->dropColumn('beginDate');
            $table->dropColumn('endingDate');
        });
    }
}
