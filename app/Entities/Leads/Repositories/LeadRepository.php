<?php

namespace App\Entities\Leads\Repositories;

use App\Entities\Leads\Lead;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

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
        'description',
        'channel',
        'created_at',
        'updated_at',
        'termsAndConditions',
        'campaign',
        'assessor_id',
        'identificationNumber',
        'lead_area_id'
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
            dd($e);
        }
    }

    public function findLeadByIdFull(int $id): Lead
    {
        try {
            return $this->model->with([
                'comments',
                'leadStatusesLogs',
                'leadPrices'
            ])
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

    public function findLeadDelete(int $id): Lead
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
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
            dd($e);
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


    public function countLeadStatusGenerals($from, $to, $area)
    {
        try {
            $datas =  $this->model->with('leadStatuses')
                ->whereBetween('created_at', [$from, $to])
                ->where('lead_area_id', $area)
                ->get(['state'])->groupBy('leadStatuses.status');

            foreach ($datas as $key => $status) {
                $option = ($key == '') ? 'Sin Estado' : $key;
                $datas[] = ['state' => $option, 'total' => count($datas[$key])];
                unset($datas[$key]);
            }

            $totalStatusesGenerals = $datas->sum('total');

            $leadDatalNames  = [];
            $leadDatalValues  = [];
            foreach ($datas as $leadDatal) {
                array_push($leadDatalNames, trim($leadDatal['state']));
                array_push($leadDatalValues, trim($leadDatal['total']));
            }
            return [$leadDatalNames, $leadDatalValues, $totalStatusesGenerals];
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadAssessors($from, $to)
    {
        try {
            return  $this->model->with('user')
                ->whereBetween('created_at', [$from, $to])
                ->get(['assessor_id'])->groupBy('user.name');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadProducts($from, $to)
    {
        try {
            return  $this->model->with('leadProduct')
                ->whereBetween('created_at', [$from, $to])
                ->get(['typeProduct'])->groupBy('leadProduct.lead_product');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadProductGenerals($from, $to, $area)
    {
        try {
            $datas =  $this->model->with('leadProduct')
                ->whereBetween('created_at', [$from, $to])
                ->where('lead_area_id', $area)
                ->get(['typeProduct'])->groupBy('leadProduct.lead_product');

            foreach ($datas as $key => $status) {
                $option = ($key == '') ? 'Sin Producto' : $key;
                $datas[] = ['typeProduct' => $option, 'total' => count($datas[$key])];
                unset($datas[$key]);
            }

            $leadDatalNames  = [];
            $leadDatalValues  = [];
            foreach ($datas as $leadDatal) {
                array_push($leadDatalNames, trim($leadDatal['typeProduct']));
                array_push($leadDatalValues, trim($leadDatal['total']));
            }

            return [$leadDatalNames, $leadDatalValues];
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadServices($from, $to)
    {
        try {
            return  $this->model->with('leadService')
                ->whereBetween('created_at', [$from, $to])
                ->get(['typeService'])->groupBy('leadService.service');
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countLeadServicesGenerals($from, $to, $area)
    {
        try {
            $datas =  $this->model->with('leadService')
                ->whereBetween('created_at', [$from, $to])
                ->where('lead_area_id', $area)
                ->get(['typeService'])->groupBy('leadService.service');

            foreach ($datas as $key => $status) {
                $option = ($key == '') ? 'Sin Servicio' : $key;
                $datas[] = ['Service' => $option, 'total' => count($datas[$key])];
                unset($datas[$key]);
            }

            $leadDatalNames  = [];
            $leadDatalValues  = [];
            foreach ($datas as $leadDatal) {
                array_push($leadDatalNames, trim($leadDatal['Service']));
                array_push($leadDatalValues, trim($leadDatal['total']));
            }

            return [$leadDatalNames, $leadDatalValues];
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listleads($totalView): Support
    {
        try {
            return  $this->model->with([
                'leadStatusesLogs',
                'leadStatus',
                'leadAssessor',
                'leadService',
                'leadCampaign',
                'comments',
                'leadProduct',
                'leadPrices',
                'LeadArea'
            ])->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function getLeadPriceTotal($from, $to)
    {
        try {
            return  $this->model->with([
                'leadPrices'
            ])->whereBetween('created_at', [$from, $to])
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchLeads(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $assessor = null, $city = null, $area = null, $service = null, $product = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($assessor) && is_null($city) && is_null($area)  && is_null($service)  && is_null($product)) {
            return $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchLeads($text, null, true, true)->with([
                'leadStatus',
                'leadAssessor',
                'leadService',
                'leadCampaign',
                'comments',
                'leadProduct'
            ])->when($status, function ($q, $status) {
                return $q->where('state', $status);
            })->when($assessor, function ($q, $assessor) {
                return $q->where('assessor_id', $assessor);
            })->when($city, function ($q, $city) {
                return $q->where('city', $city);
            })->when($area, function ($q, $area) {
                return $q->where('lead_area_id', $area);
            })->when($service, function ($q, $service) {
                return $q->where('typeService', $service);
            })->when($product, function ($q, $product) {
                return $q->where('typeProduct', $product);
            })->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchLeads($text, null, true, true)->with([
            'leadStatus',
            'leadAssessor',
            'leadService',
            'leadCampaign',
            'comments',
            'leadProduct'
        ])->whereBetween('created_at', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('state', $status);
            })->when($assessor, function ($q, $assessor) {
                return $q->where('assessor_id', $assessor);
            })->when($city, function ($q, $city) {
                return $q->where('city', $city);
            })
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    // consultas personalizadas

    public function customListleads($totalView, $area)
    {
        try {
            return  $this->model->with([
                'leadStatusesLogs',
                'leadStatus',
                'leadAssessor',
                'leadService',
                'leadCampaign',
                'comments',
                'leadProduct',
                'leadPrices',
            ])->orderBy('id', 'desc')
                ->where('area_id', $area)
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }
    public function searchCustomLeads(string $text = null, $totalView,  $from = null,  $to = null, $status = null, $assessor = null, $city = null, $area): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($status) && is_null($assessor) && is_null($city)) {
            return $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->where('area_id', $area)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchCustomLeads($text, null, true, true)->with([
                'leadStatus',
                'leadAssessor',
                'leadService',
                'leadCampaign',
                'comments',
                'leadProduct'
            ])->when($status, function ($q, $status) {
                return $q->where('state', $status);
            })->when($assessor, function ($q, $assessor) {
                return $q->where('assessor_id', $assessor);
            })->when($city, function ($q, $city) {
                return $q->where('city', $city);
            })->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(100)
                ->where('area_id', $area)
                ->get($this->columns);
        }

        return $this->model->searchCustomLeads($text, null, true, true)->with([
            'leadStatus',
            'leadAssessor',
            'leadService',
            'leadCampaign',
            'comments',
            'leadProduct'
        ])->whereBetween('created_at', [$from, $to])
            ->when($status, function ($q, $status) {
                return $q->where('state', $status);
            })->when($assessor, function ($q, $assessor) {
                return $q->where('assessor_id', $assessor);
            })->when($city, function ($q, $city) {
                return $q->where('city', $city);
            })
            ->where('area_id', $area)
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    //CallCenter

    public function countLeadAssessorsForCallCenter($from, $to)
    {
        try {
            return  $this->model->with('user')
                ->whereBetween('created_at', [$from, $to])
                // ->where('area_id', 7)
                ->get(['assessor_id'])->groupBy('user.name');
        } catch (QueryException $e) {
            dd($e);
        }
    }
}