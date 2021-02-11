<?php

namespace App\Entities\TypeInvoices\Repositories;

use App\Entities\TypeInvoices\TypeInvoice;

interface TypeInvoiceRepositoryInterface
{
    public function listTypeInvoices($id): array;

    public function listAllTypeInvoices();

    public function createTypeInvoice(array $data): TypeInvoice;

    public function searchTypeInvoice(string $text = null, int $totalView, $from = null, $to = null): array;

    public function countTypeInvoices(string $text = null,  $from = null, $to = null);

    public function findTypeInvoiceById(int $id): TypeInvoice;

    public function deleteNotificationById($id): bool;
}
