<?php

namespace App\Entities\StatusManagements\Repositories;

use App\Entities\StatusManagements\StatusManagement;
use App\Entities\StatusManagements\Repositories\Interfaces\StatusManagementRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class StatusManagementRepository implements StatusManagementRepositoryInterface
{
    /**
     * StatusManagementRepository constructor.
     * @param StatusManagement $StatusManagement
     */
    public function __construct(StatusManagement $statusManagement)
    {
        $this->model = $statusManagement;
    }

    public function getAllStatusManagements(): Collection
    {
        try {
            return $this->model->orderBy('consec', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
