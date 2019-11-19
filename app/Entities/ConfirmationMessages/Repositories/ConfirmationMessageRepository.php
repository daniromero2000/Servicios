<?php

namespace App\Entities\ConfirmationMessages\Repositories;

use App\Entities\ConfirmationMessages\ConfirmationMessage;
use App\Entities\ConfirmationMessages\Repositories\Interfaces\ConfirmationMessageRepositoryInterface;

class ConfirmationMessageRepository implements ConfirmationMessageRepositoryInterface
{
    public function __construct(
        ConfirmationMessage $ConfirmationMessage
    ) {
        $this->model = $ConfirmationMessage;
    }

    public function findConfirmationMessageById(int $id): ConfirmationMessage
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getPageDeniedTr()
    {
        return $this->model->where('ID', 2)->get(['MSJ'])->first();
    }

    public function getPageDeniedAl()
    {
        return $this->model->where('ID', 3)->get(['MSJ'])->first();
    }

    public function getPageDeniedSH()
    {
        return $this->model->where('ID', 5)->get(['MSJ'])->first();
    }

    public function getPageDenied()
    {
        return $this->model->where('ID', 4)->get(['MSJ'])->first();
    }
}
