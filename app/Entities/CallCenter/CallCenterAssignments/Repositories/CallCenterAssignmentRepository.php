<?php

namespace Modules\CallCenter\Entities\CallCenterAssignments\Repositories;

use Modules\CallCenter\Entities\CallCenterAssignments\Repositories\Interfaces\CallCenterAssignmentRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterAssignments\CallCenterAssignment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterAssignmentRepository implements CallCenterAssignmentRepositoryInterface
{
    private $columns = [
        'id',
        'employee_id',
        'call_center_campaign_id',
        'identity_number',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterAssignment $callCenterAssignment)
    {
        $this->model = $callCenterAssignment;
    }

    public function createCallCenterAssignment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCallCenterAssignment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCallCenterAssignments($totalView): Support
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
