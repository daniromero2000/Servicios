<?php

namespace Modules\CallCenter\Entities\CallCenterManagements\Repositories;

use Modules\CallCenter\Entities\CallCenterManagements\Repositories\Interfaces\CallCenterManagementRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterManagements\CallCenterManagement;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterManagementRepository implements CallCenterManagementRepositoryInterface
{
    private $columns = [
        'id',
        'identity_number',
        'name_answer',
        'email_answer',
        'employee_id',
        'campaign_id',
        'script_id',
        'call_qualification_id',
        'management_indicator_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterManagement $callCenterManagement)
    {
        $this->model = $callCenterManagement;
    }

    public function createCallCenterManagement(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCallCenterManagement(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCallCenterManagements($totalView): Support
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
