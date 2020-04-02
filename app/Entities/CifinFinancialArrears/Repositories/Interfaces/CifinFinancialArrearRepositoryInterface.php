<?php

namespace App\Entities\CifinFinancialArrears\Repositories\Interfaces;

interface CifinFinancialArrearRepositoryInterface
{
  public function checkCustomerHasCifinFinancialArrear($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasCifinFinancialDoubtful($identificationNumber);

  public function getCustomerEntityName($identificationNumber);

  public function getNameEntities($nameEntities);
}
