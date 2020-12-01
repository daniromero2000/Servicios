<?php

namespace Entities\CallCenter\CallCenterPaymentPromisesComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterPaymentPromiseCommentRepositoryInterface
{
    public function createCallCenterPaymentPromiseComment(array $data);

    public function updateCallCenterPaymentPromiseComment(array $data);

    public function listCallCenterPaymentPromiseComments($totalView): Support;
}
