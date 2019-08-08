<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motos', function (Blueprint $table) {
            $table->increments('id');
            //image paths
            $table->string('image');
            $table->string('brand')->nullable();
            $table->boolean('ABS')->default(0);
            $table->string('details')->nullable();
            //manual path
            $table->string('manual')->nullable();
            //Descriptions and specs
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('buttonText')->nullable();
            $table->integer('fee')->nullable();
            $table->string('type')->nullable();
            $table->string('power')->nullable();
            $table->string('torque')->nullable();
            $table->string('compression')->nullable();
            $table->string('start')->nullable();
            $table->string('engine')->nullable();
            $table->string('displacement')->nullable();
            $table->string('frontBrake')->nullable();
            $table->string('rearBrake')->nullable();
            $table->string('frontSuspension')->nullable();
            $table->string('backSuspension')->nullable();
            $table->string('tireFront')->nullable();
            $table->string('tireBack')->nullable(); 
            $table->string('ignition')->nullable();
            $table->integer('long')->nullable();
            $table->integer('height')->nullable();
            $table->integer('seatHeight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('wheels')->nullable();
            $table->integer('tank')->nullable();            
            $table->integer('axisDistance')->nullable();
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
        //
    }
}
