<?php

namespace App\Entities\CurrentCredits\Repositories\Interfaces;

use App\Entities\CurrentCredits\CurrentCredit;

interface CurrentCreditRepositoryInterface
{
   public function findCurrentCredit($identificationNumber);
}