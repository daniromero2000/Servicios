<?php

namespace App\Entities\Fosygas\Repositories\Interfaces;

interface FosygaRepositoryInterface
{
    public function getLastFosygaConsultation($identificationNumber);

    public function createConsultaFosyga($infoBdua, $identificationNumber);
}
