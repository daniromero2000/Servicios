<?php

namespace App\Entities\ConsultationValidities\Repositories;

use App\Entities\ConsultationValidities\ConsultationValidity;
use App\Entities\ConsultationValidities\Repositories\Interfaces\ConsultationValidityRepositoryInterface;

class ConsultationValidityRepository implements ConsultationValidityRepositoryInterface
{
    public function __construct(
        ConsultationValidity $consultationValidity
    ) {
        $this->model = $consultationValidity;
    }

    public function findConsultationValidityById(int $id): ConsultationValidity
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
