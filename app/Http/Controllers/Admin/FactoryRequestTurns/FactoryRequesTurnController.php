<?php

namespace App\Http\Controllers\Admin\FactoryRequestTurns;

use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\Tools\Exports\ExportToExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

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
        $recovering = $this->factoryRequestInterface->listFactoryRequestsRecovering($skip * 60);

        if (request()->has('skip')) {
            $list = $this->factoryRequestInterface->listFactoryRequestsTurns(request()->input('skip') * 30);
        }

        if (request()->has('q')) {
            $cont = 0;
            switch ($request->input('action')) {
                case 'search':
                    $to = request()->input('to') . " 23:59:59";
                    $list = $this->factoryRequestInterface->searchFactoryRequestTurns(
                        request()->input('q'),
                        $skip,
                        request()->input('from'),
                        $to,
                        request()->input('status'),
                        request()->input('subsidiary'),
                        request()->input('soliWeb'),
                        request()->input('groupStatus'),
                        request()->input('customerLine'),
                        request()->input('analyst'),
                        request()->input('action')
                    )->sortByDesc('FECHASOL');

                    $factoryRequestsTotals = $this->factoryRequestInterface->searchFactoryRequestTurnsTotal(
                        request()->input('q'),
                        $skip,
                        request()->input('from'),
                        $to,
                        request()->input('status'),
                        request()->input('subsidiary'),
                        request()->input('soliWeb'),
                        request()->input('groupStatus'),
                        request()->input('customerLine'),
                        request()->input('analyst')
                    )->sortByDesc('FECHASOL');

                    $factoryRequestsTotal = $factoryRequestsTotals->sum('GRAN_TOTAL');

                    break;
                case 'export':
                    $to = request()->input('to') . " 23:59:59";
                    $list = $this->factoryRequestInterface->searchFactoryRequestTurns(
                        request()->input('q'),
                        $skip,
                        request()->input('from'),
                        $to,
                        request()->input('status'),
                        request()->input('subsidiary'),
                        request()->input('soliWeb'),
                        request()->input('groupStatus'),
                        request()->input('customerLine'),
                        request()->input('analyst'),
                        request()->input('action')
                    )->sortByDesc('FECHASOL');

                    ini_set('memory_limit', "512M");

                    foreach ($list as $key => $value) {
                        $cont++;
                        if ($cont == 1) {
                            $printExcel[] = [
                                'SUCURSAL',
                                'SOLICITUD',
                                'CEDULA',
                                'APELLIDOS',
                                'NOMBRES',
                                'DIRECCION',
                                'CELULAR',
                                'ACTIVIDAD',
                                'FECHA SOLICITUD',
                                'FECHA DE ESTADO',
                                'ESTADO',
                                'TIPO',
                                'SUBTIPO',
                                'ANALISTA',
                                'FECHA RET',
                                'FECHA FIN',
                                'VALOR',
                                'FECHA ASIGNACION',
                                'SCORE',
                                'TIPO CLIENTE',
                                'CED_COD1',
                                'APELLIDOS1',
                                'NOMBRES1',
                                'DIRECCION1',
                                'CELULAR1',
                                'ACTIVIDAD1',
                                'SCO_COD1',
                                'TIPO_COD1',
                                'CED_COD2',
                                'APELLIDOS2',
                                'NOMBRES2',
                                'DIRECCION2',
                                'CELULAR2',
                                'ACTIVIDAD2',
                                'SCO_COD2',
                                'TIPO_COD2'
                            ];
                        }

                        if (empty($value->customer->latestCifinScore)) {
                            $score = '';
                        } else {
                            $score = $value->customer->latestCifinScore['score'];
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->TIPO)) {
                            $tipoOportuya = trim($value->turnoTradicional->TIPO);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->TIPO)) {
                            $tipoOportuya = trim($value->turnoOportuya->TIPO);
                        } else {
                            $tipoOportuya = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->SUB_TIPO)) {
                            $subTipoOportuya = trim($value->turnoTradicional->SUB_TIPO);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->SUB_TIPO)) {
                            $subTipoOportuya = trim($value->turnoOportuya->SUB_TIPO);
                        } else {
                            $subTipoOportuya = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->USUARIO)) {
                            $analista = trim($value->turnoTradicional->USUARIO);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->USUARIO)) {
                            $analista = trim($value->turnoOportuya->USUARIO);
                        } else {
                            $analista = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->USUARIO)) {
                            $analista = trim($value->turnoTradicional->USUARIO);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->USUARIO)) {
                            $analista = trim($value->turnoOportuya->USUARIO);
                        } else {
                            $analista = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->FEC_RET)) {
                            $fecha_ret = trim($value->turnoTradicional->FEC_RET);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->FEC_RET)) {
                            $fecha_ret = trim($value->turnoOportuya->FEC_RET);
                        } else {
                            $fecha_ret = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->FEC_FIN)) {
                            $fecha_fin = trim($value->turnoTradicional->FEC_FIN);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->FEC_FIN)) {
                            $fecha_fin = trim($value->turnoOportuya->FEC_FIN);
                        } else {
                            $fecha_fin = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->SCORE)) {
                            $score = trim($value->turnoTradicional->SCORE);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->SCORE)) {
                            $score = trim($value->turnoOportuya->SCORE);
                        } else {
                            $score = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->TIPO_CLI)) {
                            $tipoCliente = trim($value->turnoTradicional->TIPO_CLI);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->TIPO_CLI)) {
                            $tipoCliente = trim($value->turnoOportuya->TIPO_CLI);
                        } else {
                            $tipoCliente = '';
                        }

                        if ($value->turnoTradicional && !empty($value->turnoTradicional->FEC_ASIG)) {
                            $fechaAsignacion = trim($value->turnoTradicional->FEC_ASIG);
                        } elseif ($value->turnoOportuya && !empty($value->turnoOportuya->FEC_ASIG)) {
                            $fechaAsignacion = trim($value->turnoOportuya->FEC_ASIG);
                        } else {
                            $fechaAsignacion = '';
                        }

                        if (empty($value->factoryRequestCodebtor1)) {
                            $codebtor1 = '';
                            $codebtorNombres1 = '';
                            $codebtorApellidos1 = '';
                            $codebtorDireccion1 = '';
                            $codebtorCelular1 = '';
                            $codebtorActividad1 = '';
                        } else {
                            $codebtor1 = $value->factoryRequestCodebtor1['CEDULA'];
                            $codebtorApellidos1 = $value->factoryRequestCodebtor1['APELLIDOS'];
                            $codebtorNombres1 = $value->factoryRequestCodebtor1['NOMBRES'];
                            $codebtorDireccion1 = $value->factoryRequestCodebtor1['DIRECCION'];
                            $codebtorCelular1 = $value->factoryRequestCodebtor1['CELULAR'];
                            $codebtorActividad1 = $value->factoryRequestCodebtor1['ACTIVIDAD'];
                        }

                        if (empty($value->factoryRequestCodebtor2)) {
                            $codebtor2 = '';
                            $codebtorNombres2 = '';
                            $codebtorApellidos2 = '';
                            $codebtorDireccion2 = '';
                            $codebtorCelular2 = '';
                            $codebtorActividad2 = '';
                        } else {
                            $codebtor2 = $value->factoryRequestCodebtor1['CEDULA'];
                            $codebtorApellidos2 = $value->factoryRequestCodebtor1['APELLIDOS'];
                            $codebtorNombres2 = $value->factoryRequestCodebtor1['NOMBRES'];
                            $codebtorDireccion2 = $value->factoryRequestCodebtor1['DIRECCION'];
                            $codebtorCelular2 = $value->factoryRequestCodebtor1['CELULAR'];
                            $codebtorActividad2 = $value->factoryRequestCodebtor1['ACTIVIDAD'];
                        }

                        $printExcel[] = [
                            $value->SUCURSAL,
                            $value->SOLICITUD,
                            $value->CLIENTE,
                            $value->customer['APELLIDOS'],
                            $value->customer['NOMBRES'],
                            $value->customer['DIRECCION'],
                            $value->customer['CELULAR'],
                            $value->customer['ACTIVIDAD'],
                            $value->FECHASOL,
                            $value->factoryRequestStatus->name,
                            trim($value->FactoryRequestStatus->name),
                            $tipoOportuya,
                            $subTipoOportuya,
                            $analista,
                            $fecha_ret,
                            $fecha_fin,
                            $value->GRAN_TOTAL,
                            $fechaAsignacion,
                            $score,
                            $tipoCliente,
                            $codebtor1,
                            $codebtorApellidos1,
                            $codebtorNombres1,
                            $codebtorDireccion1,
                            $codebtorCelular1,
                            $codebtorActividad1,
                            $value->SCO_COD1,
                            $value->TIPO_COD1,
                            $codebtor2,
                            $codebtorApellidos2,
                            $codebtorNombres2,
                            $codebtorDireccion2,
                            $codebtorCelular2,
                            $codebtorActividad2,
                            $value->SCO_COD2,
                            $value->TIPO_COD2
                        ];
                    }

                    $export = new ExportToExcel($printExcel);
                    return Excel::download($export, 'SolicitudesClientes.xlsx');
                    break;
            }
        }

        $listCount = $factoryRequestsTotals->count();
        $statuses = FactoryRequestStatus::select('id', 'name')->orderBy('name', 'ASC')->get();

        return view('factoryrequestsTurns.list', [
            'factoryRequests'             => $list,
            'optionsRoutes'               => (request()->segment(2)),
            'headers'                     => ['Sucursal', 'Solicitud', 'Fecha de solicitud', 'Fecha de estado', 'Estado', 'Cliente',  'Tipo de Cliente', 'Subtipo de Cliente', 'Analista',  'Fecha de analisis',  'Fecha de asignación', 'Calificación del cliente', 'Total',  'Prioridad'],
            'listCount'                   => $listCount,
            'skip'                        => $skip,
            'factoryRequestsTotal'        => $factoryRequestsTotal,
            'Subsidiarys'                 => $Subsidiarys,
            'analysts'                    => $analysts,
            'statuses'                    => $statuses,
            'recovering'                  => $recovering
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
        $estadosNames          = $this->factoryRequestInterface->countFactoryRequestsStatusesTurn($from, $to);
        $webCounts             = $this->factoryRequestInterface->countWebFactoryRequests($from, $to);
        $factoryRequestsTotal  = $this->factoryRequestInterface->getFactoryRequestsTotalTurn($from, $to);
        $estadosAprobados      = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados($from, $to, array(19, 20));
        $estadosNegados        = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, 16);
        $estadosDesistidos     = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados($from, $to, array(15, 13));
        $estadosComites        = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals($from, $to, 14);
        $estadosPendientes     = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes($from, $to, array(13, 15, 19, 16, 20, 14, 1));

        $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
        $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
        $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsTurns($from, $to, array(15, 13));
        $valuesEstadosComites = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 14, $subsidiary);
        $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(13, 15, 19, 16, 20, 14, 1), $subsidiary);

        if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
            $to = request()->input('to') . " 23:59:59";
            $valuesEstadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), $to, $assessor, array(19, 20), $subsidiary);
            $valuesEstadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 16, $subsidiary);
            $valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsTurns(request()->input('from'), $to, array(15, 13));
            $valuesEstadosComites = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), $to, $assessor, 14, $subsidiary);
            $valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), $to, $assessor, array(13, 15, 19, 16, 20, 14, 1), $subsidiary);
        }


        if (request()->has('from')) {
            $to = request()->input('to') . " 23:59:59";
            $factoryRequestsTotal = $this->factoryRequestInterface->getFactoryRequestsTotalTurn(request()->input('from'), $to);
            $estadosNames = $this->factoryRequestInterface->countFactoryRequestsStatusesTurn(request()->input('from'), $to);
            $webCounts    = $this->factoryRequestInterface->countWebFactoryRequests(request()->input('from'), $to);
            $estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados(request()->input('from'), $to, array(19, 20));
            $estadosNegados = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), $to, 16);
            $estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobados(request()->input('from'), $to, array(15, 13));
            $estadosComites = $this->factoryRequestInterface->countFactoryRequestsStatusesGenerals(request()->input('from'), $to, 14);
            $estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientes(request()->input('from'), $to, array(13, 15, 19, 16, 20, 14, 1));
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
        $estadosComites = $this->toolsInterface->extractValuesToArray($estadosComites);
        $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

        $valuesEstadosAprobados = $this->toolsInterface->extractValuesToArray($valuesEstadosAprobados);
        $valuesEstadosNegados = $this->toolsInterface->extractValuesToArray($valuesEstadosNegados);
        $valuesEstadosDesistidos = $this->toolsInterface->extractValuesToArray($valuesEstadosDesistidos);
        $valuesEstadosComites = $this->toolsInterface->extractValuesToArray($valuesEstadosComites);
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

        $statusesComitesValues = [];
        foreach ($estadosComites as $estadosComite) {
            array_push($statusesComitesValues, trim($estadosComite['total']));
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

        $valuesOfStatusesComite = [];
        foreach ($valuesEstadosComites as $valuesEstadosComite) {
            array_push($valuesOfStatusesComite, trim($valuesEstadosComite['total']));
        }
        $valuesOfStatusesComites = 0;
        foreach ($valuesOfStatusesComite as $key => $status) {
            $valuesOfStatusesComites +=  $valuesOfStatusesComite[$key];
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
            'statusesNames'              => $statusesNames,
            'statusesValues'             => $statusesValues,
            'webValues'                  => $webValues,
            'webNames'                   => $webNames,
            'totalWeb'                   => array_sum($webValues),
            'totalStatuses'              => array_sum($statusesValues),
            'factoryRequestsTotal'       => $factoryRequestsTotal,
            'statusesAprobadosValues'    => $statusesAprobadosValues,
            'statusesNegadoValues'       => $statusesNegadoValues,
            'statusesPendientesValues'   => $statusesPendientesValues,
            'statusesDesistidosValues'   => $statusesDesistidosValues,
            'statusesComitesValues'      => $statusesComitesValues,
            'valuesOfStatusesAprobados'  => $valuesOfStatusesAprobados,
            'valuesOfStatusesNegados'    => $valuesOfStatusesNegados,
            'valuesOfStatusesDesistidos' => $valuesOfStatusesDesistidos,
            'valuesOfStatusesComites'    => $valuesOfStatusesComites,
            'valuesOfStatusesPendientes' => $valuesOfStatusesPendientes
        ]);
    }
}
