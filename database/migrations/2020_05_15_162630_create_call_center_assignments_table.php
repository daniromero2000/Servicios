<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallCenterAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedInteger('call_center_campaign_id');
            $table->foreign('call_center_campaign_id', 'fk_call_center_campaign_managements')->references('id')->on('call_center_campaigns');
            $table->string('identity_number',13);
            $table->softDeletes();
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
        Schema::dropIfExists('call_center_assignments');
    }
}
