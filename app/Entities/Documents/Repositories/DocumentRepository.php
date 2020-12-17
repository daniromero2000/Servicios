<?php

namespace App\Entities\Documents\Repositories;

use App\Entities\Documents\Repositories\Interfaces\DocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Entities\Documents\Document;
use Illuminate\Support\Collection as Support;
use Illuminate\Http\UploadedFile;

class DocumentRepository implements DocumentRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'description',
        'downloads',
        'src',
        'is_active',
        'slug',
        'created_at'
    ];

    public function __construct(Document $Document)
    {
        $this->model = $Document;
    }

    public function listDocuments($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createDocument(array $params): Document
    {
        try {
            $data = $this->model->create($params['data']);
            if ($params['categories']) {
                $data->categories()->sync($params['categories']);
            } 
            return $data;
        } catch (QueryException $e) {
            // throw new CreateDocumentErrorException($e);
        }
    }

    public function saveDocumentFile(UploadedFile $file): string
    {
        return $file->store('documents', ['disk' => 'public']);
    }

    public function searchDocument(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listDocuments($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchDocument($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchDocument($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countDocuments(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchDocument($text, null, true, true)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->whereBetween('created_at', [$from, $to])->count();
        }

        return $this->model->searchDocument($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])->count();
    }


    public function updateDocument(array $params): Document
    {
        try {
            $data = $this->findDocumentById($params['id']);
            if ($params['categories']) {
                $data->categories()->sync($params['categories']);
            }
            $data->update($params['data']);
          
            return $data;

        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDocumentById(int $id): Document
    {
        try {
            $Document = $this->model->findOrFail($id, $this->columns);

            return $Document;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteDocument(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
