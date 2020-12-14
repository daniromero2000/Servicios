<?php

namespace App\Entities\Documents\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;
use App\Entities\Documents\Document;
use Illuminate\Database\Eloquent\Collection;

interface DocumentRepositoryInterface
{
    public function listDocuments($totalView);

    public function createDocument(array $params): Document;

    public function updateDocument(array $params): Document;

    public function findDocumentById(int $id): Document;

    public function deleteDocument(): bool;
    
    public function saveDocumentFile(UploadedFile $file): string;

    public function searchDocument(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countDocuments(string $text = null,  $from = null, $to = null);

}
