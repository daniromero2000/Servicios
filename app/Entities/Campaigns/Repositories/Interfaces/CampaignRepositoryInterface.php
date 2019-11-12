<?php

namespace App\Entities\Campaigns\Repositories\Interfaces;

use App\Entities\Campaigns\Campaign;

interface CampaignRepositoryInterface
{
    public function createCampaign(array $data);

    public function updateCampaign(array $params): bool;

    public function findCampaignById(int $id): Campaign;

    public function findCampaignByName($name);
}
