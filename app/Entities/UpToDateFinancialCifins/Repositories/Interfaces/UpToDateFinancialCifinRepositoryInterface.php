<?php

namespace App\Entities\UpToDateFinancialCifins\Repositories\Interfaces;

interface UpToDateFinancialCifinRepositoryInterface
{
  public function checkCustomerHasUpToDateFinancialCifin12($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function checkCustomerHasVectors($identificationNumber);

  public function check6MonthsPaymentVector($identificationNumber);

  public function getCustomerEntityName($identificationNumber);

  public function getNameEntities($nameEntities);
}
