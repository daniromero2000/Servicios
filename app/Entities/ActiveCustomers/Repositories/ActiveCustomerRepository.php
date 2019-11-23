<?php

namespace App\Entities\ActiveCustomers\Repositories;

use App\Entities\ActiveCustomers\ActiveCustomer;
use App\Entities\ActiveCustomers\Repositories\Interfaces\ActiveCustomerRepositoryInterface;
use Illuminate\Database\QueryException;

class ActiveCustomerRepository implements ActiveCustomerRepositoryInterface
{
    public function __construct(
        ActiveCustomer $ActiveCustomer
    ) {
        $this->model = $ActiveCustomer;
    }

    public function listActiveCustomers()
    {
        return $this->model->with([
            'creditCard',
            'latestIntention'
        ])->limit(30)->get();
    }

    public function updateOrCreateActiveCustomer($data)
    {
        try {
            return $this->model->updateOrCreate(['CEDULA' => $data['CEDULA']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function listActiveCustomersDigitalChannel()
    {
        return $this->model->with([
            'creditCard',
            'factoryRequests'
        ])->where('ESTADO', 'APROBADO')
            ->has('hasFactoryRequests')
            ->get(['NOMBRES', 'APELLIDOS', 'CELULAR', 'CIUD_UBI', 'CEDULA', 'CREACION']);
    }

    public function findActiveCustomerById($identificationNumber): ActiveCustomer
    {
        try {
            return $this->model->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getActiveCustomerById($identificationNumber)
    {
        try {
            return $this->model->where('CEDULA', $identificationNumber)->get()->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
