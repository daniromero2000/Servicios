<?php

namespace App\Entities\FactoryRequests\Repositories\Interfaces;

interface FactoryRequestRepositoryInterface
{
  public function findFactoryRequestById(int $id): FactoryRequest;

  public function listFactoryRequestDigitalChannel();
}
