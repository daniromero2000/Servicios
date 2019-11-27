<?php

namespace App\Entities\Subsidiaries\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;
use App\Entities\Subsidiaries\Subsidiary;

interface SubsidiaryRepositoryInterface
{
    public function getAllSubsidiaryCityNames();

    public function getSubsidiaryCityByCode($code);

    public function getSubsidiaryRiskZone($customerSubsidiary);

    public function listSubsidiares($totalView): Support;

    public function findSubsidiaryByIdFull(int $id): Subsidiary;
}
