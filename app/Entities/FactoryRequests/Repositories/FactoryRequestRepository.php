<?php

namespace App\Entities\FactoryRequests\Repositories;

use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;

class FactoryRequestRepository implements FactoryRequestRepositoryInterface
{
    public function __construct(
        FactoryRequest $factoryRequest
    ) {
        $this->model = $factoryRequest;
    }

    public function findFactoryRequestById(int $id): FactoryRequest
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listFactoryRequestDigitalChannel()
    {
        return $this->model->with([
            'customer',
            'creditCard'
        ])->has('hasCustomer')
            ->has('creditCard')
            ->where('ESTADO', 'APROBADO')
            ->where('GRAN_TOTAL', 0)
            ->where('SOLICITUD_WEB', 1)
            ->latest('SOLICITUD')
            ->get(['SOLICITUD', 'ASESOR_DIG', 'FECHASOL']);
    }
}
