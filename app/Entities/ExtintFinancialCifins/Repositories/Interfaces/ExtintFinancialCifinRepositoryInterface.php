<?php

namespace App\Entities\ExtintFinancialCifins\Repositories\Interfaces;

interface ExtintFinancialCifinRepositoryInterface
{
  public function checkCustomerHasExtintFinancialCifin12($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasVectors($identificationNumber);

  public function check6MonthsPaymentVector($identificationNumber);

  public function getCustomerEntityName($identificationNumber);

  public function getNameEntities($nameEntities);

  public function getCustomerEntityNameHousingCredit($identificationNumber);

  public function getNameEntitiesHousingCredit($nameEntities);
}
