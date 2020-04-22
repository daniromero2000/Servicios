<?php

namespace App\Entities\Factors\Repositories;

use App\Entities\Factors\Factor;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class FactorRepository implements FactorRepositoryInterface
{
    private $columns = [
        'creation_user_id',
        'name',
        'value',
        'checked',
        'checked_user_id',
        'start_date',
        'end_date'
    ];

    public function __construct(
        Factor $factor
    ) {
        $this->model = $factor;
    }

    public function createFactor($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllFactors()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findFactorById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateFactor($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteFactor($id)
    {
        $data = $this->findFactorById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }
}