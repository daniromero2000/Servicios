<?php

namespace App\Entities\Intentions\Repositories\Interfaces;

use App\Entities\Intentions\Intention;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

interface IntentionRepositoryInterface
{
  public function createIntention($data): Intention;

  public function findCustomerIntentionById($id): Intention;

  public function listIntentions($totalView): Support;

  public function searchIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $status = null): Collection;
}
