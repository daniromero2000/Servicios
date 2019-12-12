<?php

namespace App\Entities\CustomerReferences\Repositories;

use App\Entities\CustomerReferences\CustomerReference;
use App\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerReferenceRepository implements CustomerReferenceRepositoryInterface
{
    public function __construct(
        CustomerReference $CustomerReference
    ) {
        $this->model = $CustomerReference;
    }
}
