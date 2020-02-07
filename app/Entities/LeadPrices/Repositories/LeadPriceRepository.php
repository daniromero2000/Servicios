<?php

namespace App\Entities\LeadPrices\Repositories;

use App\Entities\LeadPrices\LeadPrice;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LeadPriceRepository implements LeadPriceRepositoryInterface
{
    public function __construct(
        LeadPrice $LeadPrice
    ) {
        $this->model = $LeadPrice;
    }

    public function createLeadPrice($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
    public function getLeadPriceTotal($from, $to)
    {
        try {
            return  $this->model->whereBetween('updated_at', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findLeadPriceById(int $id): LeadPrice
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadPriceByName($name): LeadPrice
    {
        try {
            return $this->model->findOrFail($name);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadPrice($params)
    {

        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getPriceDigitalChanel($from, $to, $num)
    {

        try {
            return $this->model->where('lead_price_status_id', $num)
                ->whereBetween('updated_at', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}