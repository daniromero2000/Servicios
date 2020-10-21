<?php

namespace App\Entities\StatusManagements\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface StatusManagementRepositoryInterface
{
    public function getAllStatusManagements(): Collection;
}
