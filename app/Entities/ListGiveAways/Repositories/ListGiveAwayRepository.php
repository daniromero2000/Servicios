<?php

namespace App\Entities\ListGiveAways\Repositories;

use App\Entities\ListGiveAways\ListGiveAway;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use Illuminate\Database\QueryException;

class ListGiveAwayRepository implements ListGiveAwayRepositoryInterface
{
    public function __construct(
        ListGiveAway $ListGiveAway
    ) {
        $this->model = $ListGiveAway;
    }
}
