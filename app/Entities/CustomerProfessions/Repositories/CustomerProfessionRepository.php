<?php

namespace App\Entities\CustomerProfessions\Repositories;

use App\Entities\CustomerProfessions\CustomerProfession;
use App\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CustomerProfessionRepository implements CustomerProfessionRepositoryInterface
{

    private $columns = [
        'CODIGO',
        'NOMBRE',
        'STATE'
    ];


    public function __construct(
        CustomerProfession $customerProfession
    ) {
        $this->model = $customerProfession;
    }

    public function listCustomerProfessions()
    {
        return $this->model->where('STATE', 'A')->get($this->columns);
    }
}