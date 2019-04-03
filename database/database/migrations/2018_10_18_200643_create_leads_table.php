<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('city')->nullable();
            $table->string('typeService')->nullable();
            $table->string('typeProduct')->nullable();
            $table->tinyInteger('state');
            $table->tinyInteger('channel');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
