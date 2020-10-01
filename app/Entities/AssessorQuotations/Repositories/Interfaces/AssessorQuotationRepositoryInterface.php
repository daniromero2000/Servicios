<?php

namespace App\Entities\AssessorQuotations\Repositories\Interfaces;

use App\Entities\AssessorQuotations\AssessorQuotation;
use Illuminate\Database\Eloquent\Collection;

interface AssessorQuotationRepositoryInterface
{
  public function listAssessorQuotations($from, $to, $skip);

  public function createAssessorQuotations($data): AssessorQuotation;

  public function findAssessorQuotationsById($id): AssessorQuotation;

  public function searchQuotations(string $text = null, $totalView,  $from = null,  $to = null): Collection;

  public function updateAssessorQuotations($data): AssessorQuotation;
}
