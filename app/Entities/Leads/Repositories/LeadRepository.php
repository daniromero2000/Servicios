<?php

namespace App\Entities\Leads\Repositories;

use App\Entities\Leads\Lead;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Database\QueryException;

class LeadRepository implements LeadRepositoryInterface
{
    public function __construct(
        lead $lead
    ) {
        $this->model = $lead;
    }

    public function createLead(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLeadChannel($cedula)
    {
        try {
            return $this->model->where('identificationNumber', $cedula)->get(['channel', 'id', 'state']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadById(int $id): Lead
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLead(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
