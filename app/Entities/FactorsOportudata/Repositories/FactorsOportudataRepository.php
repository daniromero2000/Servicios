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

    public function createFactorsOportudata($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllFactorsOportudata()
    {
        try {
            return $this->model->with('userChecked')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findFactorsOportudataById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateFactorsOportudata($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteFactorsOportudata($id)
    {
        $data = $this->findFactorsOportudataById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

    public function getAllCurrentFactorsOportudata()
    {
        $dateNow = date("Y-m-d");
        try {
            return $this->model->where('start_date', '<=', $dateNow)->where('end_date', '>=', $dateNow)->where('checked', 1)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCurrentFactorsOportudataForZone($zone)
    {
        $dateNow = date("Y-m-d");
        try {
            return $this->model->where('start_date', '<=', $dateNow)->where('end_date', '>=', $dateNow)->where('checked', 1)->where('zone', $zone)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}