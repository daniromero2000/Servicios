<?php

namespace App\Entities\ConfrontaSelects\Repositories;

use App\Entities\ConfrontaSelects\ConfrontaSelect;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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

    public function insertCustomerConfronta($confronta)
    {
        foreach ($confronta as $pregunta) {
            DB::connection('oportudata')->select(
                'INSERT INTO `confronta_selec` (`consec`, `cedula`, `secuencia_cuest`, `secuencia_preg`, `secuencia_resp`)
			VALUES (:consec, :cedula, :secuencia_cuest, :secuencia_preg, :secuencia_resp)',
                ['consec' => $pregunta['consec'], 'cedula' => $pregunta['cedula'], 'secuencia_cuest' => $pregunta['cuestionario'], 'secuencia_preg' => $pregunta['secuencia'], 'secuencia_resp' => $pregunta['opcion']]
            );
        }

        return true;
    }
}
