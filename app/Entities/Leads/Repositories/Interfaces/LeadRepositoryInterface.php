<?php

namespace App\Entities\Leads\Repositories\Interfaces;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function getLeadChannel($cedula);
}
