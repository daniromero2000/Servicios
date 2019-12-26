<?php

namespace App\Entities\FactoryRequestStatuses\Repositories;

use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\FactoryRequestStatuses\Repositories\Interfaces\FactoryRequestStatusRepositoryInterface;

class FactoryRequestStatusRepository implements FactoryRequestStatusRepositoryInterface
{
    public function __construct(
        FactoryRequestStatus $FactoryRequestStatus
    ) {
        $this->model = $FactoryRequestStatus;
    }
}
