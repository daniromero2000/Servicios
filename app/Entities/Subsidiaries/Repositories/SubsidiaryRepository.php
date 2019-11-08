<?php

namespace App\Entities\Subsidiaries\Repositories;

use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Database\QueryException;

class SubsidiaryRepository implements SubsidiaryRepositoryInterface
{
    public function __construct(
        Subsidiary $Subsidiary
    ) {
        $this->model = $Subsidiary;
    }

    public function getAllSubsidiaryCityNames()
    {
        try {
            return $this->model->orderBy('CIUDAD', 'asc')->get(['CIUDAD']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
