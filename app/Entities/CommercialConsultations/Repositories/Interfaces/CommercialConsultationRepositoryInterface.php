<?php

namespace App\Entities\CommercialConsultations\Repositories\Interfaces;

interface CommercialConsultationRepositoryInterface
{
    public function getLastCommercialConsultation($identificationNumber);

    public function doConsultaComercial($oportudataLead, $days);

    public function execConsultaComercial($oportudataLead);

    public function ConsultarInformacionComercial($identificationNumber);

    public function execConsultaSaveXml($oportudataLead);

    public function validateDateConsultaComercial($identificationNumber, $daysToIncrement);
}
