<?php

namespace App\Entities\FactoryRequestProducts\Repositories;

use App\Entities\FactoryRequestProducts\FactoryRequestProduct;
use App\Entities\FactoryRequestProducts\Repositories\Interfaces\FactoryRequestProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class FactoryRequestProduct2Repository implements FactoryRequestProductRepositoryInterface
{
    public function __construct(
        FactoryRequestProduct $Comment
    ) {
        $this->model = $Comment;
    }

    public function createNote(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findCommentById(int $id): FactoryRequestProduct
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentByName($name): FactoryRequestProduct
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
