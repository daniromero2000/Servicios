<?php

namespace App\Entities\Subsidiaries\Repositories\Interfaces;

interface SubsidiaryRepositoryInterface
{
    public function getAllSubsidiaryCityNames();

    public function getSubsidiaryCityByCode($code);
}
