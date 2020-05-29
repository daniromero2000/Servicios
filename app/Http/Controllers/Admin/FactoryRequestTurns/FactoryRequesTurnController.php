<?php

namespace App\Http\Controllers\Admin\FactoryRequestTurns;

use App\Http\Controllers\Controller;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;



class FactoryRequesTurnController extends Controller
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
        $factoryRequestsTotals = $this->factoryRequestInterface->getFactoryRequestsTotalTurns($from, $to);
        $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotalTurn($from, $to);
        $listCount = $factoryRequestsTotals->count();
        $assessor = '';
        $subsidiary = '';
        $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'), $subsidiary);
        $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "NEGADO", $subsidiary);
        $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "DESISTIDO", $subsidiary);
        $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $subsidiary);
        $Subsidiarys = Subsidiary::all();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->factoryRequestInterface->listFactoryRequestsTurns($skip * 30);
        if (request()->has('skip')) {
            $list = $this->factoryRequestInterface->listFactoryRequestsTurns(request()->input('skip') * 30);
        }

        if (request()->has('q') && request()->input('from') == '' && request()->input('to') == '' && request()->input('subsidiary') != '') {
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'), request()->input('subsidiary'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "NEGADO", request()->input('subsidiary'));
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "DESISTIDO", request()->input('subsidiary'));
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), request()->input('subsidiary'));
        }
        if (request()->has('q') && request()->input('from') != '' && request()->input('to') != '') {
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array('APROBADO', 'EN FACTURACION'), request()->input('subsidiary'));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "NEGADO", request()->input('subsidiary'));
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "DESISTIDO", request()->input('subsidiary'));
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), request()->input('subsidiary'));
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
                request()->input('groupStatus')
            )->sortByDesc('FECHASOL');
            $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequestTurns(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('status'),
                request()->input('subsidiary'),
                request()->input('soliWeb'),
                request()->input('groupStatus')
            )->sortByDesc('FECHASOL');

            $factoryRequestsTotal = $list->sum('GRAN_TOTAL');
        }
        $estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
        $estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
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

        $listCount = $factoryRequestsTotals->count();

        return view('factoryrequestsTurns.list', [
            'factoryRequests'             => $list,
            'optionsRoutes'               => (request()->segment(2)),
            'headers'                     => ['Sucursal', 'Solicitud', 'Fecha de solicitud', 'Estado', 'Cliente',  'Tipo de Cliente', 'Subtipo de Cliente', 'Analista',  'Fecha de analisis',  'Fecha de asignación', 'Calificación del cliente', 'Total',  'Prioridad'],
            'listCount'                   => $listCount,
            'skip'                        => $skip,
            'factoryRequestsTotal'        => $factoryRequestsTotal,
            'Subsidiarys'                 => $Subsidiarys,
            'statusesAprobadosValues'     => $statusesAprobadosValues,
            'statusesNegadosValues'       => $statusesNegadosValues,
            'statusesDesistidosValues'    => $statusesDesistidosValues,
            'statusesPendientesValues'    => $statusesPendientesValues
        ]);
    }


    public function show(int $id)
    {
    }


    public function dashboard(Request $request)
    {
    }
}