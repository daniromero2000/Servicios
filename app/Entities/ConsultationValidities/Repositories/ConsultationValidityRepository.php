<?php

namespace App\Entities\ConsultationValidities\Repositories;

use App\Entities\ConsultationValidities\ConsultationValidity;
use App\Entities\ConsultationValidities\Repositories\Interfaces\ConsultationValidityRepositoryInterface;
use Illuminate\Database\QueryException;

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


    public function getConsultationValidity()
    {
        try {
            return $this->model->get(['pub_vigencia'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getRejectedValidity()
    {
        try {
            return $this->model->get(['rechazado_vigencia'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
