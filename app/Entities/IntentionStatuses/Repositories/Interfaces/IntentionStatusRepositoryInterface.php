<?php

namespace App\Entities\IntentionStatuses\Repositories\Interfaces;

use App\Entities\IntentionStatuses\IntentionStatus;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

interface IntentionStatusRepositoryInterface
{
  public function createIntentionStatus($data): IntentionStatus;

  public function findLatestCustomerIntentionStatusByCedula($CEDULA): IntentionStatus;

  public function findIntentionStatusByIdFull(int $id): IntentionStatus;

  public function listIntentionStatuses($totalView): Support;

  public function countIntentionStatusesCreditProfiles($from, $to);

  public function countIntentionStatuses($from, $to);
}
