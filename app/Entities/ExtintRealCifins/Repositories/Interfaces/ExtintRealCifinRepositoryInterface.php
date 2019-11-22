<?php

namespace App\Entities\ExtintRealCifins\Repositories\Interfaces;

interface ExtintRealCifinsRepositoryInterface
{
  public function checkCustomerHasExtintRealCifins12($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasVectors($identificationNumber);

  public function check6MonthsPaymentVector($identificationNumber);
}
