<?php

namespace App\Entities\LeadStatusesLogs\Repositories;

use App\Entities\LeadStatusesLogs\LeadStatusesLog;
use App\Entities\LeadStatusesLogs\Repositories\Interfaces\LeadStatusesLogRepositoryInterface;


class LeadStatusesLogRepository implements LeadStatusesLogRepositoryInterface
{
    /**
     * LeadStatusesLogRepository constructor.
     * @param LeadStatusesLog $LeadStatusesLog
     */
    public function __construct(LeadStatusesLog $LeadStatusesLog)
    {
        parent::__construct($LeadStatusesLog);
        $this->model = $LeadStatusesLog;
    }
}
