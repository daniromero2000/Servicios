<?php

namespace App\Http\Controllers\Admin\IntentionDirectors;

use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class IntentionDirectorController extends Controller
{
    private $intentionInterface, $toolsInterface, $customerInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        AssessorRepositoryInterface $assessorRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->assessorInterface = $assessorRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $assessor = auth()->user()->Assessor->SUCURSAL;

        $status        = IntentionStatus::all();
        $skip          = $this->toolsInterface->getSkip($request->input('skip'));
        $listAssessors = $this->assessorInterface->listIntentionDirector($assessor);
        $list          = $this->intentionInterface->listIntentionDirectors($skip * 30, $from, $to, $listAssessors);
        $listCount     = $this->intentionInterface->countListIntentionDirectors($from, $to, $listAssessors);

        if (request()->has('q')) {
            $to = request()->input('to') . " 23:59:59";
            $list = $this->intentionInterface->searchIntentionDirector(
                request()->input('q'),
                $skip,
                request()->input('from'),
                $to,
                request()->input('creditprofile'),
                request()->input('status'),
                $listAssessors
            )->sortByDesc('FECHA_INTENCION');
            $listCount = $list;
        }

        $listCount = count($listCount);

        return view('intentionDirectors.list', [
            'intentionAssessors'   => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intenci??n', 'Origen', 'Asesor', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Perfil Crediticio', 'Historial Crediticio', 'Cr??dito', 'Decisi??n', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspecci??n Ocular', 'Definici??n'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
            'status'               => $status,
        ]);
    }

    public function show(int $id)
    {
        return view('intentions.show', [
            'intention' =>   $this->intentionInterface->findIntentionByIdFull($id)
        ]);
    }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $assessor = auth()->user()->Assessor->SUCURSAL;

        $listAssessors     = $this->assessorInterface->listIntentionDirector($assessor);
        $creditProfiles    = $this->intentionInterface->countIntentionDirectorCreditProfiles($from, $to, $listAssessors);
        $creditCards       = $this->intentionInterface->countIntentionDirectorCreditCards($from, $to, $listAssessors);
        $intentionStatuses = $this->intentionInterface->countIntentionDirectorStatuses($from, $to, $listAssessors);

        if (request()->has('from')) {
            $to = request()->input('to') . " 23:59:59";
            $creditProfiles    = $this->intentionInterface->countIntentionDirectorCreditProfiles(request()->input('from'), $to, $listAssessors);
            $creditCards       = $this->intentionInterface->countIntentionDirectorCreditCards(request()->input('from'), $to, $listAssessors);
            $intentionStatuses = $this->intentionInterface->countIntentionDirectorStatuses(request()->input('from'), $to, $listAssessors);
        }

        $intentionStatusesNames  = [];
        $intentionStatusesValues = [];

        foreach ($intentionStatuses as $intentionStatus) {
            if ($intentionStatus->intentionStatus) {
                array_push($intentionStatusesNames, trim($intentionStatus->intentionStatus['NAME']));
                array_push($intentionStatusesValues, trim($intentionStatus['total']));
            }
        }

        $creditCards = $this->toolsInterface->getDataPercentage($creditCards);
        $statusPercentage = [];
        $totalStatuses    = $creditCards->sum('total');
        foreach ($intentionStatuses as $key => $value) {
            if ($value->intentionStatus) {
                $statusPercentage[$key]['status']     = $value->intentionStatus['NAME'];
                $statusPercentage[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
            }
        }
        $creditProfiles = $this->toolsInterface->extractValuesToArray($creditProfiles);
        $creditCards    = $this->toolsInterface->extractValuesToArray($creditCards);

        $creditProfilesNames  = [];
        $creditProfilesValues = [];

        foreach ($creditProfiles as $creditProfile) {
            array_push($creditProfilesNames, trim($creditProfile['PERFIL_CREDITICIO']));
            array_push($creditProfilesValues, trim($creditProfile['total']));
        }


        return view('intentionDirectors.dashboard', [
            'creditProfilesNames'     => $creditProfilesNames,
            'creditProfilesValues'    => $creditProfilesValues,
            'intentionStatusesNames'  => $intentionStatusesNames,
            'intentionStatusesValues' => $intentionStatusesValues,
            'creditCards'             => $creditCards,
            'statusPercentage'        => $statusPercentage,
            'totalStatuses'           => array_sum($creditProfilesValues),
        ]);
    }
}
