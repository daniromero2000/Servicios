<?php

namespace App\Entities\PortfolioCollections\Repositories;

use App\Entities\PortfolioCollections\PortfolioCollection;
use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class PortfolioCollectionRepository implements PortfolioCollectionRepositoryInterface
{
    private $columns = [
     
    ];

    public function __construct(
        PortfolioCollection $PortfolioCollection
    ) {
        $this->model = $PortfolioCollection;
    }

    public function createPortfolioCollection($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllPortfolioCollections()
    {
        try {
            return $this->model->with('userChecked')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findPortfolioCollectionById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatePortfolioCollection($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deletePortfolioCollection($id)
    {
        $data = $this->findPortfolioCollectionById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

}