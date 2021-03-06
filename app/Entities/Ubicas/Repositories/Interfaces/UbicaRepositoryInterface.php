<?php

namespace App\Entities\Ubicas\Repositories\Interfaces;

interface UbicaRepositoryInterface
{
    public function doConsultaUbica($customer, $lastName, $days);

    public function getLastUbicaConsultation($identificationNumber);

    public function getUbicaConsultation($identificationNumber);

    public function createConsultaUbica($infoBdua, $identificationNumber);

    public function validateConsultaUbica($identificationNumber, $names, $lastName, $dateExpedition);

    public function validateDateConsultaUbica($identificationNumber, $daysToIncrement);

    public function validateDateUbica($fecha);
}
