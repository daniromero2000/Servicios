<?php

namespace App\Entities\Comments\Repositories\Interfaces;

use App\Entities\Comments\Comment;

interface CommentRepositoryInterface
{
    public function createComment($data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): Comment;

    public function findCommentByName($name): Comment;
}
