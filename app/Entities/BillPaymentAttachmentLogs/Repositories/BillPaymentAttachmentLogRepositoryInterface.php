<?php

namespace App\Entities\BillPaymentAttachmentLogs\Repositories;

use App\Entities\BillPaymentAttachmentLogs\BillPaymentAttachmentLog;

interface BillPaymentAttachmentLogRepositoryInterface
{
    public function listBillPaymentAttachmentLogs($id);

    public function createBillPaymentAttachmentLog(array $data): BillPaymentAttachmentLog;

    public function findBillPaymentAttachmentLogById(int $id): BillPaymentAttachmentLog;

    public function deleteNotificationById($id): bool;

    public function updateBillPaymentAttachmentLog(array $params): bool;
}
