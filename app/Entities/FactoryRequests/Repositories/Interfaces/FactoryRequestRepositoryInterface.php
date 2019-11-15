<?php

namespace App\Entities\FactoryRequests\Repositories\Interfaces;

use App\Entities\FactoryRequests\FactoryRequest;

interface FactoryRequestRepositoryInterface
{
  public function findFactoryRequestById(int $id): FactoryRequest;

  public function listFactoryRequestDigitalChannel();
}
