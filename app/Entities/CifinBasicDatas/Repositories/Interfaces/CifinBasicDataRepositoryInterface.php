<?php

namespace App\Entities\CifinBasicDatas\Repositories\Interfaces;

interface CifinBasicDataRepositoryInterface
{
  public function checkCustomerHasCifinBasicData($identificationNumber);

  public function check12MonthsPaymentVector($identificationNumber);

  public function getCityExpedition($identificationNumber);
}
