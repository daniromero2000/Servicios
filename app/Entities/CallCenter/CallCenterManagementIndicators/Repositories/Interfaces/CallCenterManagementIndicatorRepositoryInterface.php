<?php

namespace Entities\CallCenter\CallCenterManagementIndicators\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterManagementIndicatorRepositoryInterface
{
    public function createCallCenterCallQualification(array $data);

    public function updateCallCenterCallQualification(array $data);

    public function listCallCenterCallQualifications($totalView): Support;
}
