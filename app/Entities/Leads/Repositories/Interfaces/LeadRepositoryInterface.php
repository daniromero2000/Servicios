<?php

namespace App\Entities\Leads\Repositories\Interfaces;

use App\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function getLeadChannel($cedula);

    public function findLeadById(int $id): Lead;

    public function updateLead(array $params): bool;

    public function countLeadChannels($from, $to);

    public function countLeadStatuses($from, $to);

    public function countLeadAssessors($from, $to);

    public function countLeadProducts($from, $to);

    public function countLeadServices($from, $to);

    public function listleads($totalView): Support;

    public function getLeadPriceTotal($from, $to);

    public function findLeadByIdFull(int $id): Lead;

    public function searchLeads(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $city = null): Collection;
}
