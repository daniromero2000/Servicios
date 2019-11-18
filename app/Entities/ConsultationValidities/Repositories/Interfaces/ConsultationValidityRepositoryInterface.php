<?php

namespace App\Entities\ConsultationValidities\Repositories\Interfaces;

use App\Entities\ConsultationValidities\ConsultationValidity;

interface ConsultationValidityRepositoryInterface
{
    public function findConsultationValidityById(int $id): ConsultationValidity;

    public function getPageDeniedTr();
}
