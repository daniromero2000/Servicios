<?php

namespace Modules\CallCenter\Entities\CallCenterManagementComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterManagementCommentRepositoryInterface
{
    public function createCallCenterManagementComment(array $data);

    public function updateCallCenterManagementComment(array $data);

    public function listCallCenterManagementComments($totalView): Support;
}
