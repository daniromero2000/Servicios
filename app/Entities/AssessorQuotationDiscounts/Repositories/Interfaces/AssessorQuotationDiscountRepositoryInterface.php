<?php

namespace App\Entities\AssessorQuotationDiscounts\Repositories\Interfaces;

use App\Entities\AssessorQuotationDiscounts\AssessorQuotationDiscount;
use Illuminate\Database\Eloquent\Collection;

interface AssessorQuotationDiscountRepositoryInterface
{
  public function listAssessorQuotationDiscounts($from, $to);
}