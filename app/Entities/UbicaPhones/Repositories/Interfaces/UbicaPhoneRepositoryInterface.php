<?php

namespace App\Entities\UbicaPhones\Repositories\Interfaces;

interface UbicaPhoneRepositoryInterface
{
    public function getLastUbicaPhoneConsultation($identificationNumber);

    public function createConsultaUbicaPhone($infoBdua, $identificationNumber);

    public function validateConsultaUbicaPhone($identificationNumber, $names, $lastName, $dateExpedition);

    public function validateDateConsultaUbicaPhone($identificationNumber, $daysToIncrement);
}
