<?php

namespace App\Entities\LeadAreas\Repositories\Interfaces;

use App\Entities\LeadAreas\LeadArea;


interface LeadAreaRepositoryInterface
{
    public function createLeadPrice($data);

    public function updateLeadPrice($params);

    public function findLeadPriceById(int $id): LeadArea;

    public function getPriceDigitalChanel($from, $to, $num);

    public function findLeadPriceByName($name): LeadArea;
}