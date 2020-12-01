<?php

namespace Entities\CallCenter\CallCenterScripts\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterScriptRepositoryInterface
{
    public function createCallCenterScript(array $data);

    public function updateCallCenterScript(array $data);

    public function listCallCenterScripts($totalView): Support;
}
