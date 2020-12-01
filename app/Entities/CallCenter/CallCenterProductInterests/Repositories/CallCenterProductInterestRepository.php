<?php

namespace Entities\CallCenter\CallCenterProductInterests\Repositories;

use Entities\CallCenter\CallCenterProductInterests\CallCenterProductInterest;
use Entities\CallCenter\CallCenterProductInterests\Repositories\Interfaces\CallCenterProductInterestRepositoryInterface;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterProductInterestRepository implements CallCenterProductInterestRepositoryInterface
{
    private $columns = [
        'id',
        'product_line_id',
        'call_center_management_id',
        'employee_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterProductInterest $callCenterProductInterest)
    {
        $this->model = $callCenterProductInterest;
    }

    public function createcallCenterProductInterest(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterProductInterest(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterProductInterests($totalView): Support
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
