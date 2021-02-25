<?php

namespace App\Entities\TelephoneBillPayments\Repositories;

use App\Entities\TelephoneBillPayments\TelephoneBillPayment;

interface TelephoneBillPaymentRepositoryInterface
{
    public function listTelephoneBillPayments($id);

    public function createTelephoneBillPayment(array $data): TelephoneBillPayment;

    public function searchTelephoneBillPayment(string $text = null, int $totalView, $from = null, $to = null);

    public function countTelephoneBillPayments(string $text = null,  $from = null, $to = null);

    public function destroyTelephoneBillPaymen($id): bool;

    public function findTelephoneBillPaymentById(int $id): TelephoneBillPayment;

    public function deleteNotificationById($id): bool;
}
