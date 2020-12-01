<?php

namespace Entities\CallCenter\CallCenterLeads\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterLeadRepositoryInterface
{
    public function createCallCenterLead(array $data);

    public function updateCallCenterLead(array $data);

    public function listCallCenterLeads($totalView): Support;
}
