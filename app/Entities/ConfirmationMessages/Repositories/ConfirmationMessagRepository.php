<?php

namespace App\Entities\ConfirmationMessags\Repositories;

use App\Entities\ConfirmationMessags\ConfirmationMessag;
use App\Entities\ConfirmationMessags\Repositories\Interfaces\ConfirmationMessagRepositoryInterface;
use Illuminate\Database\QueryException;

class ConfirmationMessagRepository implements ConfirmationMessagRepositoryInterface
{
    public function __construct(
        ConfirmationMessag $ConfirmationMessag
    ) {
        $this->model = $ConfirmationMessag;
    }

    public function findConfirmationMessagById(int $id): ConfirmationMessag
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
