<?php

namespace App\Entities\FactoryRequestProducts2\Repositories\Interfaces;

use App\Entities\FactoryRequestProducts\FactoryRequestProduct;

interface FactoryRequestProduct2RepositoryInterface
{
    public function createComment(array $data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): FactoryRequestProduct;

    public function findCommentByName($name): FactoryRequestProduct;
}
