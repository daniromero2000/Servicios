<?php

namespace Entities\CallCenter\CallCenterPaymentPromises\Repositories;

use Entities\CallCenter\CallCenterPaymentPromises\Repositories\Interfaces\CallCenterPaymentPromiseRepositoryInterface;
use Entities\CallCenter\CallCenterPaymentPromises\CallCenterPaymentPromise;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterPaymentPromiseRepository implements CallCenterPaymentPromiseRepositoryInterface
{
    private $columns = [
        'id',
        'payment_promise',
        'subsidiary_id',
        'call_center_management_id',
        'promise_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterPaymentPromise $callCenterPaymentPromise)
    {
        $this->model = $callCenterPaymentPromise;
    }

    public function createcallCenterPaymentPromise(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterPaymentPromise(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterPaymentPromises($totalView): Support
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
