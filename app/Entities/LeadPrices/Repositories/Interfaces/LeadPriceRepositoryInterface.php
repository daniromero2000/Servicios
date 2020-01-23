<?php

namespace App\Entities\LeadPrices\Repositories\Interfaces;

use App\Entities\LeadPrices\LeadPrice;

interface LeadPriceRepositoryInterface
{
    public function createLeadPrice($data);

    public function updateLeadPrice($params);

    public function findLeadPriceById(int $id): LeadPrice;

    public function getPriceDigitalChanel($from, $to, $num);

    public function findLeadPriceByName($name): LeadPrice;
}