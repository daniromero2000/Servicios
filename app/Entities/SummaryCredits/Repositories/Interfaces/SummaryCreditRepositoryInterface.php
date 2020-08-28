<?php

namespace App\Entities\SummaryCredits\Repositories\Interfaces;

use App\Entities\SummaryCredits\SummaryCredit;
interface SummaryCreditRepositoryInterface
{
   public function findSummaryCredit($identificationNumber);
}
