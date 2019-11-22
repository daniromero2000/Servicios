<?php

namespace App\Entities\UpToDateCifins\Repositories\Interfaces;

interface UpToDateCifinRepositoryInterface
{
  public function checkCustomerHasUpToDateCifin12($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function check6MonthsPaymentVector($identificationNumber);
}
