<?php

namespace App\Entities\AssessorQuotationValues\Repositories\Interfaces;

use App\Entities\AssessorQuotationValues\AssessorQuotationValue;
use Illuminate\Database\Eloquent\Collection;

interface AssessorQuotationValueRepositoryInterface
{
  public function listAssessorQuotationValues($from, $to);
}