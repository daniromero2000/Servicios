<?php

namespace App\Entities\Leads\Repositories;

use App\Entities\Leads\Lead;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection as Support;

class LeadRepository implements LeadRepositoryInterface
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

    public function getLeadChannel($cedula)
    {
        try {
            return $this->model->where('identificationNumber', $cedula)->get(['channel', 'id', 'state']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadById(int $id): Lead
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLead(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countLeadChannels($from, $to)
    {
        try {
            return  $this->model->select('channel', DB::raw('count(*) as total'))
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('channel')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadStatuses($from, $to)
    {
        try {
            return  $this->model->with('leadStatus')
                ->whereBetween('created_at', [$from, $to])
                ->get(['state'])->groupBy('leadStatus.status');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listleads($totalView): Support
    {
        try {
            return  $this->model->with(['leadStatus'])
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
