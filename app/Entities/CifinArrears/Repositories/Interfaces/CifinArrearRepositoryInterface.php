<?php

namespace App\Entities\CifinArrears\Repositories\Interfaces;

interface CifinArrearRepositoryInterface
{
  public function checkCustomerHasCifinArrear($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);
}
