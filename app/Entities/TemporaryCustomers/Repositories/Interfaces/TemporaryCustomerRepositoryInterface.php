<?php

namespace App\Entities\TemporaryCustomers\Repositories\Interfaces;

use App\Entities\TemporaryCustomers\TemporaryCustomer;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface TemporaryCustomerRepositoryInterface
{
    public function findCustomerById($identificationNumber);

    public function updateOrCreateTemporaryCustomer($data);

    public function deleteTemporaryCustomer($identificationNumber);
}