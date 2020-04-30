<?php

namespace App\Entities\Brands\Repositories;

use App\Entities\Brands\Brand;
use App\Entities\Products\Product;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;

interface BrandRepositoryInterface
{
    public function createBrand(array $data): Brand;

    public function findBrandById(int $id): Brand;

    public function updateBrand(array $data): bool;

    public function deleteBrand(): bool;

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function saveProduct(Product $product);

    public function saveCoverImage(UploadedFile $file): string;
}
