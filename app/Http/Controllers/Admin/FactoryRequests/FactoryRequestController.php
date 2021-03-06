<?php

namespace App\Http\Controllers\Admin\FactoryRequests;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;



class FactoryRequestController extends Controller
{
    private $factoryRequestInterface, $toolsInterface, $factoryRequestStatusesLogInterface;


    public function __construct(
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FactoryRequestStatusesLogRepositoryInterface $factoryRequestStatusesLogRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->factoryRequestStatusesLogInterface = $factoryRequestStatusesLogRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $factoryRequestsTotals = $this->factoryRequestInterface->getFactoryRequestsTotals($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal($from, $to);
        $listCount = $factoryRequestsTotals->count();
        $assessor = '';
        $subsidiary = '';
        $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
        $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
        $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
        $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor,  array(13, 15, 19, 16, 20, 14, 1), $subsidiary);
        $Subsidiarys = Subsidiary::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequests($skip * 30);

        if (request()->has('q') && request()->input('from') == '' && request()->input('to') == '' && request()->input('subsidiary') != '') {
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), request()->input('subsidiary'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, request()->input('subsidiary'));
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, request()->input('subsidiary'));
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor,  array(13, 15, 19, 16, 20, 14, 1), request()->input('subsidiary'));
        }
        if (request()->has('q') && request()->input('from') != '' && request()->input('to') != '') {

            $to = request()->input('to') . " 23:59:59";
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), $to, $assessor, array(19, 20), request()->input('subsidiary'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 16, request()->input('subsidiary'));
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 15, request()->input('subsidiary'));
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), $to, $assessor,  array(13, 15, 19, 16, 20, 14, 1), request()->input('subsidiary'));
        }

        if (request()->has('q')) {
            $to = request()->input('to') . " 23:59:59";
            $list = $this->factoryRequestInterface->searchFactoryRequest(
                request()->input('q'),
                $skip,
                request()->input('from'),
                $to,
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb')
            )->sortByDesc('FECHASOL');
            $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequest(
                request()->input('??q'),
                $skip,
                request()->input('from'),
                $to,
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotal = $list->sum('GRAN_TOTAL');
        }
        $estadosAprobados  = $this->toolsInterface->extractValuesToArray($estadosAprobados);
        $estadosNegados    = $this->toolsInterface->extractValuesToArray($estadosNegados);
        $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
        $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

        $statusesAprobadosValue = [];
        foreach ($estadosAprobados as $estadosPendiente) {
            array_push($statusesAprobadosValue, trim($estadosPendiente['total']));
        }
        $statusesAprobadosValues = 0;
        foreach ($statusesAprobadosValue as $key => $status) {
            $statusesAprobadosValues +=  $statusesAprobadosValue[$key];
        }

        $statusesNegadosValue = [];
        foreach ($estadosNegados as $estadosPendiente) {
            array_push($statusesNegadosValue, trim($estadosPendiente['total']));
        }
        $statusesNegadosValues = 0;
        foreach ($statusesNegadosValue as $key => $status) {
            $statusesNegadosValues +=  $statusesNegadosValue[$key];
        }


        $statusesDesistidosValue = [];
        foreach ($estadosDesistidos as $estadosPendiente) {
            array_push($statusesDesistidosValue, trim($estadosPendiente['total']));
        }
        $statusesDesistidosValues = 0;
        foreach ($statusesDesistidosValue as $key => $status) {
            $statusesDesistidosValues +=  $statusesDesistidosValue[$key];
        }

        $statusesPendientesValue = [];
        foreach ($estadosPendientes as $estadosPendiente) {
            array_push($statusesPendientesValue, trim($estadosPendiente['total']));
        }
        $statusesPendientesValues = 0;
        foreach ($statusesPendientesValue as $key => $status) {
            $statusesPendientesValues +=  $statusesPendientesValue[$key];
        }
        $statuses = FactoryRequestStatus::select('id', 'name')->orderBy('name', 'ASC')->get();
        $listCount = $factoryRequestsTotals->count();

        return view('factoryrequests.list', [
            'factoryRequests'            => $list,
            'optionsRoutes'              => (request()->segment(2)),
            'headers'                    => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
            'listCount'                  => $listCount,
            'skip'                       => $skip,
            'factoryRequestsTotal'       => $factoryRequestsTotal,
            'Subsidiarys'                => $Subsidiarys,
            'statusesAprobadosValues'    => $statusesAprobadosValues,
            'statusesNegadosValues'      => $statusesNegadosValues,
            'statusesDesistidosValues'   => $statusesDesistidosValues,
            'statusesPendientesValues'   => $statusesPendientesValues,
            'statuses'                   => $statuses
        ]);
    }

    public function show(int $id)
    {

        $datas = $this->factoryRequestInterface->findFactoryRequestByIdFull($id)->factoryRequestStatusesLogs;

        $data = [
            'fabrica' => 0,
            'sucursal' => 0
        ];
        $weekMap = [
            0 => 'SU',
            1 => 'MO',
            2 => 'TU',
            3 => 'WE',
            4 => 'TH',
            5 => 'FR',
            6 => 'SA',
        ];

        foreach ($datas as $key => $value) {
            $date1 =  $datas[$key]->created_at;
            if (isset($datas[$key + 1]->created_at)) {
                $date2 =  $datas[$key + 1]->created_at;
                $secondsDays = ($date1->diffInSeconds($date2)) / 28800;
                if ($weekMap[$date1->dayOfWeek] != 'SU') {
                    if ($datas[$key]->oportudataUser != "" && ($datas[$key]->oportudataUser->PERFIL  == 1 || $datas[$key]->oportudataUser->PERFIL  == 2)) {
                        if ($secondsDays > 1 && $secondsDays < 3) {
                            $secondsDays = $secondsDays - 1;
                            $removeSeconds = $secondsDays * 28800;
                            $data['fabrica'] += $date1->diffInSeconds($date2);
                            $data['fabrica'] = $data['fabrica'] - $removeSeconds;
                        } else {
                            $data['fabrica'] += $date1->diffInSeconds($date2);
                        }
                    } else {
                        if ($secondsDays > 1 && $secondsDays < 3) {
                            $secondsDays = $secondsDays - 1;
                            $removeSeconds = $secondsDays * 28800;
                            $data['sucursal'] += $date1->diffInSeconds($date2);
                            $data['sucursal'] = $data['sucursal'] - $removeSeconds;
                        } else {
                            $data['sucursal'] += $date1->diffInSeconds($date2);
                        }
                    }
                }
            }
        }



        return view('factoryrequests.show', [
            'factoryRequest' => $this->factoryRequestInterface->findFactoryRequestByIdFull($id),
            'timeFactory'    => Carbon::now()->subSeconds($data['fabrica'])->diffForHumans(null, true, true, 3),
            'timeSubsidiary' => Carbon::now()->subSeconds($data['sucursal'])->diffForHumans(null, true, true, 3)
        ]);
    }

    public function assignAssesorDigitalToLead($solicitud)
    {
        $factoryRequest = $this->factoryRequestInterface->findFactoryRequestById($solicitud);
        $factoryRequest->ASESOR_DIG = auth()->user()->id;
        $factoryRequest->CODASESOR = auth()->user()->email;
        return response()->json($factoryRequest->save());
    }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $assessor = '';
        $subsidiary = '';
        $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses($from, $to);
        $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal($from, $to);
        $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados($from, $to, array(19, 20));
        $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, 16);
        $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, array(15, 13));
        $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes($from, $to,  array(13, 15, 19, 16, 20, 14, 1));

        $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
        $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
        $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
        $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor,  array(13, 15, 19, 16, 20, 14, 1), $subsidiary);

        if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {

            $to = request()->input('to') . " 23:59:59";
            $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), $to, $assessor, array(19, 20), $subsidiary);
            $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 16, $subsidiary);
            $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 15, $subsidiary);
            $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), $to, $assessor,  array(13, 15, 19, 16, 20, 14, 1), $subsidiary);
        }


        if (request()->has('from')) {
            $to = request()->input('to') . " 23:59:59";
            $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal(request()->input('from'), $to);
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses(request()->input('from'), $to);
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), $to);
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados(request()->input('from'), $to, array(19, 20));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), $to, 16);
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), $to, array(15, 13));
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes(request()->input('from'), $to,  array(13, 15, 19, 16, 20, 14, 1));
        }


        foreach ($estadosNames as $key => $status) {
            if ($estadosNames[$key]->factoryRequestStatus) {
                $estadosNames[$key]['ESTADO'] =  $estadosNames[$key]->factoryRequestStatus->name;
            }
        }

        foreach ($webCounts as $key => $status) {
            if ($webCounts[$key]->factoryRequestStatus) {
                $webCounts[$key]['ESTADO'] =  $webCounts[$key]->factoryRequestStatus->name;
            }
        }

        $estadosNames = $this->toolsInterface->extractValuesToArray($estadosNames);
        $webCounts    = $this->toolsInterface->extractValuesToArray($webCounts);
        $estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
        $estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
        $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
        $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

        $valuesEstadosAprobados = $this->toolsInterface->extractValuesToArray($valuesEstadosAprobados);
        $valuesEstadosNegados = $this->toolsInterface->extractValuesToArray($valuesEstadosNegados);
        $valuesEstadosDesistidos = $this->toolsInterface->extractValuesToArray($valuesEstadosDesistidos);
        $valuesEstadosPendientes = $this->toolsInterface->extractValuesToArray($valuesEstadosPendientes);

        $statusesAprobadosValue = [];
        foreach ($estadosAprobados as $estadosAprobado) {
            array_push($statusesAprobadosValue, trim($estadosAprobado['total']));
        }
        $statusesAprobadosValues = 0;
        foreach ($statusesAprobadosValue as $key => $status) {
            $statusesAprobadosValues +=  $statusesAprobadosValue[$key];
        }

        $statusesNegadoValues = [];
        foreach ($estadosNegados as $estadosNegado) {
            array_push($statusesNegadoValues, trim($estadosNegado['total']));
        }


        $statusesDesistidosValues = [];
        foreach ($estadosDesistidos as $estadosDesistido) {
            array_push($statusesDesistidosValues, trim($estadosDesistido['total']));
        }


        $statusesPendientesValue = [];
        foreach ($estadosPendientes as $estadosPendiente) {
            array_push($statusesPendientesValue, trim($estadosPendiente['total']));
        }

        $statusesPendientesValues = 0;
        foreach ($statusesPendientesValue as $key => $status) {
            $statusesPendientesValues +=  $statusesPendientesValue[$key];
        }


        $statusesNames  = [];
        $statusesValues = [];


        foreach ($estadosNames as $estadosName) {
            array_push($statusesNames, trim($estadosName['ESTADO']));
            array_push($statusesValues, trim($estadosName['total']));
        }

        $valuesOfStatusesAprobado = [];
        foreach ($valuesEstadosAprobados as $valuesEstadosAprobado) {
            array_push($valuesOfStatusesAprobado, trim($valuesEstadosAprobado['total']));
        }
        $valuesOfStatusesAprobados = 0;
        foreach ($valuesOfStatusesAprobado as $key => $status) {
            $valuesOfStatusesAprobados +=  $valuesOfStatusesAprobado[$key];
        }

        $valuesOfStatusesNegado = [];
        foreach ($valuesEstadosNegados as $valuesEstadosNegado) {
            array_push($valuesOfStatusesNegado, trim($valuesEstadosNegado['total']));
        }
        $valuesOfStatusesNegados = 0;
        foreach ($valuesOfStatusesNegado as $key => $status) {
            $valuesOfStatusesNegados +=  $valuesOfStatusesNegado[$key];
        }

        $valuesOfStatusesDesistido = [];
        foreach ($valuesEstadosDesistidos as $valuesEstadosDesistido) {
            array_push($valuesOfStatusesDesistido, trim($valuesEstadosDesistido['total']));
        }
        $valuesOfStatusesDesistidos = 0;
        foreach ($valuesOfStatusesDesistido as $key => $status) {
            $valuesOfStatusesDesistidos +=  $valuesOfStatusesDesistido[$key];
        }

        $valuesOfStatusesPendiente = [];
        foreach ($valuesEstadosPendientes as $valuesEstadosPendiente) {
            array_push($valuesOfStatusesPendiente, trim($valuesEstadosPendiente['total']));
        }
        $valuesOfStatusesPendientes = 0;
        foreach ($valuesOfStatusesPendiente as $key => $status) {
            $valuesOfStatusesPendientes +=  $valuesOfStatusesPendiente[$key];
        }



        $webValues      = [];
        $webNames       = [];

        foreach ($webCounts as $webCount) {
            array_push($webNames, trim($webCount['ESTADO']));
            array_push($webValues, trim($webCount['total']));
        }
        return view('factoryrequests.dashboard', [
            'statusesNames'            => $statusesNames,
            'statusesValues'           => $statusesValues,
            'webValues'                => $webValues,
            'webNames'                 => $webNames,
            'totalWeb'                 => array_sum($webValues),
            'totalStatuses'            => array_sum($statusesValues),
            'factoryRequestsTotal'     => $factoryRequestsTotal,
            'statusesAprobadosValues'  => $statusesAprobadosValues,
            'statusesNegadoValues'     => $statusesNegadoValues,
            'statusesPendientesValues' => $statusesPendientesValues,
            'statusesDesistidosValues' => $statusesDesistidosValues,
            'valuesOfStatusesAprobados' => $valuesOfStatusesAprobados,
            'valuesOfStatusesNegados' => $valuesOfStatusesNegados,
            'valuesOfStatusesDesistidos' => $valuesOfStatusesDesistidos,
            'valuesOfStatusesPendientes' => $valuesOfStatusesPendientes
        ]);
    }
}
