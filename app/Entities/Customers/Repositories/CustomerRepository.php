<?php

namespace App\Entities\Customers\Repositories;

use App\Entities\Customers\Customer;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;

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
            'cifinScores',
            'factoryRequests',
            'creditCard',
            'intentions'
        ])->limit(30)->get();
    }

    public function listCustomersDigitalChannel()
    {
        return $this->model->with('cifinScoresDC')
            ->has('factoryRequestsDC')
            ->limit(100)->get();
    }
}


// ->with(['cifinScores' => function ($query) {
//                 $query->latest('scoconsul')->first();
//             }])
//             ->with(['intentions' => function ($query) {
//                 $query->latest('FECHA_INTENCION')->first();
//             }])
