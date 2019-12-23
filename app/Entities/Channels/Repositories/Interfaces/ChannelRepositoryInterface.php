<?php

namespace App\Entities\Channels\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;
use App\Entities\Channels\Channel;

interface ChannelRepositoryInterface
{
    public function getAllChannelNames();

    public function getChannelCityByCode($code);

    public function getChannelRiskZone($customerChannel);

    public function listSubsidiares($totalView): Support;

    public function findChannelByIdFull(int $id): Channel;
}
