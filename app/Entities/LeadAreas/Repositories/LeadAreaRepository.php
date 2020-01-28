<?php

namespace App\Entities\LeadAreas\Repositories;

use App\Entities\LeadAreas\LeadArea;
use App\Entities\LeadAreas\Repositories\Interfaces\LeadAreaRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LeadAreaRepository
{
    public function __construct(
        LeadArea $leadArea
    ) {
        $this->model = $leadArea;
    }

    public function createLeadPrice($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadPriceById(int $id): LeadArea
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadPriceByName($name): LeadArea
    {
        try {
            return $this->model->findOrFail($name);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadPrice($params)
    {

        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLeadAreaDigitalChanel()
    {

        try {
            return $this->model->orderBy('name', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}