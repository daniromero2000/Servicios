<?php

namespace App\Entities\UbicaCellPhones\Repositories\Interfaces;

interface UbicaCellPhoneRepositoryInterface
{
    public function getLastUbicaCellPhoneConsultation($identificationNumber);

    public function createConsultaUbicaCellPhone($infoBdua, $identificationNumber);

    public function validateConsultaUbicaCellPhone($identificationNumber, $names, $lastName, $dateExpedition);

    public function validateDateConsultaUbicaCellPhone($identificationNumber, $daysToIncrement);
}
