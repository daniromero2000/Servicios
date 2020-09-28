<?php

namespace App\Entities\ListGiveAways\Repositories;

use App\Entities\ListGiveAways\ListGiveAway;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use Illuminate\Database\QueryException;

class ListGiveAwayRepository implements ListGiveAwayRepositoryInterface
{
    private $columns = [
        'base_give_aways',
        'increment',
        'base_cost',
        'total',
        '?'
    ];

    public function __construct(
        ListGiveAway $ListGiveAway
    ) {
        $this->model = $ListGiveAway;
    }

    public function createListGiveAway($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllListGiveAways()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListGiveAwayById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateListGiveAway($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteListGiveAway($id)
    {
        $data = $this->findListGiveAwayById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

    public function getPriceGiveAwayProduct($productPrice)
    {
        return $this->model->where('base_give_aways', '<=', $productPrice)->orderBy('total', 'desc')->first();
    }
}