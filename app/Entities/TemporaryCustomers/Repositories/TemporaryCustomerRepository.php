<?php

namespace App\Entities\TemporaryCustomers\Repositories;

use App\Entities\TemporaryCustomers\TemporaryCustomer;
use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TemporaryCustomerRepository implements TemporaryCustomerRepositoryInterface
{

    private $columns = [];


    public function __construct(
        TemporaryCustomer $temporaryCustomer
    ) {
        $this->model = $temporaryCustomer;
    }
}