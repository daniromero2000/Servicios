<?php

namespace Modules\CallCenter\Entities\CallCenterPaymentsManagement\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterPaymentManagementRepositoryInterface
{
    public function createCallCenterPaymentManagement(array $data);

    public function updateCallCenterPaymentManagement(array $data);

    public function listCallCenterPaymentManagements($totalView): Support;
}
