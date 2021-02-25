<?php

namespace App\Entities\BillPayments\Services\Interfaces;

interface BillPaymentServiceInterface
{
    public function listBillPayments(array $data): array;

    public function listBillPaymentsForArea(array $data): array;

    public function createBillPayment();

    public function findBillPaymentById(int $id);

    public function saveBillPayment(array $data): bool;

    public function deleteBillPayment($id): bool;

    public function saveDocumentFile($data): string;

    public function updateBillPayment(array $data);

    public function checkInvoices();

    public function enableInvoicesForPayment();

    public function verifyManagedInvoices();
}
