<?php

namespace App\Entities\Leads\Repositories;

use App\Entities\Leads\Lead;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class LeadRepository implements LeadRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'lastName',
        'email',
        'telephone',
        'city',
        'typeService',
        'typeProduct',
        'state',
        'channel',
        'created_at',
        'updated_at',
        'termsAndConditions',
        'campaign',
        'assessor_id',
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

    public function findLeadByIdFull(int $id): Lead
    {
        try {
            return $this->model
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
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
            return  $this->model->with('leadChannel')
                ->whereBetween('created_at', [$from, $to])
                ->get(['channel'])->groupBy('leadChannel.channel');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadStatuses($from, $to)
    {
        try {
            return  $this->model->with('leadStatuses')
                ->whereBetween('created_at', [$from, $to])
                ->get(['state'])->groupBy('leadStatuses.status');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listleads($totalView): Support
    {
        try {
            return  $this->model->with(['leadStatus', 'leadAssessor'])
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }


    public function searchLeads(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile)  && is_null($status)) {
            return $this->model->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchLeads($text, null, true, true)->with(['customer', 'definition'])
                ->when($creditprofile, function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                })
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO_INTENCION', $status);
                })
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchLeads($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->when($creditprofile, function ($q, $creditprofile) {
                return $q->where('PERFIL_CREDITICIO', $creditprofile);
            })
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO_INTENCION', $status);
            })
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }
}
