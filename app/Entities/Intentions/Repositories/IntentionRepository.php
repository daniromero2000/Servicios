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
        'ESTADO_OBLIGACIONES',
        'PERFIL_CREDITICIO',
        'HISTORIAL_CREDITO',
        'TARJETA',
        'ZONA_RIESGO',
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

    public function findLatestCustomerIntentionByCedula($CEDULA): Intention
    {
        try {
            return $this->model
                ->where('CEDULA', $CEDULA)->latest('id')->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findIntentionByIdFull(int $id): Intention
    {
        try {
            return $this->model
                ->with(['customer', 'definition'])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listIntentions($totalView): Support
    {
        try {
            return  $this->model->with(['customer', 'definition'])
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionsCreditProfiles($from, $to)
    {
        try {
            return  $this->model->select('PERFIL_CREDITICIO', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('PERFIL_CREDITICIO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionsCreditCards($from, $to)
    {
        try {
            return  $this->model->select('TARJETA', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('TARJETA')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionsStatuses($from, $to)
    {
        try {
            return  $this->model->with('intentionStatus')->select('ESTADO_INTENCION', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('ESTADO_INTENCION')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchIntentions(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile)) {
            return $this->model->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchIntentions($text, null, true, true)->with(['customer', 'definition'])
                ->when($creditprofile, function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                })
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchIntentions($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->when($creditprofile, function ($q, $creditprofile) {
                return $q->where('PERFIL_CREDITICIO', $creditprofile);
            })
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }
}
