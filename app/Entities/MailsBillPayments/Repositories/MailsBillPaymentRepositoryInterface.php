<?php

namespace App\Entities\MailsBillPayments\Repositories;

use App\Entities\MailsBillPayments\MailsBillPayment;

interface MailsBillPaymentRepositoryInterface
{
    public function listMailsBillPayments($id);

    public function createMailsBillPayment(array $data): MailsBillPayment;

    public function searchMailsBillPayment(string $text = null, int $totalView, $from = null, $to = null);

    public function countMailsBillPayments(string $text = null,  $from = null, $to = null);

    public function findMailsBillPaymentById(int $id): MailsBillPayment;

    public function deleteNotificationById($id): bool;
}
