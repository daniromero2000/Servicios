<?php

namespace App\Entities\FactoryRequestNotes\Repositories\Interfaces;

use App\Entities\FactoryRequestNotes\FactoryRequestNote;

interface FactoryRequestNoteRepositoryInterface
{
    public function createComment(array $data);

    public function updateComment(array $params): bool;

    public function findCommentById(int $id): FactoryRequestNote;

    public function findCommentByName($name): FactoryRequestNote;
}
