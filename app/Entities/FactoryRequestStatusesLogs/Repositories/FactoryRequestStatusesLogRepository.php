<?php

namespace App\Entities\FactoryRequestStatusesLogs\Repositories;

use App\Entities\FactoryRequestStatusesLogs\FactoryRequestStatusesLog;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use Doctrine\DBAL\Query\QueryException;

class FactoryRequestStatusesLogRepository implements FactoryRequestStatusesLogRepositoryInterface
{
    public function __construct(
        FactoryRequestStatusesLog $factoryRequestStatusesLog
    ) {
        $this->model = $factoryRequestStatusesLog;
    }

    public function addFactoryRequestStatusesLog($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
