<?php

namespace Entities\CallCenter\CallCenterSchedules\Repositories;
use Entities\CallCenter\CallCenterSchedules\Repositories\Interfaces\CallCenterScheduleRepositoryInterface;
use Entities\CallCenter\CallCenterSchedules\CallCenterSchedule;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterScheduleRepository implements CallCenterScheduleRepositoryInterface
{
    private $columns = [
        'id',
        'call_center_schedule',
        'call_center_management_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterSchedule $callCenterSchedule)
    {
        $this->model = $callCenterSchedule;
    }

    public function createcallCenterSchedule(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterSchedule(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterSchedule($totalView): Support
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
