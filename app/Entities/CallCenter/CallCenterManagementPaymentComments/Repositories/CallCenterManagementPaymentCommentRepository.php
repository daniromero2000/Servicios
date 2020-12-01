<?php

namespace Modules\CallCenter\Entities\CallCenterManagementPaymentComments\Repositories;
use Modules\CallCenter\Entities\CallCenterManagementPaymentComment\Repositories\Interfaces\CallCenterManagementPaymentCommentRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterManagementPaymentComments\CallCenterManagementPaymentComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterManagementPaymentCommentRepository implements CallCenterManagementPaymentCommentRepositoryInterface
{
    private $columns = [
        'id',
        'callcenter_payment_management_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterManagementPaymentComment $callCenterManagementPaymentComment)
    {
        $this->model = $callCenterManagementPaymentComment;
    }

    public function createCallCenterManagementPaymentComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCallCenterManagementPaymentComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCallCenterManagementPaymentComments($totalView): Support
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
