<?php

namespace App\Entities\FactoryRequestStatusesLogs\Repositories;

use App\Entities\FactoryRequestStatusesLogs\FactoryRequestStatusesLog;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;

class FactoryRequestStatusesLogRepository implements FactoryRequestStatusesLogRepositoryInterface
{
    public function __construct(
        FactoryRequestStatusesLog $factoryRequestStatusesLog
    ) {
        $this->model = $factoryRequestStatusesLog;
    }
}
