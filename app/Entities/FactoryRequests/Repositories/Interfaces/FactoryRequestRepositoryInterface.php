<?php

namespace App\Entities\FactoryRequests\Repositories\Interfaces;

use App\Entities\FactoryRequests\FactoryRequest;

interface FactoryRequestRepositoryInterface
{
  public function findFactoryRequestById(int $id): FactoryRequest;

  public function getCustomerFactoryRequest($identificationNumber): FactoryRequest;

  public function listFactoryRequestDigitalChannel();

  public function checkCustomerHasFactoryRequest($identificationNumber, $timeRejectedVigency);

  public function getCustomerlatestFactoryRequest($identificationNumber, $timeRejectedVigency);
}
