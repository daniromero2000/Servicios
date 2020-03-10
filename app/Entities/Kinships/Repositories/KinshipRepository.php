<?php

namespace App\Entities\Kinships\Repositories;

use App\Entities\Kinships\Kinship;
use App\Entities\Kinships\Repositories\Interfaces\KinshipRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class KinshipRepository implements KinshipRepositoryInterface
{

    private $columns = [
        'CODIGO',
        'TIPO',
        'STATE'
    ];


    public function __construct(
        Kinship $kinship
    ) {
        $this->model = $kinship;
    }

    public function listKinships()
    {
        return $this->model->where('STATE', 'A')->get($this->columns);
    }
}