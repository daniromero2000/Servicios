<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermissionsProfileModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_profile_module', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_profile')->unsigned();
            $table->integer('id_module')->unsigned();
            $table->foreign('id_profile')->references('id')->on('profiles');
            $table->foreign('id_module')->references('id')->on('modules');
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
