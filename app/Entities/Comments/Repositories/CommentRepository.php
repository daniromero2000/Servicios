<?php

namespace App\Entities\Comments\Repositories;

use App\Entities\Comments\Comment;
use App\Entities\Comments\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\QueryException;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        Comment $Comment
    ) {
        $this->model = $Comment;
    }

    public function createComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentById(int $id): Comment
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentByName($name): Comment
    {
        try {
            return $this->model->findOrFail($name);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateComment(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
