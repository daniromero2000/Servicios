<?php

namespace App\Entities\Products\Repositories;

use App\Entities\Products\Exceptions\ProductCreateErrorException;
use App\Entities\Products\Exceptions\ProductUpdateErrorException;
use App\Entities\Tools\UploadableTrait;
use App\Entities\Brands\Brand;
use App\Entities\ProductImages\ProductImage;
use App\Entities\Products\Exceptions\ProductNotFoundException;
use App\Entities\Products\Product;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Products\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    use ProductTransformable, UploadableTrait;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->all($columns, $order, $sort);
    }

    public function createProduct(array $data): Product
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e);
        }
    }

    public function updateProduct(array $data): bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }

    public function findProductById(int $id): Product
    {
        try {
            return $this->transformProduct($this->model->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function deleteProduct(Product $product): bool
    {
        $product->images()->delete();
        return $product->delete();
    }

    public function removeProduct(): bool
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->update(['cover' => null], $file['product']);
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('product_images')->where('src', $src)->delete();
    }

    public function findProductBySlug(array $slug): Product
    {
        try {
            return $this->model->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function searchProduct(string $text): Collection
    {
        if (!empty($text)) {
            return $this->model->searchProduct($text);
        } else {
            return $this->listProducts();
        }
    }

    public function findProductImages(): Collection
    {
        return $this->model->images()->get();
    }

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    public function saveProductImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file);
            $productImage = new ProductImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    public function findBrand()
    {
        return $this->model->brand;
    }
}
