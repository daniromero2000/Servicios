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
        ])->limit(30)->get();
    }
}
