<?php

namespace App\Entities\LeadProducts\Repositories;

use App\Entities\LeadProducts\LeadProduct;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class LeadProductRepository implements LeadProductRepositoryInterface
{
    private $columns = [
        'id',
        'LeadProduct',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        LeadProduct $LeadProduct
    ) {
        $this->model = $LeadProduct;
    }

    public function getAllLeadProductNames()
    {
        try {
            return $this->model->orderBy('lead_product', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
