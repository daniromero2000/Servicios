<?php

namespace App\Entities\Fosygas\Repositories\Interfaces;

interface FosygaRepositoryInterface
{
    public function doFosygaConsult($oportudataLead, $days);

    public function execWebServiceFosyga($oportudataLead,  $idConsultaWebService);

    public function getLastFosygaConsultation($identificationNumber);

    public function getLastFosygaConsultationPolicy($identificationNumber);

    public function createConsultaFosyga($infoBdua, $identificationNumber);

    public function validateConsultaFosyga($identificationNumber, $dateExpedition);

    public function validateDateConsultaFosyga($identificationNumber, $daysToIncrement);

    public function countCustomersfosygasConsultatios($from, $to);
}
