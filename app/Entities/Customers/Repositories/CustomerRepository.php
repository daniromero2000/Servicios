<?php

namespace App\Entities\Customers\Repositories;

use App\Entities\Customers\Customer;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(
        Customer $customer
    ) {
        $this->model = $customer;
    }

    public function listCustomers()
    {
        return $this->model->with([
            'creditCard',
            'latestIntention'
        ])->limit(30)->get();
    }

    public function listCustomersDigitalChannel()
    {
        return $this->model->with([
            'creditCard',
            'factoryRequests'
        ])->where('ESTADO', 'APROBADO')
            ->has('hasFactoryRequests')
            ->get(['NOMBRES', 'APELLIDOS', 'CELULAR', 'CIUD_UBI', 'CEDULA', 'CREACION']);
    }

    public function findCustomerById($identificationNumber): Customer
    {
        try {
            return $this->model->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function checkIfExists($identificationNumber)
    {
        try {
            return $this->model->where('CEDULA', $identificationNumber)->get(['CLIENTE_WEB', 'USUARIO_CREACION'])->first();
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
