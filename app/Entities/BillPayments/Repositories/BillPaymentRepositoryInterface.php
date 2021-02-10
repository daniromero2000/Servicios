<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;
use App\Entities\Products\Product;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;

interface BillPaymentRepositoryInterface
{
    public function createBillPayment(array $data): BillPayment;

    public function findBillPaymentById(int $id): BillPayment;

    public function updateBillPayment(array $data): bool;

    public function deleteBillPayment(): bool;

    public function listBillPayments($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function saveProduct(Product $product);

    public function saveCoverImage(UploadedFile $file): string;
}
