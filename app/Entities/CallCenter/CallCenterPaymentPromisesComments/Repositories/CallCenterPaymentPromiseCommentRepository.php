<?php

namespace Entities\CallCenter\CallCenterPaymentPromisesComments\Repositories;

use Entities\CallCenter\CallCenterPaymentPromisesComments\Repositories\Interfaces\CallCenterPaymentPromiseCommentRepositoryInterface;
use Entities\CallCenter\CallCenterPaymentPromisesComments\CallCenterPaymentPromiseComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterPaymentPromiseCommentRepository implements CallCenterPaymentPromiseCommentRepositoryInterface
{
    private $columns = [
        'id',
        'call_center_payment_promise_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterPaymentPromiseComment $callCenterPaymentPromiseComment)
    {
        $this->model = $callCenterPaymentPromiseComment;
    }

    public function createcallCenterPaymentPromiseComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterPaymentPromiseComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterPaymentPromiseComments($totalView): Support
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
