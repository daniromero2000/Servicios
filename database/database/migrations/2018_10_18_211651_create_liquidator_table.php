<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('creditLine')->nullable();
            $table->string('pagaduria')->nullable();
            $table->integer('age')->nullable();
            $table->string('customerType')->nullable();
            $table->integer('salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidator');
    }
}
