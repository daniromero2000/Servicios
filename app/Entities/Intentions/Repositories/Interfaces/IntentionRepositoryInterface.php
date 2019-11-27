<?php

namespace App\Entities\Intentions\Repositories\Interfaces;

use App\Entities\Intentions\Intention;

interface IntentionRepositoryInterface
{
  public function createIntention($data): Intention;

  public function findCustomerIntentionById($id): Intention;
}
