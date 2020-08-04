<?php

namespace App\Entities\UbicaEmails\Repositories\Interfaces;

interface UbicaEmailRepositoryInterface
{
    public function getUbicaEmailByConsec($cellPhone, $consec);
}
