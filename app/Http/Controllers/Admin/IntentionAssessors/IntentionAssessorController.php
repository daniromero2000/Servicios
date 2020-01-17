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

        $status = IntentionStatus::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->intentionInterface->listIntentionAssessors($skip * 30, $assessor);
        if (request()->has('q')) {
            $list = $this->intentionInterface->searchIntentionAssessors(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('creditprofile'),
                request()->input('status'),
                $assessor
            )->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('intentionAssessors.list', [
            'intentionAssessors'   => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intención', 'Origen', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Definición'],
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
        $to   = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles($from, $to);
        $creditCards       = $this->intentionInterface->countIntentionsCreditCards($from, $to);
        $intentionStatuses = $this->intentionInterface->countIntentionsStatuses($from, $to);

        if (request()->has('from')) {
            $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards       = $this->intentionInterface->countIntentionsCreditCards(request()->input('from'), request()->input('to'));
            $intentionStatuses = $this->intentionInterface->countIntentionsStatuses(request()->input('from'), request()->input('to'));
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


        return view('intentions.dashboard', [
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