<?php

namespace App\Http\Controllers\Admin\IntentionDirectors;

use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
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

class IntentionDirectorController extends Controller
{
    private $intentionStatusesInterface, $intentionInterface, $toolsInterface, $customerInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        IntentionStatusRepositoryInterface $intentionStatusRepositoryInterface,
        AssessorRepositoryInterface $assessorRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->intentionStatusesInterface = $intentionStatusRepositoryInterface;
        $this->assessorInterface = $assessorRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $assessor = auth()->user()->codeOportudata;

        $status = IntentionStatus::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $listAssessors = $this->assessorInterface->listIntentionDirector($assessor);
        $list = $this->intentionInterface->listIntentionDirectors($skip * 30, $from, $to, $listAssessors);
        $listCount =  $this->intentionInterface->countListIntentionDirectors($from, $to, $listAssessors);

        if (request()->has('q')) {
            $list = $this->intentionInterface->searchIntentionDirector(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('creditprofile'),
                request()->input('status'),
                $listAssessors
            )->sortByDesc('FECHA_INTENCION');

            $listCount =  $this->intentionInterface->countListIntentionDirectors(request()->input('from'), request()->input('to'), $listAssessors);
        }

        $listCount = count($listCount);


        return view('intentionDirectors.list', [
            'intentionAssessors'   => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intención', 'Origen', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Decisión', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Definición'],
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
        $assessor = auth()->user()->codeOportudata;


        $creditProfiles    = $this->assessorInterface->listIntentionDirector($from, $to, $assessor);

        // dd($creditProfiles);

        // foreach ($creditProfiless as $key2 => $status) {
        //     if ($creditProfiless[$key2]->isNotNull()) {
        //         $creditProfilesss[] = $creditProfiless[$key2];
        //         unset($creditProfiles[$key2]);
        //     }
        // }





        // $creditCards       = $this->intentionInterface->countIntentionAssessorCreditCards($from, $to, $assessor);
        // $intentionStatuses = $this->intentionInterface->countIntentionAssessorStatuses($from, $to, $assessor);

        // if (request()->has('from')) {
        //     $creditProfiles    = $this->intentionInterface->countIntentionAssessorCreditProfiles(request()->input('from'), request()->input('to'), $assessor);
        //     $creditCards       = $this->intentionInterface->countIntentionAssessorCreditCards(request()->input('from'), request()->input('to'), $assessor);
        //     $intentionStatuses = $this->intentionInterface->countIntentionAssessorStatuses(request()->input('from'), request()->input('to'), $assessor);
        // }

        // $intentionStatusesNames  = [];
        // $intentionStatusesValues = [];

        // foreach ($intentionStatuses as $intentionStatus) {
        //     if ($intentionStatus->intentionStatus) {
        //         array_push($intentionStatusesNames, trim($intentionStatus->intentionStatus['NAME']));
        //         array_push($intentionStatusesValues, trim($intentionStatus['total']));
        //     }
        // }

        // $creditCards = $this->toolsInterface->getDataPercentage($creditCards);

        // $statusPercentage = [];
        // $totalStatuses    = $creditCards->sum('total');
        // foreach ($intentionStatuses as $key => $value) {
        //     if ($value->intentionStatus) {
        //         $statusPercentage[$key]['status']     = $value->intentionStatus['NAME'];
        //         $statusPercentage[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
        //     }
        // }
        // $creditProfiles = $this->toolsInterface->extractValuesToArray($creditProfiles);
        // $creditCards    = $this->toolsInterface->extractValuesToArray($creditCards);

        // $creditProfilesNames  = [];
        // $creditProfilesValues = [];

        // foreach ($creditProfiles as $creditProfile) {
        //     array_push($creditProfilesNames, trim($creditProfile['PERFIL_CREDITICIO']));
        //     array_push($creditProfilesValues, trim($creditProfile['total']));
        // }


        // return view('intentionAssessors.dashboard', [
        //     'creditProfilesNames'     => $creditProfilesNames,
        //     'creditProfilesValues'    => $creditProfilesValues,
        //     'intentionStatusesNames'  => $intentionStatusesNames,
        //     'intentionStatusesValues' => $intentionStatusesValues,
        //     'creditCards'             => $creditCards,
        //     'statusPercentage'        => $statusPercentage,
        //     'totalStatuses'           => array_sum($creditProfilesValues),
        // ]);
    }
}