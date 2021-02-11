<?php

namespace App\Entities\TypeInvoiceServices\Repositories;

use App\Entities\TypeInvoiceServices\TypeInvoiceService;

interface TypeInvoiceServiceRepositoryInterface
{
    public function listTypeInvoiceServices($id): array;

    public function listAllTypeInvoiceServices();

    public function createTypeInvoiceService(array $data): TypeInvoiceService;

    public function searchTypeInvoiceService(string $text = null, int $totalView, $from = null, $to = null): array;

    public function countTypeInvoiceServices(string $text = null,  $from = null, $to = null);

    public function findTypeInvoiceServiceById(int $id): TypeInvoiceService;

    public function deleteNotificationById($id): bool;
}
