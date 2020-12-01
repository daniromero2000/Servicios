<?php

namespace Entities\CallCenter\CallCenterPaymentPromises\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterPaymentPromiseRepositoryInterface
{
    public function createCallCenterPaymentPromise(array $data);

    public function updateCallCenterPaymentPromise(array $data);

    public function listCallCenterPaymentPromises($totalView): Support;
}
