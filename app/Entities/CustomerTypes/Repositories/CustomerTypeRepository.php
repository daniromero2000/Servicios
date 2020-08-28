<?php

namespace App\Entities\CustomerTypes\Repositories;

use App\Entities\CustomerTypes\CustomerType;
use App\Entities\CustomerTypes\Repositories\Interfaces\CustomerTypeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerTypeRepository implements CustomerTypeRepositoryInterface
{
    private $columns = [
        'identificationNumber',
        'type'
    ];

    public function __construct(CustomerType $customertype)
    {
        $this->model = $customertype;
    }

    public function findCustomerType($identificationNumber)
    {
        try {
            return $this->model->where('identificationNumber',$identificationNumber)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }    
}