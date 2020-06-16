<?php

namespace App\Entities\Leads\Repositories\Interfaces;

use App\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function findLeadByAssessorFull($id);

    public function getLeadChannel($cedula);

    public function findLeadById(int $id): Lead;

    public function findLeadByTelephone(int $telephone);

    public function findLeadDelete(int $id): Lead;

    public function updateLead(array $params): bool;

    public function countLeadChannels($from, $to);

    public function countLeadTotal($from, $to);

    public function countLeadTotalSlopes($from, $to, $assessor);

    public function listleadSlopes($totalView, $assessor);

    public function countLeadStatuses($from, $to);

    public function countLeadStatusGenerals($from, $to, $area);

    public function countLeadAssessors($from, $to);

    public function countLeadAssessorsForCallCenter($from, $to);

    public function countLeadProductGenerals($from, $to, $area);

    public function countLeadProductSubsidiary($from, $to);

    public function countLeadProducts($from, $to);

    public function countLeadServices($from, $to);

    public function countLeadServicesGenerals($from, $to, $area);

    public function countLeadServicesSubsidiary($from, $to);

    public function countLeadStatusSubsidiary($from, $to);

    public function countSubsidiary($from, $to);

    public function listleads($totalView): Support;

    public function listLeadAssessors($totalView, $assessor): Support;

    public function customListleads($totalView, $service);

    public function countLeadsAssessors($from, $to, $assessor);

    public function customListleadsTotal($from, $to, $area);

    public function getLeadPriceTotal($from, $to);

    public function findLeadByIdFull(int $id): Lead;

    public function searchLeads(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $assessor = null,  $channel = null, $city = null, $area = null, $service = null, $product = null): Collection;

    public function searchCustomLeads(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $assessor = null, $city = null, $area = null, $service = null, $product = null): Collection;

    public function countLeadForSubsidiary($from, $to, $subsidiary);

    public function countLeadProductForSubsidiary($from, $to, $area, $subsidiary);

    public function countLeadServicesForSubsidiary($from, $to, $area, $subsidiary);

    public function countLeadStatusForSubsidiary($from, $to, $area, $subsidiary);

    public function countLeadsSubsidiary($from, $to, $subsidiary);

    public function listLeadSubsidiary($totalView, $subsidiary);

    public function countLeadsSubsidiaries($from, $to);

    public function listLeadSubsidiaries($totalView, $subsidiary);

    public function searchLeadsSubsidiaries(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $assessor = null, $channel = null, $city = null, $area = null, $service = null, $product = null, $subsidiary = null): Collection;
}