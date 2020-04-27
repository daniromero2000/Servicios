<?php

namespace App\Entities\Products\Repositories\Interfaces;

use App\Entities\AttributeValues\AttributeValue;
use App\Entities\Brands\Brand;
use App\Entities\ProductAttributes\ProductAttribute;
use App\Entities\Products\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection;

    public function createProduct(array $data): Product;

    public function updateProduct(array $data): bool;

    public function findProductById(int $id): Product;

    public function deleteProduct(Product $product): bool;

    public function removeProduct(): bool;

    public function deleteFile(array $file, $disk = null): bool;

    public function deleteThumb(string $src): bool;

    public function findProductBySlug(array $slug): Product;

    public function searchProduct(string $text): Collection;

    public function findProductImages(): Collection;

    public function saveCoverImage(UploadedFile $file): string;

    public function saveProductImages(Collection $collection);

    public function saveBrand(Brand $brand);

    public function findBrand();
}
