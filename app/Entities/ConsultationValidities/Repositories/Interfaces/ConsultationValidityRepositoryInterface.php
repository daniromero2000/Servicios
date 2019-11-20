<?php

namespace App\Entities\ConsultationValidities\Repositories\Interfaces;

use App\Entities\ConsultationValidities\ConsultationValidity;

interface ConsultationValidityRepositoryInterface
{
    public function getConsultationValidity();

    public function getRejectedValidity();

    public function getSmsValidity();
}
