<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLeadsInfoIdLeadUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads_info',function(Blueprint $table){

            $table->integer('idLead')->unsigned()->change();
            $table->string('gender')->nullable()->change();
            $table->date('dateDocumentExpedition')->nullable()->change();
            $table->string('cityExpedition')->nullable()->change();
            $table->string('addres')->nullable()->change();
            $table->string('housingType')->nullable()->change();
            $table->string('housingTime')->nullable()->change();
            $table->string('housingOwner')->nullable()->change();
            $table->string('leaseValue')->nullable()->change();
            $table->string('housingTelephone')->nullable()->change();
            $table->string('stratum')->nullable()->change();
            $table->date('birthdate')->nullable()->change();
            $table->string('age')->nullable()->change();
            $table->string('levelStudy')->nullable()->change();
            //$table->tinyInteger('vehicle')->nullable()->change();
            $table->string('vehiclePlate')->nullable()->change();
            $table->string('civilStatus')->nullable()->change();
            $table->string('spouseName')->nullable()->change();
            $table->string('spouseIdentificationNumber')->nullable()->change();
            $table->string('spouseTelephone')->nullable()->change();
            $table->string('spouseProfession')->nullable()->change();
            $table->string('spouseJob')->nullable()->change();
            $table->string('spouseJobName')->nullable()->change();
            $table->string('spouseSalary')->nullable()->change();
            $table->string('spouseEps')->nullable()->change();
            $table->string('nit')->nullable()->change();
            $table->string('indicative')->nullable()->change();
            $table->string('companyName')->nullable()->change();
            $table->string('companyAddres')->nullable()->change();
            $table->string('companyTelephone')->nullable()->change();
            $table->string('companyTelephone2')->nullable()->change();
            $table->string('companyPosition')->nullable()->change();
            $table->string('antiquity')->nullable()->change();
            $table->string('salary')->nullable()->change();
            $table->string('typeContract')->nullable()->change();
            $table->string('otherRevenue')->nullable()->change();
            $table->string('camaraComercio')->nullable()->change();
            $table->string('whatSell')->nullable()->change();
            $table->string('dateCreationCompany')->nullable()->change();
            $table->string('bankSavingsAccount')->nullable()->change();
            $table->date('admissionDate')->nullable()->change();
            $table->string('eps')->nullable()->change();
            //$table->foreign('idLead')->references('id')->on('leads')->nullable()->change();
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
