<?php

namespace App\Entities\CifinRealArrears\Repositories\Interfaces;

interface CifinRealArrearRepositoryInterface
{
  public function checkCustomerHasCifinRealArrear($identificationNumber, $lastConsult);

  public function check12MonthsPaymentVector($identificationNumber, $lastConsult);

  public function checkCustomerHasCifinRealDoubtful($identificationNumber, $lastConsult);
}
