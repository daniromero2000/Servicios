<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibranzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libranza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idLead')->unsigned();
            $table->string('gender')->nullable();
            $table->date('dateDocumentExpedition')->nullable();
            $table->string('cityExpedition')->nullable();
            $table->string('addres')->nullable();
            $table->string('housingType')->nullable();
            $table->string('housingTime')->nullable();
            $table->string('housingOwner')->nullable();
            $table->string('leaseValue')->nullable();
            $table->string('housingTelephone')->nullable();
            $table->string('stratum')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('levelStudy')->nullable();
            $table->tinyInteger('vehicle')->nullable();
            $table->string('vehiclePlate')->nullable();
            $table->string('civilStatus')->nullable();
            $table->string('spouseName')->nullable();
            $table->string('spouseIdentificationNumber')->nullable();
            $table->string('spouseTelephone')->nullable();
            $table->string('spouseProfession')->nullable();
            $table->string('spouseJob')->nullable();
            $table->string('spouseJobName')->nullable();
            $table->string('spouseSalary')->nullable();
            $table->string('spouseEps')->nullable();
            $table->string('nit')->nullable();
            $table->string('indicative')->nullable();
            $table->string('companyName')->nullable();
            $table->string('companyAddres')->nullable();
            $table->string('companyTelephone')->nullable();
            $table->string('companyTelephone2')->nullable();
            $table->string('companyPosition')->nullable();
            $table->string('antiquity')->nullable();
            $table->string('salary')->nullable();
            $table->string('typeContract')->nullable();
            $table->string('otherRevenue')->nullable();
            $table->string('camaraComercio')->nullable();
            $table->string('whatSell')->nullable();
            $table->string('dateCreationCompany')->nullable();
            $table->string('bankSavingsAccount')->nullable();
            $table->date('admissionDate')->nullable();
            $table->string('eps')->nullable();
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
        Schema::dropIfExists('libranza');
    }
}
