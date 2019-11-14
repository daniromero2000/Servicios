<?php

namespace App\Entities\Intentions\Repositories;

use App\Entities\Intentions\Intention;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;

class IntentionRepository implements IntentionRepositoryInterface
{
    public function __construct(
        Intention $intention
    ) {
        $this->model = $intention;
    }
}
