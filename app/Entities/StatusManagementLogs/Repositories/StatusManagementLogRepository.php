<?php

namespace App\Entities\StatusManagementLogs\Repositories;

use App\Entities\StatusManagementLogs\StatusManagementLog;
use App\Entities\StatusManagementLogs\Repositories\Interfaces\StatusManagementLogRepositoryInterface;


class StatusManagementLogRepository implements StatusManagementLogRepositoryInterface
{
    /**
     * StatusManagementLogRepository constructor.
     * @param StatusManagementLog $StatusManagementLog
     */
    public function __construct(StatusManagementLog $StatusManagementLog)
    {
        $this->model = $StatusManagementLog;
    }
}
