<?php

namespace App\Entities\BillPaymentStatusesLogs\Repositories;

use App\Entities\BillPaymentStatusesLogs\BillPaymentStatusesLog;

interface BillPaymentStatusesLogRepositoryInterface
{
    public function listBillPaymentStatusesLogs($id);

    public function createBillPaymentStatusesLog(array $data): BillPaymentStatusesLog;

    public function findBillPaymentStatusesLogById(int $id): BillPaymentStatusesLog;

    public function deleteNotificationById($id): bool;

    public function updateBillPaymentStatusesLog(array $params): bool;
}
