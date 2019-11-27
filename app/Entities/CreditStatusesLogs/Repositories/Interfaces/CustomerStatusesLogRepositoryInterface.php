<?php

namespace Modules\Customers\Entities\CreditStatusesLogs\Repositories\Interfaces;

use Modules\Customers\Entities\CreditStatusesLogs\CreditStatusesLog;


interface CreditStatusesLogRepositoryInterface
{
    public function createCreditStatusesLog(array $params): CreditStatusesLog;
}
