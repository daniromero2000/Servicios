<?php

namespace App\Entities\FactoryRequestProducts\Repositories\Interfaces;

use App\Entities\FactoryRequestProducts\FactoryRequestProduct;

interface FactoryRequestProductRepositoryInterface
{
    public function createComment(array $data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): FactoryRequestProduct;

    public function findCommentByName($name): FactoryRequestProduct;
}
