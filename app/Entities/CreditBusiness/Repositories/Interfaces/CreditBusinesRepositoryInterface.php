<?php

namespace App\Entities\CreditBusiness\Repositories\Interfaces;

use App\Entities\CreditBusiness\CreditBusines;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface CreditBusinesRepositoryInterface
{
    public function listCreditBusiness($totalView): Support;
}