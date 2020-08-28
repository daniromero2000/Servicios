<?php

namespace App\Entities\Plans\Repositories;

use App\Entities\Plans\Plan;
use App\Entities\Plans\Repositories\Interfaces\PlanRepositoryInterface;
use Illuminate\Database\QueryException;

class PlanRepository implements PlanRepositoryInterface
{
    public function __construct(Plan $plans)
    {
        $this->model = $plans;
    }
    public function listPlan()
    {
        try {
            return  $this->model->orderBy('CODIGO', 'asc')
                ->where('STATE', 'A')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}