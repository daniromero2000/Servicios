<?php

namespace App\Entities\CustomerComments\Repositories\Interfaces;

use App\Entities\CustomerComments\CustomerComment;

interface CustomerCommentRepositoryInterface
{
    public function createComment(array $data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): CustomerComment;

    public function findCommentByName($name): CustomerComment;
}
