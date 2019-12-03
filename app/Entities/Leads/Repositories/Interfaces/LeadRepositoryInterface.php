<?php

namespace App\Entities\Leads\Repositories\Interfaces;

use App\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function getLeadChannel($cedula);

    public function findLeadById(int $id): Lead;

    public function updateLead(array $params): bool;

    public function countLeadChannels($from, $to);

    public function countLeadStatuses($from, $to);

    public function listleads($totalView): Support;

    public function findLeadByIdFull(int $id): Lead;
}
