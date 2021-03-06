<?php

namespace App\Http\Controllers\Admin\IntentionAssessors;

use App\Entities\Intentions\Intention;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class IntentionAssessorController extends Controller
{
    private $intentionStatusesInterface, $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        IntentionStatusRepositoryInterface $intentionStatusRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->intentionStatusesInterface = $intentionStatusRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $assessor = auth()->user()->email;
        $assessorId = auth()->user()->idProfile;

        $status = IntentionStatus::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->intentionInterface->listIntentionAssessors($skip * 30, $assessor);
        $listJarvis = $this->intentionInterface->listJarvisIntentions($skip * 30);
        if (request()->has('q')) {
            $to = request()->input('to') . " 23:59:59";
            $list = $this->intentionInterface->searchIntentionAssessors(
                request()->input('q'),
                $skip,
                request()->input('from'),
                $to,
                request()->input('creditprofile'),
                request()->input('status'),
                $assessor
            )->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('intentionAssessors.list', [
            'intentionAssessors'   => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intenci??n', 'Origen', 'Asesor', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Perfil Crediticio', 'Historial Crediticio', 'Cr??dito', 'Decisi??n', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspecci??n Ocular', 'Definici??n'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
            'status'               => $status,
            'listJarvis' => $listJarvis,
            'assessorId' => $assessorId
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
        $assessor = auth()->user()->email;


        $creditProfiles    = $this->intentionInterface->countIntentionAssessorCreditProfiles($from, $to, $assessor);
        $creditCards       = $this->intentionInterface->countIntentionAssessorCreditCards($from, $to, $assessor);
        $intentionStatuses = $this->intentionInterface->countIntentionAssessorStatuses($from, $to, $assessor);

        if (request()->has('from')) {
            $to = request()->input('to') . " 23:59:59";
            $creditProfiles    = $this->intentionInterface->countIntentionAssessorCreditProfiles(request()->input('from'), $to, $assessor);
            $creditCards       = $this->intentionInterface->countIntentionAssessorCreditCards(request()->input('from'), $to, $assessor);
            $intentionStatuses = $this->intentionInterface->countIntentionAssessorStatuses(request()->input('from'), $to, $assessor);
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


        return view('intentionAssessors.dashboard', [
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
