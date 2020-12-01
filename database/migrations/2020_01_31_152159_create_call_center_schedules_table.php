<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('call_center_management_id');
            $table->foreign('call_center_management_id', 'fk_management_schedules')->references('id')->on('call_center_managements');
            $table->tinyInteger('status')->default(0)->comment("0= Pendiente, 1= Cumplido");
            $table->timestamp('call_center_schedule');
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
        Schema::dropIfExists('call_center_schedules');
    }
}
