<?php

namespace Modules\CallCenter\Entities\CallCenterAssignments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterAssignmentRepositoryInterface
{
    public function createCallCenterAssignment(array $data);

    public function updateCallCenterAssignment(array $data);

    public function listCallCenterAssignments($totalView): Support;
}
