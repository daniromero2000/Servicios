<?php

namespace App\Entities\Brands\Repositories;

use App\Entities\Brands\Brand;
use App\Entities\Brands\Exceptions\BrandNotFoundErrorException;
use App\Entities\Brands\Exceptions\CreateBrandErrorException;
use App\Entities\Brands\Exceptions\UpdateBrandErrorException;
use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use App\Entities\Tools\UploadableTrait;

class BrandRepository implements BrandRepositoryInterface
{

    use UploadableTrait;

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    public function createBrand(array $data): Brand
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBrandErrorException($e);
        }
    }

    public function findBrandById(int $id): Brand
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new BrandNotFoundErrorException($e);
        }
    }

    public function updateBrand(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBrandErrorException($e);
        }
    }

    public function deleteBrand(): bool
    {
        return $this->model->delete();
    }

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
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
            $product->brand_id = null;
            $product->save();
        });
    }

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('brands', ['disk' => 'public']);
    }
}
