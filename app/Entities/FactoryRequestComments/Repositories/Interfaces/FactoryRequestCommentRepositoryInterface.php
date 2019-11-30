<?php

namespace App\Entities\FactoryRequestComments\Repositories\Interfaces;

use App\Entities\FactoryRequestComments\FactoryRequestComment;

interface FactoryRequestCommentRepositoryInterface
{
    public function createComment(array $data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): FactoryRequestComment;

    public function findCommentByName($name): FactoryRequestComment;
}
