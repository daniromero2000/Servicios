<?php

namespace App\Http\Controllers\Admin\Intentions;

use App\Entities\Intentions\Intention;
use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Entities\DataIntentionsRequest\Repositories\DataIntentionsRequestRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Tools\Exports\ExportToExcel;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Foreach_;

class IntentionController extends Controller
{
    private $intentionStatusesInterface, $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        IntentionStatusRepositoryInterface $intentionStatusRepositoryInterface,
        DataIntentionsRequestRepository $DataIntentionsRequestRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->intentionStatusesInterface = $intentionStatusRepositoryInterface;
        $this->dataIntentionsRequest = $DataIntentionsRequestRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $status = IntentionStatus::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $leadsOfMonth = $this->intentionInterface->listIntentionsTotal($from, $to);


        $list = $this->intentionInterface->listIntentions($skip * 30);
        if (request()->has('q')) {
            $cont = 0;
            switch ($request->input('action')) {
                case 'search':
                    $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
                    $leadsOfMonth =  $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
                    break;
                case 'export':

                    $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
                    $leadsOfMonth =  $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');

                    foreach ($list as $key => $value) {
                        $cont++;
                        if ($cont == 1) {
                            $printExcel[] = [
                                'FECHA INTENCION',
                                'ORIGEN',
                                'SUCURSAL',
                                'ASESOR',
                                'ESTADO',
                                'CLIENTE',
                                'ACTIVIDAD',
                                'ESTADO OBLIGACIONES',
                                'SCORE',
                                'PERFIL CREDITICIO',
                                'HISTORIAL CREDITICIO',
                                'LINEA', 'DECISION',
                                'RIESGO ZONA',
                                'EDAD',
                                'TIEMPO EN LABOR',
                                'TIPO 5 ESPECIAL',
                                'INSPECCION OCULAR',
                                'DEFINICION'
                            ];
                        }
                        $score = '';

                        if ($value->customer->latestCifinScore) {
                            $score = $value->customer->latestCifinScore['score'];
                        }

                        $printExcel[] = [
                            $value->FECHA_INTENCION,
                            $value->customer['ORIGEN'],
                            $value->assessor['SUCURSAL'],
                            $value->assessor['NOMBRE'],
                            $value->intentionStatus['NAME'],
                            $value->CEDULA,
                            $value->customer['ACTIVIDAD'],
                            ($value->ESTADO_OBLIGACIONES == '1') ? 'NORMAL' : 'EN MORA',
                            $score,
                            $value->PERFIL_CREDITICIO,
                            ($value->HISTORIAL_CREDITO == '1') ? 'CON HISTORIAL' : 'SIN HISTORIAL',
                            $value->TARJETA,
                            $value->CREDIT_DECISION,
                            $value->ZONA_RIESGO,
                            ($value->EDAD == '1') ? 'CUMPLE' : 'NO CUMPLE',
                            ($value->TIEMPO_LABOR == '1') ? 'CUMPLE' : 'NO CUMPLE',
                            ($value->TIPO_5_ESPECIAL == '1') ? 'SI' : 'NO',
                            ($value->INSPECCION_OCULAR == '1') ? 'SI' : 'NO',
                            $value->definition['DESCRIPCION']
                        ];

                        $export = new ExportToExcel($printExcel);
                    }
                    return Excel::download($export, 'IntencionesClientes.xlsx');
                    break;
            }

            $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
            $leadsOfMonth =  $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
        }

        return view('intentions.list', [
            'intentions'           => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Fecha', 'Intención', 'Origen', 'Asesor', 'Estado',  'Cliente',  'Actividad', 'Estado Obligaciones', 'Score', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Decisión', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Definición'],
            'listCount'            => $leadsOfMonth->count(),
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
        $from = Carbon::now()->startOfMonth();

        $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles($from, $to);
        $creditCards       = $this->intentionInterface->countIntentionsCreditCards($from, $to);
        $intentionStatuses = $this->intentionInterface->countIntentionsStatuses($from, $to);
        $dataIntenciosForDevices = $this->dataIntentionsRequest->countDataIntentionsForTypedevice($from, $to);
        $dataIntenciosForBrowsers = $this->dataIntentionsRequest->countDataIntentionsForBrowser($from, $to);

        if (request()->has('from')) {
            $creditProfiles    = $this->intentionInterface->countIntentionsCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards       = $this->intentionInterface->countIntentionsCreditCards(request()->input('from'), request()->input('to'));
            $intentionStatuses = $this->intentionInterface->countIntentionsStatuses(request()->input('from'), request()->input('to'));
            $dataIntenciosForBrowsers = $this->dataIntentionsRequest->countDataIntentionsForBrowser(request()->input('from'), request()->input('to'));
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

        $devicesNames  = [];
        $devicesValues = [];

        foreach ($dataIntenciosForDevices as $dataIntenciosForDevice) {
            array_push($devicesNames, trim($dataIntenciosForDevice['type_device']));
            array_push($devicesValues, trim($dataIntenciosForDevice['total']));
        }

        $browsersNames  = [];
        $browsersValues = [];
        foreach ($dataIntenciosForBrowsers as $dataIntenciosForBrowser) {
            array_push($browsersNames, trim($dataIntenciosForBrowser['browser']));
            array_push($browsersValues, trim($dataIntenciosForBrowser['total']));
        }


        return view('intentions.dashboard', [
            'creditProfilesNames'     => $creditProfilesNames,
            'creditProfilesValues'    => $creditProfilesValues,
            'intentionStatusesNames'  => $intentionStatusesNames,
            'intentionStatusesValues' => $intentionStatusesValues,
            'deviceNames'             => $devicesNames,
            'deviceValues'            => $devicesValues,
            'browserNames'            => $browsersNames,
            'browserValues'           => $browsersValues,
            'creditCards'             => $creditCards,
            'statusPercentage'        => $statusPercentage,
            'totalStatuses'           => array_sum($creditProfilesValues),
        ]);
    }
}
