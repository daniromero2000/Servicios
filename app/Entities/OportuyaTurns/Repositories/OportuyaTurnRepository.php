<?php

namespace App\Entities\OportuyaTurns\Repositories;

use App\Entities\OportuyaTurns\OportuyaTurn;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;

class OportuyaTurnRepository implements OportuyaTurnRepositoryInterface
{
    public function __construct(OportuyaTurn $oportuyaTurn)
    {
        $this->model = $oportuyaTurn;
    }
}
