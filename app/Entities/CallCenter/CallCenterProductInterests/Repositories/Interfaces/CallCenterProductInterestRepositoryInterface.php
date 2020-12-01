<?php

namespace Entities\CallCenter\CallCenterProductInterests\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterProductInterestRepositoryInterface
{
    public function createCallCenterProductInterest(array $data);

    public function updateCallCenterProductInterest(array $data);

    public function listCallCenterProductInterests($totalView): Support;
}
