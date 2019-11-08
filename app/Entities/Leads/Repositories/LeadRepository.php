<?php

namespace App\Entities\leads\Repositories;

use App\Entities\leads\lead;
use App\Entities\leads\Repositories\Interfaces\leadRepositoryInterface;
use Illuminate\Database\QueryException;

class leadRepository implements leadRepositoryInterface
{
    public function __construct(
        lead $lead
    ) {
        $this->model = $lead;
    }

    public function createLead(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
