<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idLogin')->unsigned();
            //$table->integer('idLead')->unsigned();
            $table->string('comment');            
            $table->timestamps();
        });

        Schema::table('comments',function(Blueprint $table){
               $table->foreign('idlogin')->references('id')->on('users');
               // $table->foreign('idLead')->references('id')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
