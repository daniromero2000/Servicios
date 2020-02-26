<?php

namespace App\Entities\AppErrors\Repositories\Interfaces;


interface AppErrorRepositoryInterface
{
    public function updateOrCreateAppError($data);
}
