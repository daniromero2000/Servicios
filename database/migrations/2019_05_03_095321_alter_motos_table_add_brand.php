<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMotosTableAddBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motos', function (Blueprint $table) {
            
            $table->integer('idBrand')->unsigned()->nullable()->after('name');
            $table->foreign('idBrand')->references('id')->on('motos_brands');            
                        
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
