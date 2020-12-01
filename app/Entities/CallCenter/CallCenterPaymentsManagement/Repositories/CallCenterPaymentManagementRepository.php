<?php

namespace Modules\CallCenter\Entities\CallCenterPaymentsManagement\Repositories;

use Modules\CallCenter\Entities\CallCenterPaymentsManagement\Repositories\Interfaces\CallCenterPaymentManagementRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterPaymentsManagement\CallCenterPaymentManagement;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterPaymentManagementRepository implements CallCenterPaymentManagementRepositoryInterface
{
    private $columns = [
        'id',
        'identity_number',
        'employee_id',
        'call_center_campaign_id',
        'call_center_script_id',
        'call_center_call_qualification_id',
        'call_center_management_indicator_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterPaymentManagement $callCenterPaymentManagement)
    {
        $this->model = $callCenterPaymentManagement;
    }

    public function createcallCenterPaymentManagement(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterPaymentManagement(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterPaymentManagements($totalView): Support
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
