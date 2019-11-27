<?php

namespace App\Entities\Intentions\Repositories;

use App\Entities\Intentions\Intention;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use Illuminate\Database\QueryException;

class IntentionRepository implements IntentionRepositoryInterface
{
    public function __construct(
        Intention $intention
    ) {
        $this->model = $intention;
    }

    public function createIntention($data): Intention
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function findCustomerIntentionById($id): Intention
    {
        try {
            return $this->model
                ->with(['customer', 'definition'])
                ->findOrFail($id);
        } catch (QueryException $e) {
        dd($e);
        }
    }
}
