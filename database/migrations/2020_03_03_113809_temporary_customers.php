<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporaryCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TIPO_DOC')->nullable();
            $table->string('CEDULA')->nullable();
            $table->timestamp('FEC_EXP')->nullable();
            $table->string('ACTIVIDAD')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('CELULAR')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_customers');
    }
}