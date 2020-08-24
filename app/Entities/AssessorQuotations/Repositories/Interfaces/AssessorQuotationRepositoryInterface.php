<?php

namespace App\Entities\AssessorQuotations\Repositories\Interfaces;

use App\Entities\AssessorQuotations\AssessorQuotation;
use Illuminate\Database\Eloquent\Collection;

interface AssessorQuotationRepositoryInterface
{
  public function listAssessorQuotations($from, $to);

  public function createAssessorQuotations($data);
}