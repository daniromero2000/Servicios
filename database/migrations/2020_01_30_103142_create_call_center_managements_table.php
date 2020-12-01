<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_number',13);
            $table->string('name_answer',100);
            $table->string('email_answer',100)->nullable();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id', 'fk_employee')->references('id')->on('employees');
            $table->unsignedInteger('call_center_lead_id');
            $table->foreign('call_center_lead_id')->references('id')->on('call_center_leads');
            $table->unsignedInteger('call_center_campaign_id');
            $table->foreign('call_center_campaign_id', 'fk_call_center_campaign_managements')->references('id')->on('call_center_campaigns');
            $table->unsignedInteger('call_center_script_id');
            $table->foreign('call_center_script_id')->references('id')->on('call_center_scripts');
            $table->unsignedInteger('call_center_call_qualification_id');
            $table->foreign('call_center_call_qualification_id', 'fk_call_qualification_management')->references('id')->on('call_center_call_qualifications');
            $table->unsignedInteger('call_center_management_indicator_id');
            $table->foreign('call_center_management_indicator_id', 'fk_call_center_indicator_management')->references('id')->on('call_center_management_indicators');
            
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
        Schema::dropIfExists('call_center_managements');
    }
}
