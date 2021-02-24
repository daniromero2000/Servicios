<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;

interface BillPaymentRepositoryInterface
{
    public function listBillPayments($id);

    public function createBillPayment(array $data): BillPayment;

    public function searchBillPayment(string $text = null, int $totalView, $status = null, $payment_deadline = null , $subsidiary_id = null);

    public function countBillPayments(string $text = null,  $status = null, $payment_deadline = null , $subsidiary_id = null);

    public function findBillPaymentById(int $id): BillPayment;

    public function deleteNotificationById($id): bool;

    public function updateBillPayment(array $params);

    public function lookUpPastDueBills($day);

    public function checkOverdueInvoices($day);

    public function sendNotificationOfPastDueInvoice($mails, $data);

    public function sendNotificationOfInvoicePaid($mail, $data);

    public function getInvoicesPaid();

    public function getManagedInvoices();

    public function sendManagedInvoiceNotification($data);
}
