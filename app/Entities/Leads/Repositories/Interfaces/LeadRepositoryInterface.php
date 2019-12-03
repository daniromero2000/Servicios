<?php

namespace App\Entities\Leads\Repositories\Interfaces;

use App\Entities\Leads\Lead;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function getLeadChannel($cedula);

    public function findLeadById(int $id): Lead;

    public function updateLead(array $params): bool;

    public function countLeadChannels($from, $to);

    public function countLeadStatuses($from, $to);
}
