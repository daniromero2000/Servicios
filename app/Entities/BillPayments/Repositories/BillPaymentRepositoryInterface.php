<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;

interface BillPaymentRepositoryInterface
{
    public function listBillPayments($id);

    public function createBillPayment(array $data): BillPayment;

    public function searchBillPayment(string $text = null, int $totalView, $from = null, $to = null): array;

    public function countBillPayments(string $text = null,  $from = null, $to = null);

    public function findBillPaymentById(int $id): BillPayment;

    public function deleteNotificationById($id): bool;
}
