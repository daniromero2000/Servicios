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

    public function findCustomerById($identificationNumber): TemporaryCustomer
    {
        try {
            return $this->model->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
    public function updateOrCreateCustomer($data)
    {
        try {
            return $this->model->updateOrCreate(['CEDULA' => $data['CEDULA']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}