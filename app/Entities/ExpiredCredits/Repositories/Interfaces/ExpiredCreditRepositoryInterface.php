<?php

namespace App\Entities\ExpiredCredits\Repositories\Interfaces;

use App\Entities\ExpiredCredits\ExpiredCredit;

interface ExpiredCreditRepositoryInterface
{
   public function findExpiredCredit($identificationNumber);
}
