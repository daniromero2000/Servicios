<?php

namespace App\Entities\MailsBillPayments\Services\Interfaces;

interface MailsBillPaymentServiceInterface
{
    public function listMailsBillPayments(array $data): array;

    public function createMailsBillPayment();

    public function findMailsBillPaymentById(int $id);

    public function saveMailsBillPayment(array $data): bool;

    public function deleteNotificationById($id): bool;
}
