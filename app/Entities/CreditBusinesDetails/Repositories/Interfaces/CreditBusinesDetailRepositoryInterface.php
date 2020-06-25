<?php

namespace App\Entities\CreditBusinesDetails\Repositories\Interfaces;

use App\Entities\CreditBusinesDetails\CreditBusinesDetail;
use Illuminate\Support\Collection as Support;

interface CreditBusinesDetailRepositoryInterface
{
    public function listCreditBusinesDetail($totalView): Support;
}