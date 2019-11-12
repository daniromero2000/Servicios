<?php

namespace App\Entities\Leads\Repositories\Interfaces;

use App\Entities\Leads\Lead;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function getLeadChannel($cedula);

    public function findLeadById(int $id): Lead;

    public function updateLead(array $params): bool;
}
