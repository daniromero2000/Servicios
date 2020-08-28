<?php

namespace App\Entities\FactorsOportudata\Repositories;

use App\Entities\FactorsOportudata\FactorsOportudata;
use App\Entities\FactorsOportudata\Repositories\Interfaces\FactorsOportudataRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class FactorsOportudataRepository implements FactorsOportudataRepositoryInterface
{
    private $columns = [
        'CUOTA',
        'FACTOR'
    ];

    public function __construct(
        FactorsOportudata $factorsOportudata
    ) {
        $this->model = $factorsOportudata;
    }

    public function listFactorsOportudata()
    {
        try {
            return $this->model->get($this->columns);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function updateFactorsOportudata($data)
    {
        try {
            foreach ($data as $key => $value) {
                $cuota = $this->model->find($data[$key]['CUOTA']);
                $accion =  $cuota->update($data[$key]);
            }
            return $accion;
        } catch (QueryException $e) {
            return $e;
        }
    }
}