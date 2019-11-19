<?php

namespace App\Entities\Punishments\Repositories;

use App\Entities\Punishments\Punishment;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use Illuminate\Database\QueryException;

class PunishmentRepository implements PunishmentRepositoryInterface
{
    public function __construct(
        Punishment $punishment
    ) {
        $this->model = $punishment;
    }

    public function checkCustomerIsPunished($identificationNumber)
    {
        try {
            $queryExistDefault =  $this->model->where('cedula', $identificationNumber)->get()->first();

            if (!empty($queryExistDefault)) {
                return true; // Esta en mora
            } else {
                return false; // No esta en mora
            }
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
