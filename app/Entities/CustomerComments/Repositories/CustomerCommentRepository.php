<?php

namespace App\Entities\CustomerComments\Repositories;

use App\Entities\CustomerComments\CustomerComment;
use App\Entities\CustomerComments\Repositories\Interfaces\CustomerCommentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CustomerCommentRepository implements CustomerCommentRepositoryInterface
{
    public function __construct(
        CustomerComment $Comment
    ) {
        $this->model = $Comment;
    }

    public function createComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findCommentById(int $id): CustomerComment
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentByName($name): CustomerComment
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
