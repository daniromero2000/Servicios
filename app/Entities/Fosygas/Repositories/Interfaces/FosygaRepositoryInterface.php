<?php

namespace App\Entities\Fosygas\Repositories\Interfaces;

interface FosygaRepositoryInterface
{
    public function getLastFosygaConsultation($identificationNumber);

    public function createConsultaFosyga($infoBdua, $identificationNumber);

    public function validateConsultaFosyga($identificationNumber, $names, $lastName, $dateExpedition);

    public function validateDateConsultaFosyga($identificationNumber, $daysToIncrement);

    public function countCustomersfosygasConsultatios($from, $to);
}
