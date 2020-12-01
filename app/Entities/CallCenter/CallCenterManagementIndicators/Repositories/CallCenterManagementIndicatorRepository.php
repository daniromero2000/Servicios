<?php

namespace Entities\CallCenter\CallCenterManagementIndicators\Repositories;

use Entities\CallCenter\CallCenterCallQualifications\Repositories\Interfaces\CallCenterCallQualificationRepositoryInterface;
use Entities\CallCenter\CallCenterManagementIndicators\CallCenterManagementIndicator;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterManagementIndicatorRepository implements CallCenterCallQualificationRepositoryInterface
{
    private $columns = [
        'id',
        'indicator',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterManagementIndicator $callCenterManagementIndicator)
    {
        $this->model = $callCenterManagementIndicator;
    }

    public function createcallCenterManagementIndicator(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterManagementIndicator(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterManagementIndicator($totalView): Support
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
