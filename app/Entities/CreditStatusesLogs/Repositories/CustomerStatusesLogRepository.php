<?php

namespace Modules\Customers\Entities\CreditStatusesLogs\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Modules\Customers\Entities\CreditStatusesLogs\CreditStatusesLog;
use Modules\Customers\Entities\CreditStatusesLogs\Repositories\Interfaces\CreditStatusesLogRepositoryInterface;
use Carbon\CarbonInterval;

class CreditStatusesLogRepository implements CreditStatusesLogRepositoryInterface
{

    public function __construct(
        CreditStatusesLog $CreditStatusesLog
    ) {
        $this->model = $CreditStatusesLog;
    }

    public function createCreditStatusesLog(array $attributes): CreditStatusesLog
    {
        try {
            $CreditStatusesLog = new CreditStatusesLog($attributes);
            $customerCreatedAt    = $CreditStatusesLog->customer->created_at;
            $CreditStatusesLog->time_passed = $this->customerStatusDaysPassed($customerCreatedAt);
            $CreditStatusesLog->save();

            return $CreditStatusesLog;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    private function customerStatusDaysPassed($customerCreatedAt)
    {
        return CarbonInterval::seconds($customerCreatedAt->diffInSeconds(Carbon::now()))->cascade()->forHumans();
    }
}
