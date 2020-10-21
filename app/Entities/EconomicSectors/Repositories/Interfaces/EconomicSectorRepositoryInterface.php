<?php

namespace App\Entities\EconomicSectors\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EconomicSectorRepositoryInterface
{
  public function listEconomicSector(): Collection;
}
