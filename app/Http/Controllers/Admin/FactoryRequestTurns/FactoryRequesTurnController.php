<?php

namespace App\Http\Controllers\Admin\FactoryRequestTurns;

use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Subsidiaries\Subsidiary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FactoryRequesTurnController extends Controller
{
    private $factoryRequestInterface, $toolsInterface, $turnInterface;

    public function __construct(
        FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        TurnRepositoryInterface $turnRepositoryInterface
    ) {
        $this->factoryRequestInterface = $factoryRequestRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->turnInterface = $turnRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $factoryRequestsTotals = $this->factoryRequestInterface->getFactoryRequestsTotalTurns($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotalTurn($from, $to);
        $analysts   = $this->turnInterface->getListAnalysts();
        $listCount = $factoryRequestsTotals->count();

        $Subsidiarys = Subsidiary::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequestsTurns($skip * 30);
        if (request()->has('skip')) {
            $list = $this->factoryRequestInterface->listFactoryRequestsTurns(request()->input('skip') * 30);
        }
        if (request()->has('q')) {
            $list = $this->factoryRequestInterface->searchFactoryRequestTurns(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb'),
                request()->input('groupStatus'),
                request()->input('customerLine'),
                request()->input('analyst')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequestTurnsTotal(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb'),
                request()->input('groupStatus'),
                request()->input('customerLine'),
                request()->input('analyst')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotal = $factoryRequestsTotals->sum('GRAN_TOTAL');
        }

        $listCount = $factoryRequestsTotals->count();
        // dd($list);

        return view('factoryrequestsTurns.list', [
            'factoryRequests'             => $list,
            'optionsRoutes'               => (request()->segment(2)),
            'headers'                     => ['Sucursal', 'Solicitud', 'Fecha de solicitud', 'Estado', 'Cliente',  'Tipo de Cliente', 'Subtipo de Cliente', 'Analista',  'Fecha de analisis',  'Fecha de asignación', 'Calificación del cliente', 'Total',  'Prioridad'],
            'listCount'                   => $listCount,
            'skip'                        => $skip,
            'factoryRequestsTotal'        => $factoryRequestsTotal,
            'Subsidiarys'                 => $Subsidiarys,
            'analysts'                    => $analysts
        ]);
    }


    public function show(int $id)
    {
        //
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
        $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados($from, $to, array('APROBADO', 'EN FACTURACION'));
        $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, "NEGADO");
        $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, "DESISTIDO");
        $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes($from, $to, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));

        $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'), $subsidiary);
        $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "NEGADO", $subsidiary);
        $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "DESISTIDO", $subsidiary);
        $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $subsidiary);

        if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
            $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array('APROBADO', 'EN FACTURACION'), $subsidiary);
            $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "NEGADO", $subsidiary);
            $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "DESISTIDO", $subsidiary);
            $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $subsidiary);
        }


        if (request()->has('from')) {
            $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotal(request()->input('from'), request()->input('to'));
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatuses(request()->input('from'), request()->input('to'));
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), request()->input('to'));
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados(request()->input('from'), request()->input('to'), array('APROBADO', 'EN FACTURACION'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), request()->input('to'), "NEGADO");
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), request()->input('to'), "DESISTIDO");
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes(request()->input('from'), request()->input('to'), array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
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
        return view('factoryrequestsTurns.dashboard', [
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