<?php

namespace App\Entities\BillPayments\Services\Interfaces;

interface BillPaymentServiceInterface
{
    public function listBillPayments(array $data): array;

    public function createBillPayment();

    public function findBillPaymentById(int $id);

    public function saveBillPayment(array $data): bool;

    public function deleteNotificationById($id): bool;
}
