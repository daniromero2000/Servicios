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

    public function updateOrCreateAppError($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
