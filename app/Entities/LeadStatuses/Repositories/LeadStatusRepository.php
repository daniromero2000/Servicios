<?php

namespace App\Entities\LeadStatuses\Repositories;

use App\Entities\LeadStatuses\LeadStatus;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Illuminate\Database\QueryException;

class LeadStatusRepository implements LeadStatusRepositoryInterface
{
    public function __construct(LeadStatus $LeadStatus)
    {
        $this->model = $LeadStatus;
    }

    public function getAllLeadStatusesNames()
    {
        try {
            return $this->model->orderBy('status', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
    
}
