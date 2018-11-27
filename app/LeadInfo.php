<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadInfo extends Model
{
    protected $table = 'leads_info';

    public $timestamps = false;

    protected $fillable = ['idLead', 'gender', 'dateDocumentExpedition', 'cityExpedition', 'addres', 'housingType', 'housingTime', 'housingOwner', 'leaseValue', 'housingTelephone', 'stratum', 'birthdate', 'age', 'levelStudy', 'vehicle', 'vehiclePlate', 'civilStatus', 'spouseName', 'spouseIdentificationNumber', 'spouseTelephone', 'spouseProfession', 'spouseJob', 'spouseJobName', 'spouseSalary', 'spouseEps', 'nit', 'indicative', 'companyName', 'companyAddres', 'companyTelephone', 'companyTelephone2', 'companyPosition', 'antiquity', 'salary', 'typeContract', 'otherRevenue', 'camaraComercio', 'whatSell', 'dateCreationCompany', 'bankSavingsAccount', 'admissionDate', 'eps'];
}
