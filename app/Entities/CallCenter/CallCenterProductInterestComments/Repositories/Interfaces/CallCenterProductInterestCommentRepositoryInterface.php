<?php

namespace Entities\CallCenter\CallCenterProductInterestComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterProductInterestCommentRepositoryInterface
{
    public function createCallCenterProductInterestComment(array $data);

    public function updateCallCenterProductInterestComment(array $data);

    public function listCallCenterProductInterestComments($totalView): Support;
}
