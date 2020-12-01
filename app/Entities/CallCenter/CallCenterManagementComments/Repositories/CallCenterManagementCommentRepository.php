<?php

namespace Modules\CallCenter\Entities\CallCenterManagementComments\Repositories;

use Modules\CallCenter\Entities\CallCenterManagementComments\Repositories\Interfaces\CallCenterManagementCommentRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterManagementComments\CallCenterManagementComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;


class CallCenterManagementCommentRepository implements CallCenterManagementCommentRepositoryInterface 
{
    private $columns = [
        'id',
        'callcenter_management_id',
        'comment',
        'employee_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterManagementComment $callCenterManagementComment)
    {
        $this->model = $callCenterManagementComment;
    }

    public function createcallCenterManagementComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterManagementComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterManagementComments($totalView): Support
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
