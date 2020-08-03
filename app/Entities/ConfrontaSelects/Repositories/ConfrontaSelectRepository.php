<?php

namespace App\Entities\ConfrontaSelects\Repositories;

use App\Entities\ConfrontaSelects\ConfrontaSelect;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use Illuminate\Database\QueryException;

class ConfrontaSelectRepository implements ConfrontaSelectRepositoryInterface
{
    private $columns = [
        'consec',
        'cedula',
        'secuencia_cuest',
        'secuencia_preg',
        'secuencia_resp',
    ];

    public function __construct(
        ConfrontaSelect $confrontaSelect
    ) {
        $this->model = $confrontaSelect;
    }

    public function getAllConfrontaSelect($cedula, $cuestionario)
    {
        try {
            return $this->model
                ->where('cedula', $cedula)
                ->where('secuencia_cuest', $cuestionario)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
