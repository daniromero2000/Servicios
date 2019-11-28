<?php

namespace App\Entities\Intentions\Repositories;

use App\Entities\Intentions\Intention;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class IntentionRepository implements IntentionRepositoryInterface
{
    private $columns = [
        'id',
        'CEDULA',
        'FECHA_INTENCION',
        'ID_DEF',
        'TIPO_CLIENTE',
        'ESTADO_OBLIGACIONES',
        'PERFIL_CREDITICIO',
        'HISTORIAL_CREDITO',
        'TARJETA',
        'EDAD',
        'TIEMPO_LABOR',
        'TIPO_5_ESPECIAL',
        'INSPECCION_OCULAR',
        'ESTADO_INTENCION',
    ];


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

    public function listIntentions($totalView): Support
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $status = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status)) {
            return $this->model->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchFactoryRequest($text, null, true, true)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO', $status);
                })
                ->orderBy('SOLICITUD', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchFactoryRequest($text, null, true, true)
            ->whereBetween('FECHASOL', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO', $status);
            })->orderBy('SOLICITUD', 'desc')
            ->get($this->columns);
    }
}
