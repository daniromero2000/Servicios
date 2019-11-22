<?php

namespace App\Entities\UpToDateRealCifins\Repositories\Interfaces;

interface UpToDateRealCifinRepositoryInterface
{
  public function checkCustomerHasUpToDateRealCifin12($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasVectors($identificationNumber);

  public function check6MonthsPaymentVector($identificationNumber);
}
