<?php

namespace Modules\CallCenter\Entities\CallCenterCampaigns\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterCampaignRepositoryInterface
{
    public function createCallCenterCampaign(array $data);

    public function updateCallCenterCampaign(array $data);

    public function listCallCenterCampaigns($totalView): Support;
}
