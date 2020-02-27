<?php

namespace App\Entities\AppErrors\Repositories;

use App\Entities\AppErrors\AppError;
use App\Entities\AppErrors\Repositories\Interfaces\AppErrorRepositoryInterface;
use Illuminate\Database\QueryException;

class AppErrorRepository implements AppErrorRepositoryInterface
{
    public function __construct(
        AppError $appError
    ) {
        $this->model = $appError;
    }

    public function listAppErrors($totalView)
    {
        try {
            return  $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createAppError($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}