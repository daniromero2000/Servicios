<?php

namespace App\Entities\AppErrors\Repositories\Interfaces;


interface AppErrorRepositoryInterface
{
    public function listAppErrors($totalView);

    public function createAppError($data);
}