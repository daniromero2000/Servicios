<?php

namespace App\Entities\Intentions\Repositories\Interfaces;

use App\Entities\Intentions\Intention;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

interface IntentionRepositoryInterface
{
  public function createIntention($data): Intention;

  public function updateOrCreateIntention($data);

  public function findLatestCustomerIntentionByCedula($CEDULA): Intention;

  public function findIntentionByIdFull(int $id): Intention;

  public function listIntentions($totalView): Support;

  public function listIntentionAssessors($totalView, $assessor): Support;

  public function countIntentionsCreditProfiles($from, $to);

  public function countIntentionsCreditCards($from, $to);

  public function countIntentionsStatuses($from, $to);

  public function searchIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null): Collection;

  public function searchIntentionAssessors(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null, $assessor): Collection;
}