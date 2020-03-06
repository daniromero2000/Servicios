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

    public function findCustomerById($identificationNumber)
    {
        try {
            return $this->model->find($identificationNumber);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateOrCreateTemporaryCustomer($data)
    {
        try {
            return $this->model->updateOrCreate(['CEDULA' => $data['CEDULA']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteTemporaryCustomer($identificationNumber){
        $data = $this->findCustomerById($identificationNumber);
        if($data){
            return $data->delete();
        }

        return [];
    }
}