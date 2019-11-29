<?php

namespace App\Http\Controllers\Admin\Intentions;

use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class IntentionController extends Controller
{
    private $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->intentionInterface->listIntentions($skip * 30);

        if (request()->has('q')) {
            $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('Intentions.list', [
            'intentions'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Intención', 'Cliente', 'Fecha', 'Actividad', 'Estado Obligaciones', 'Score', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5', 'Inspección Ocular', 'Definición', 'Estado Cliente'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
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
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles = $this->intentionInterface->countIntentionsCreditProfiles($from, $to);

        if (request()->has('from')) {
            $creditProfiles = $this->intentionInterface->countIntentionsCreditProfiles(request()->input('from'), request()->input('to'));
        }

        $creditCards = $this->intentionInterface->countIntentionsCreditCards($from, $to);

        $creditProfiles   = $creditProfiles->toArray();
        $creditProfiles   = array_values($creditProfiles);
        $creditCards   = $creditCards->toArray();
        $creditCards   = array_values($creditCards);

        $creditProfilesNames  = [];
        $creditProfilesValues  = [];


        foreach ($creditProfiles as $creditProfile) {
            array_push($creditProfilesNames, trim($creditProfile['PERFIL_CREDITICIO']));
            array_push($creditProfilesValues, trim($creditProfile['total']));
        }



        return view('Intentions.dashboard', [
            'creditProfilesNames'  => $creditProfilesNames,
            'creditProfilesValues' => $creditProfilesValues,
            'creditCards'  => $creditCards,
            'totalStatuses'  => array_sum($creditProfilesValues),
        ]);
    }
}
