<?php

namespace App\Http\Controllers\Admin\Intentions;

use App\Entities\Intentions\Intention;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use PhpParser\Node\Stmt\Foreach_;

class IntentionController extends Controller
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
        $status = IntentionStatus::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->intentionInterface->listIntentions($skip * 30);
        if (request()->has('q')) {
            $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('Intentions.list', [
            'intentions'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Intención', 'Origen', 'Cliente', 'Fecha', 'Actividad', 'Estado Obligaciones', 'Score', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Estado', 'Definición'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
            'status'               => $status,
        ]);
    }

    public function show(int $id)
    {
        $intention = $this->intentionInterface->findIntentionByIdFull($id);

        return view('Intentions.show', [
            'intention' =>  $intention
        ]);
    }

    public function assignAssesorDigitalToLead($solicitud)
    { }

    public function dashboard(Request $request)
    {
        $to   = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles($from, $to);
        $creditCards       = $this->intentionInterface->countIntentionsCreditCards($from, $to);
        $intentionStatuses = $this->intentionInterface->countIntentionsStatuses($from, $to);
        //$intentionStatuses = $this->intentionStatusesInterface->countIntentionStatuses($from, $to);

        if (request()->has('from')) {
            $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards       = $this->intentionInterface->countIntentionsCreditCards(request()->input('from'), request()->input('to'));
            $intentionStatuses = $this->intentionInterface->countIntentionsStatuses(request()->input('from'), request()->input('to'));
        }

        $intentionStatusesNames  = [];
        $intentionStatusesValues = [];

        foreach ($intentionStatuses as $intentionStatus) {
            array_push($intentionStatusesNames, trim($intentionStatus->intentionStatus['NAME']));
            array_push($intentionStatusesValues, trim($intentionStatus['total']));
        }

        $creditCards = $this->toolsInterface->getDataPercentage($creditCards);

        $statusPercentage = [];
        $totalStatuses    = $creditCards->sum('total');
        foreach ($intentionStatuses as $key => $value) {
            $statusPercentage[$key]['status']     = $value->intentionStatus['NAME'];
            $statusPercentage[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
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
