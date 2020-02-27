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

    public function createAppError($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
