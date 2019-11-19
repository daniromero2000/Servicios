<?php

namespace App\Entities\CommercialConsultations\Repositories\Interfaces;

interface CommercialConsultationRepositoryInterface
{
    public function getLastCommercialConsultation($identificationNumber);

    public function validateDateConsultaComercial($identificationNumber, $daysToIncrement);
}
