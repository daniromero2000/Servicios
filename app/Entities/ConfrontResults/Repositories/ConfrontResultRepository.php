<?php

namespace App\Entities\ConfrontResults\Repositories;

use App\Entities\ConfrontResults\ConfrontResult;
use App\Entities\ConfrontResults\Repositories\Interfaces\ConfrontResultRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontResultRepository implements ConfrontResultRepositoryInterface
{
    private $columns = [
        'id',
        'confron_form_id',
        'hits',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontResult $confrontResult
    ) {
        $this->model = $confrontResult;
    }

    public function createConfrontResult($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontResults()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
