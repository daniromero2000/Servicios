<?php

namespace App\Entities\Intentions\Repositories\Interfaces;

use App\Entities\Intentions\Intention;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

interface IntentionRepositoryInterface
{
  public function checkIfHasIntention($cedula, $days);

  public function createIntention($data): Intention;

  public function updateOrCreateIntention($data);

  public function findLatestCustomerIntentionByCedula($CEDULA): Intention;

  public function findIntentionByIdFull(int $id): Intention;

  public function listIntentions($totalView): Support;

  public function listIntentionsTotal($from, $to);

  public function listIntentionAssessors($totalView, $assessor): Support;

  public function listJarvisIntentions($totalView): Support;

  public function countIntentionsCreditProfiles($from, $to);

  public function countIntentionAssessorCreditProfiles($from, $to, $assessor);

  public function countIntentionDirectorCreditProfiles($from, $to, $assessor);

  public function countIntentionsCreditCards($from, $to);

  public function countIntentionAssessorCreditCards($from, $to, $assessor);

  public function countIntentionDirectorCreditCards($from, $to, $assessor);

  public function countIntentionsStatuses($from, $to);

  public function countIntentionAssessorStatuses($from, $to, $assessor);

  public function countIntentionDirectorStatuses($from, $to, $assessor);

  public function searchIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null): Collection;

  public function exportIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null): Collection;

  public function searchIntentionAssessors(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null, $assessor): Collection;

  public function listIntentionDirectors($totalView, $from, $to, $status);

  public function countListIntentionDirectors($from, $to, $subsidiaris);

  public function searchIntentionDirector(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null, $assessor): Collection;

  public function validateDateIntention($identificationNumber, $daysToIncrement);

  public function getConfrontaIntentionStatus($resultConfronta);

  public function defineConfrontaCardValues($cedula);
}
