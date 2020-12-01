<?php

namespace Entities\CallCenter\CallCenterCallQualifications\Repositories;

use Entities\CallCenter\CallCenterCallQualifications\Repositories\Interfaces\CallCenterCallQualificationRepositoryInterface;
use Entities\CallCenter\CallCenterCallQualifications\CallcenterCallQualification;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterCallQualificationRepository implements CallCenterCallQualificationRepositoryInterface
{
    private $columns = [
        'id',
        'qualification',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterCallQualification $callCenterCallQualification)
    {
        $this->model = $callCenterCallQualification;
    }

    public function createcallCenterCallQualification(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterCallQualification(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterCallQualifications($totalView): Support
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
