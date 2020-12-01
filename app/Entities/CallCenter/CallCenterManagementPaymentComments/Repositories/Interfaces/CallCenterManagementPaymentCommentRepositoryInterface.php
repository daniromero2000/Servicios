<?php

namespace Modules\CallCenter\Entities\CallCenterManagementPaymentComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterManagementPaymentCommentRepositoryInterface
{
    public function createCallCenterManagementPaymentComment(array $data);

    public function updateCallCenterManagementPaymentComment(array $data);

    public function listCallCenterManagementPaymentComments($totalView): Support;
}
