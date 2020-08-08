<?php

namespace App\Entities\Intentions\Repositories;

use App\Entities\DataIntentionsRequest\DataIntentionsRequest;
use App\Entities\DataIntentionsRequest\Repositories\DataIntentionsRequestRepository;
use App\Entities\Intentions\Intention;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class IntentionRepository implements IntentionRepositoryInterface
{
    //Table TB_INTENCIONES

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
        'ZONA_RIESGO',
        'EDAD',
        'TIEMPO_LABOR',
        'TIPO_5_ESPECIAL',
        'INSPECCION_OCULAR',
        'ESTADO_INTENCION',
        'ASESOR',
        'CREDIT_DECISION'
    ];

    public function __construct(
        Intention $intention
    ) {
        $this->model = $intention;
    }

    public function createIntention($data): Intention
    {
        $authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
        if (Auth::user()) {
            $authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
        }
        $assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
        $data['ASESOR'] = $assessorCode;
        try {
            $dataIntention = new DataIntentionsRequest();
            $intention = $this->model->create($data);
            $dataIntentionRequest = new DataIntentionsRequestRepository($dataIntention);
            $dataIntentionRequest->createDataIntentionRequest($intention->id);
            return $intention;
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function updateOrCreateIntention($data)
    {
        try {
            return $this->model->latest('id')->updateOrCreate(['CEDULA' => $data['CEDULA']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function findLatestCustomerIntentionByCedula($CEDULA): Intention
    {
        try {
            return $this->model
                ->where('CEDULA', $CEDULA)->latest('FECHA_INTENCION')->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }


    public function findLatestCustomerIntentionByCedulaForPolicy($CEDULA)
    {
        try {
            return $this->model
                ->where('CEDULA', $CEDULA)->latest('FECHA_INTENCION')->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findIntentionByIdFull(int $id): Intention
    {
        try {
            return $this->model
                ->with(['customer', 'definition', 'intentionStatus'])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listIntentionsTotal($from, $to)
    {
        try {
            return  $this->model->with(['customer', 'definition'])
                ->orderBy('id', 'desc')
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listIntentions($totalView): Support
    {
        try {
            return  $this->model->with(['customer', 'definition', 'assessor'])
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

    public function searchIntentions(string $text = null, $totalView, $from = null, $to = null, $creditprofile = null, $status = null): Collection
    {
        set_time_limit(0);

        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile) && is_null($status)) {
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
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO_INTENCION', $status);
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
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO_INTENCION', $status);
            })
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }

    public function exportIntentions(string $text = null, $totalView, $from = null, $to = null, $creditprofile = null, $status = null): Collection
    {
        set_time_limit(0);

        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile) && is_null($status)) {
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
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO_INTENCION', $status);
                })
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }
        return $this->model->searchIntentions($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->when(
                $creditprofile,
                function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                }
            )
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO_INTENCION', $status);
            })
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }

    //assessors

    public function listIntentionAssessors($totalView, $assessor): Support
    {
        try {
            return  $this->model->with(['customer', 'definition'])->where('ASESOR', $assessor)
                ->orderBy('id', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listJarvisIntentions($totalView): Support
    {
        try {
            return  $this->model->with(['customer', 'definition'])->where('ASESOR', 998877)
                ->where('ID_DEF', null)
                ->where('CREDIT_DECISION', null)
                ->where('FECHA_INTENCION', '>', '2020-05-01 00:00:00')
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchIntentionAssessors(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null, $assessor): Collection
    {
        set_time_limit(0);
        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile) && is_null($status)) {
            return $this->model->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->where('ASESOR', $assessor)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchIntentionAssessors($text, null, true, true)->with(['customer', 'definition'])
                ->where('ASESOR', $assessor)
                ->when($creditprofile, function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                })
                ->where('ASESOR', $assessor)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO_INTENCION', $status);
                })
                ->where('ASESOR', $assessor)
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }
        return $this->model->searchIntentionAssessors($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->where('ASESOR', $assessor)
            ->when($creditprofile, function ($q, $creditprofile) {
                return $q->where('PERFIL_CREDITICIO', $creditprofile);
            })
            ->where('ASESOR', $assessor)
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO_INTENCION', $status);
            })
            ->where('ASESOR', $assessor)
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }

    public function countIntentionAssessorCreditProfiles($from, $to, $assessor)
    {
        try {
            return  $this->model->select('PERFIL_CREDITICIO', DB::raw('count(*) as total'))
                ->where('ASESOR', $assessor)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('PERFIL_CREDITICIO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionAssessorCreditCards($from, $to, $assessor)
    {
        try {
            return  $this->model->select('TARJETA', DB::raw('count(*) as total'))
                ->where('ASESOR', $assessor)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('TARJETA')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionAssessorStatuses($from, $to, $assessor)
    {
        try {
            return  $this->model->with('intentionStatus')->select('ESTADO_INTENCION', DB::raw('count(*) as total'))
                ->where('ASESOR', $assessor)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('ESTADO_INTENCION')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function listIntentionDirectors($totalView, $from, $to, $subsidiaris)
    {
        try {
            return  $this->model
                ->whereIn('ASESOR', $subsidiaris)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->skip($totalView)
                ->take(30)
                ->orderby('FECHA_INTENCION', 'desc')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countListIntentionDirectors($from, $to, $subsidiaris)
    {
        try {
            return  $this->model
                ->whereIn('ASESOR', $subsidiaris)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchIntentionDirector(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null, $status = null, $subsidiaris): Collection
    {
        set_time_limit(0);
        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile)  && is_null($status)) {
            return $this->model->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->whereIn('ASESOR', $subsidiaris)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchIntentionDirector($text, null, true, true)->with(['customer', 'definition'])
                ->whereIn('ASESOR', $subsidiaris)
                ->when($creditprofile, function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                })
                ->whereIn('ASESOR', $subsidiaris)
                ->when($status, function ($q, $status) {
                    return $q->where('ESTADO_INTENCION', $status);
                })
                ->whereIn('ASESOR', $subsidiaris)
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchIntentionDirector($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->whereIn('ASESOR', $subsidiaris)
            ->when($creditprofile, function ($q, $creditprofile) {
                return $q->where('PERFIL_CREDITICIO', $creditprofile);
            })
            ->whereIn('ASESOR', $subsidiaris)
            ->when($status, function ($q, $status) {
                return $q->where('ESTADO_INTENCION', $status);
            })
            ->whereIn('ASESOR', $subsidiaris)
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }

    public function countIntentionDirectorCreditProfiles($from, $to, $subsidiaris)
    {
        try {
            return  $this->model->select('PERFIL_CREDITICIO', DB::raw('count(*) as total'))
                ->whereIn('ASESOR', $subsidiaris)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('PERFIL_CREDITICIO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionDirectorCreditCards($from, $to, $subsidiaris)
    {
        try {
            return  $this->model->select('TARJETA', DB::raw('count(*) as total'))
                ->whereIn('ASESOR', $subsidiaris)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('TARJETA')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countIntentionDirectorStatuses($from, $to, $subsidiaris)
    {
        try {
            return  $this->model->with('intentionStatus')->select('ESTADO_INTENCION', DB::raw('count(*) as total'))
                ->whereIn('ASESOR', $subsidiaris)
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('ESTADO_INTENCION')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function validateDateIntention($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);
        $dateLastIntention = $this->findLatestCustomerIntentionByCedulaForPolicy($identificationNumber);

        if (empty($dateLastIntention)) {
            return 'true';
        } else {
            $dateLastConsulta = $dateLastIntention->FECHA_INTENCION;
            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function getConfrontaIntentionStatus($resultConfronta)
    {
        if ($resultConfronta == 1) {
            return 19;
        } else {
            return 3;
        }
    }

    public function defineConfrontaCardValues($tarjeta)
    {
        if ($tarjeta == 'Tarjeta Black') {
            return $policyCredit = [
                'quotaApprovedProduct' => 1900000,
                'quotaApprovedAdvance' => 500000,
                'resp' => 'true'
            ];
        } elseif ($tarjeta == 'Tarjeta Gray') {
            return  $policyCredit = [
                'quotaApprovedProduct' => 1600000,
                'quotaApprovedAdvance' => 200000,
                'resp' => 'true'
            ];
        }
    }
}
