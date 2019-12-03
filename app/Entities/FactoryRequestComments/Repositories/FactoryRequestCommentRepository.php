<?php

namespace App\Entities\FactoryRequestComments\Repositories;

use App\Entities\FactoryRequestComments\FactoryRequestComment;
use App\Entities\FactoryRequestComments\Repositories\Interfaces\FactoryRequestCommentRepositoryInterface;
use Illuminate\Database\QueryException;

class FactoryRequestCommentRepository implements FactoryRequestCommentRepositoryInterface
{
    public function __construct(
        FactoryRequestComment $Comment
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

    public function findCommentById(int $id): FactoryRequestComment
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentByName($name): FactoryRequestComment
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
