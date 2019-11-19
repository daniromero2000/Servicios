<?php

namespace App\Entities\CommercialConsultations\Repositories;

use App\Entities\CommercialConsultations\CommercialConsultation;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use Illuminate\Database\QueryException;

class CommercialConsultationRepository implements CommercialConsultationRepositoryInterface
{
    public function __construct(
        CommercialConsultation $commercialConsultation
    ) {
        $this->model = $commercialConsultation;
    }

    public function getLastCommercialConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('consec', 'desc')->get(['fecha'])->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateDateConsultaComercial($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);

        $dateLastConsultaComercial = $this->getLastCommercialConsultation($identificationNumber);

        if (empty($dateLastConsultaComercial)) {
            return 'true';
        } else {
            $dateLastConsulta = $dateLastConsultaComercial->fecha;

            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }
}
