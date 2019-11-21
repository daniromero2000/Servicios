<?php

namespace App\Entities\CifinRealArrears\Repositories\Interfaces;

interface CifinRealArrearRepositoryInterface
{
  public function checkCustomerHasCifinRealArrear($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);
}
