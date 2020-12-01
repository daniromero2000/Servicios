<?php

namespace Entities\CallCenter\CallCenterLeads\Repositories;

use Entities\CallCenter\CallCenterLeads\Repositories\Interfaces\CallCenterLeadRepositoryInterface;
use Entities\CallCenter\CallCenterLeads\CallCenterLead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterLeadRepository implements CallCenterLeadRepositoryInterface
{
    private $columns = [
        'id',
        'identity_number',
        'name',
        'last_name',
        'email',
        'address',
        'city',
        'phone',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterLead $callCenterLead)
    {
        $this->model = $callCenterLead;
    }

    public function createCallCenterLead(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCallCenterLead(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCallCenterLeads($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
