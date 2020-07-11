<?php

namespace App\Entities\CifinFinancialArrears\Repositories\Interfaces;

interface CifinFinancialArrearRepositoryInterface
{
  public function checkCustomerHasCifinFinancialArrear($identificationNumber, $lastConsult);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasCifinFinancialDoubtful($identificationNumber, $lastConsult);

  public function getCustomerEntityName($identificationNumber);

  public function getNameEntities($nameEntities);

  public function getCustomerEntityNameHousingCredit($identificationNumber);

  public function getNameEntitiesHousingCredit($nameEntities);
}
