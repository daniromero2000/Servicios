<?php

namespace App\Entities\UpToDateCifins\Repositories\Interfaces;

interface UpToDateCifinRepositoryInterface
{
  public function checkCustomerHasUpToDateCifin($identificationNumber);

  public function checkVector($identificationNumber);
}
