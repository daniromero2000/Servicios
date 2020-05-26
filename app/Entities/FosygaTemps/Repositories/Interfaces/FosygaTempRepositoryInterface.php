<?php

namespace App\Entities\FosygaTemps\Repositories\Interfaces;

interface FosygaTempRepositoryInterface
{
    public function getLastFosygaTempConsultation($identificationNumber);
}
