<?php

namespace Entities\CallCenter\CallCenterSchedules\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterScheduleRepositoryInterface
{
    public function createCallCenterSchedule(array $data);

    public function updateCallCenterSchedule(array $data);

    public function listCallCenterSchedules($totalView): Support;
}
