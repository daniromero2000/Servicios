<?php

namespace App\Http\Controllers\Admin\DigitalChannelLeads;

use App\Entities\LeadStatuses\LeadStatus;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use PhpParser\Node\Stmt\Foreach_;

class DigitalChannelLeadController extends Controller
{
    private $LeadStatusesInterface, $LeadInterface, $toolsInterface;

    public function __construct(
        LeadRepositoryInterface $LeadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->LeadInterface = $LeadRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->LeadInterface->listLeads($skip * 30);
        if (request()->has('q')) {
            $list = $this->LeadInterface->searchLeads(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();

        return view('digitalChannelLeads.list', [
            'digitalChannelLeads'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intención', 'Origen', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Score', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Definición'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        return view('Leads.show', [
            'Lead' =>   $this->LeadInterface->findLeadByIdFull($id)
        ]);
    }

    public function dashboard(Request $request)
    {
        $to   = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles    = $this->LeadInterface->countLeadsCreditProfiles($from, $to);
        $creditCards       = $this->LeadInterface->countLeadsCreditCards($from, $to);
        $LeadStatuses = $this->LeadInterface->countLeadsStatuses($from, $to);

        if (request()->has('from')) {
            $creditProfiles    = $this->LeadInterface->countLeadsCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards       = $this->LeadInterface->countLeadsCreditCards(request()->input('from'), request()->input('to'));
            $LeadStatuses = $this->LeadInterface->countLeadsStatuses(request()->input('from'), request()->input('to'));
        }

        $LeadStatusesNames  = [];
        $LeadStatusesValues = [];

        foreach ($LeadStatuses as $LeadStatus) {
            array_push($LeadStatusesNames, trim($LeadStatus->LeadStatus['NAME']));
            array_push($LeadStatusesValues, trim($LeadStatus['total']));
        }

        $creditCards = $this->toolsInterface->getDataPercentage($creditCards);

        $statusPercentage = [];
        $totalStatuses    = $creditCards->sum('total');
        foreach ($LeadStatuses as $key => $value) {
            $statusPercentage[$key]['status']     = $value->LeadStatus['NAME'];
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


        return view('Leads.dashboard', [
            'creditProfilesNames'     => $creditProfilesNames,
            'creditProfilesValues'    => $creditProfilesValues,
            'LeadStatusesNames'  => $LeadStatusesNames,
            'LeadStatusesValues' => $LeadStatusesValues,
            'creditCards'             => $creditCards,
            'statusPercentage'        => $statusPercentage,
            'totalStatuses'           => array_sum($creditProfilesValues),
        ]);
    }
}
