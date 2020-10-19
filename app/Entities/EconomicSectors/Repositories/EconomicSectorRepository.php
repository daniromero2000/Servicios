<?php

namespace App\Entities\EconomicSectors\Repositories;

use App\Entities\EconomicSectors\EconomicSector;
use App\Entities\EconomicSectors\Repositories\Interfaces\EconomicSectorRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class EconomicSectorRepository implements EconomicSectorRepositoryInterface
{
    public function __construct(
        EconomicSector $economicSector
    ) {
        $this->model = $economicSector;
    }

    public function listEconomicSector(): Collection
    {
        try {
            return $this->model->where('status', 1)->get();
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
