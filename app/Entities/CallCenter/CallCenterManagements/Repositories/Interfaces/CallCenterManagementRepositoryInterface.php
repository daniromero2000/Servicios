<?php

namespace Modules\CallCenter\Entities\CallCenterManagements\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterManagementRepositoryInterface
{
    public function createCallCenterManagement(array $data);

    public function updateCallCenterManagement(array $data);

    public function listCallCenterManagement($totalView): Support;
}
