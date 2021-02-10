<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;
use App\Entities\BillPayments\Exceptions\BillPaymentNotFoundErrorException;
use App\Entities\BillPayments\Exceptions\CreateBillPaymentErrorException;
use App\Entities\BillPayments\Exceptions\UpdateBillPaymentErrorException;
use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use App\Entities\Tools\UploadableTrait;

class BillPaymentRepository implements BillPaymentRepositoryInterface
{
    use UploadableTrait;

    public function __construct(BillPayment $BillPayment)
    {
        $this->model = $BillPayment;
    }

    public function createBillPayment(array $data): BillPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBillPaymentErrorException($e);
        }
    }

    public function findBillPaymentById(int $id): BillPayment
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new BillPaymentNotFoundErrorException($e);
        }
    }

    public function updateBillPayment(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBillPaymentErrorException($e);
        }
    }

    public function deleteBillPayment(): bool
    {
        return $this->model->delete();
    }

    public function listBillPayments($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->all($columns, $orderBy, $sortBy);
    }

    public function saveProduct(Product $product)
    {
        $this->model->products()->save($product);
    }

    public function dissociateProducts()
    {
        $this->model->products()->each(function (Product $product) {
            $product->BillPayment_id = null;
            $product->save();
        });
    }

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('BillPayments', ['disk' => 'public']);
    }
}
