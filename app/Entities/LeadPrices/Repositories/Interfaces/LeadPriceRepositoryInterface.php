<?php

namespace App\Entities\LeadPrices\Repositories\Interfaces;

use App\Entities\LeadPrices\LeadPrice;

interface LeadPriceRepositoryInterface
{
    public function createLeadPrice($data);

    public function updateLeadPrice(array $params);

    public function findLeadPriceById(int $id): LeadPrice;

    public function findLeadPriceByName($name): LeadPrice;
}