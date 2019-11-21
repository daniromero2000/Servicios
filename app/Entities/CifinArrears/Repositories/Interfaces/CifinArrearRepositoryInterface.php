<?php

namespace App\Entities\CifinArrears\Repositories\Interfaces;

interface CifinArrearRepositoryInterface
{
  public function checkCustomerHasUpToDateCifin($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);
}
