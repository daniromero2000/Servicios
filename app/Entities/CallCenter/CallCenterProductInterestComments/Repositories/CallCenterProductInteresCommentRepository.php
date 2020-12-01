<?php

namespace Entities\CallCenter\CallCenterProductInterestComments\Repositories;

use Entities\CallCenter\CallCenterProductInterestComments\Repositories\Interfaces\CallCenterProductInterestCommentRepositoryInterface;
use Entities\CallCenter\CallCenterProductInterestComment\CallCenterProductInterestComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterProductInterestCommentRepository implements CallCenterProductInterestCommentRepositoryInterface
{
    private $columns = [
        'id',
        'call_center_product_interest_id',
        'comment',       
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterProductInterestComment $callCenterProductInterestComment)
    {
        $this->model = $callCenterProductInterestComment;
    }

    public function createcallCenterProductInterestComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterProductInterestComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterProductInterestComment($totalView): Support
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
