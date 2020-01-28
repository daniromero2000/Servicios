<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadAreaServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_area_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_area_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->timestamps();

            $table->foreign('lead_area_id')->references('id')->on('lead_areas');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_area_service');
    }
}