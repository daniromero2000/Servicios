<?php

namespace App\Entities\ConfrontaResults\Repositories;

use App\Entities\ConfrontaResults\ConfrontaResult;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use Illuminate\Database\QueryException;

class ConfrontaResultRepository implements ConfrontaResultRepositoryInterface
{
    private $columns = [
        'consec',
        'cedula',
        'cod_resp',
        'aciertos',
        'respuesta',
        'resultado',
        'score'
    ];

    public function __construct(
        ConfrontaResult $confrontaResult
    ) {
        $this->model = $confrontaResult;
    }

    public function getAllConfrontaResults()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCustomerConfrontaResult($consec, $cedula)
    {
        try {
            return $this->model
                ->where('consec', $consec)
                ->where('cedula', $cedula)
                ->get($this->columns);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
