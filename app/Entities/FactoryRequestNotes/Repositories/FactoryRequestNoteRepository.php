<?php

namespace App\Entities\FactoryRequestNotes\Repositories;

use App\Entities\FactoryRequestNotes\FactoryRequestNote;
use App\Entities\FactoryRequestNotes\Repositories\Interfaces\FactoryRequestNoteRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class FactoryRequestNoteRepository implements FactoryRequestNoteRepositoryInterface
{
    public function __construct(
        FactoryRequestNote $Comment
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

    public function findCommentById(int $id): FactoryRequestNote
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCommentByName($name): FactoryRequestNote
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
