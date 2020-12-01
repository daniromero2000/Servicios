<?php

namespace Entities\CallCenter\CallCenterCallQualifications\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterCallQualificationRepositoryInterface
{
    public function createCallCenterCallQualification(array $data);

    public function updateCallCenterCallQualification(array $data);

    public function listCallCenterCallQualifications($totalView): Support;
}
