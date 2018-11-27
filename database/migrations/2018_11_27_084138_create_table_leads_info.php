<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLeadsInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idLead')->nullable()->unsigned();
            $table->string('gender');
            $table->date('dateDocumentExpedition');
            $table->string('cityExpedition');
            $table->string('addres');
            $table->string('housingType');
            $table->string('housingTime');
            $table->string('housingOwner');
            $table->string('leaseValue');
            $table->string('housingTelephone');
            $table->string('stratum');
            $table->date('birthdate');
            $table->string('age');
            $table->string('levelStudy');
            $table->tinyInteger('vehicle');
            $table->string('vehiclePlate');
            $table->string('civilStatus');
            $table->string('spouseName');
            $table->string('spouseIdentificationNumber');
            $table->string('spouseTelephone');
            $table->string('spouseProfession');
            $table->string('spouseJob');
            $table->string('spouseJobName');
            $table->string('spouseSalary');
            $table->string('spouseEps');
            $table->string('nit');
            $table->string('indicative');
            $table->string('companyName');
            $table->string('companyAddres');
            $table->string('companyTelephone');
            $table->string('companyTelephone2');
            $table->string('companyPosition');
            $table->string('antiquity');
            $table->string('salary');
            $table->string('typeContract');
            $table->string('otherRevenue');
            $table->string('camaraComercio');
            $table->string('whatSell');
            $table->string('dateCreationCompany');
            $table->string('bankSavingsAccount');
            $table->date('admissionDate');
            $table->string('eps');
            $table->foreign('idLead')->references('id')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
