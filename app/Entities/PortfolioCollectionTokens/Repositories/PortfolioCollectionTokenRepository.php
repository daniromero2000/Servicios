<?php

namespace App\Entities\PortfolioCollectionTokens\Repositories;

use App\Entities\PortfolioCollectionTokens\PortfolioCollectionToken;
use App\Entities\PortfolioCollectionTokens\Repositories\Interfaces\PortfolioCollectionTokenRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class PortfolioCollectionTokenRepository implements PortfolioCollectionTokenRepositoryInterface
{
    private $columns = [
     
    ];

    public function __construct(
        PortfolioCollectionToken $PortfolioCollectionToken
    ) {
        $this->model = $PortfolioCollectionToken;
    }

    public function getPortfolioCollectionToken()
    {
        try {
            return $this->model->orderBy('created_at', 'desc')->first();
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function createPortfolioCollectionToken($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllPortfolioCollectionTokens()
    {
        try {
            return $this->model->with('userChecked')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findPortfolioCollectionTokenById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatePortfolioCollectionToken($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deletePortfolioCollectionToken($id)
    {
        $data = $this->findPortfolioCollectionTokenById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

}