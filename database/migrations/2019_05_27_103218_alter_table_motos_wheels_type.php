<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMotosWheelsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motos',function(Blueprint $table){
            $table->string('wheels')->nullable()->change();
            $table->string('tank')->nullable()->change();
            $table->float('long', 8, 2)->nullable()->change();
            $table->float('height', 8, 2)->nullable()->change();
            $table->float('seatHeight', 8, 2)->nullable()->change();
            $table->float('width', 8, 2)->nullable()->change();
            $table->float('weight', 8, 2)->nullable()->change();
            $table->float('axisDistance', 8, 2)->nullable()->change();
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
