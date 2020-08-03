<?php

namespace App\Entities\ConfrontaResults\Repositories;

use App\Entities\ConfrontaResults\ConfrontaResult;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use Illuminate\Database\QueryException;

class ConfrontaResultRepository implements ConfrontaResultRepositoryInterface
{
    private $columns = [
        'id',
        'confron_form_id',
        'hits',
        'created_at',
        'updated_at',
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
}
