<?php

namespace App\Http\Controllers\Admin\Directors;

use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DirectorController extends Controller
{
  private $toolsInterface, $factoryInterface, $SubsidiaryInterface;

  public function __construct(
    FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
    ToolRepositoryInterface $toolRepositoryInterface,
    SubsidiaryRepositoryInterface $SubsidiaryRepositoryInterface
  ) {
    $this->factoryInterface = $factoryRequestRepositoryInterface;
    $this->toolsInterface = $toolRepositoryInterface;
    $this->SubsidiaryInterface = $SubsidiaryRepositoryInterface;
    $this->middleware('auth')->except('logout');
  }

  public function index(Request $request)
  {
    $to = Carbon::now();
    $from = Carbon::now()->startOfMonth();
    $assessor = '';

    $director = auth()->user()->Assessor->SUCURSAL;
    $skip     = $this->toolsInterface->getSkip($request->input('skip'));
    $list     = $this->factoryInterface->listFactoryDirector($skip * 30, $director);
    $listCount = $this->factoryInterface->listFactoryDirectorTotal($from, $to, $director);
    $estadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'), $director);
    $estadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "NEGADO", $director);
    $estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "DESISTIDO", $director);
    $estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $director);

    if (request()->has('q') && request()->input('from') == '' && request()->input('to') == '' && request()->input('assessor') != '') {
      $estadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, request()->input('assessor'), array('APROBADO', 'EN FACTURACION'), $director);
      $estadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, request()->input('assessor'), "NEGADO", $director);
      $estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, request()->input('assessor'), "DESISTIDO", $director);
      $estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, request()->input('assessor'), array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $director);
    }
    if (request()->has('q') && request()->input('from') != '' && request()->input('to') != '') {
      $estadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), request()->input('assessor'), array('APROBADO', 'EN FACTURACION'), $director);
      $estadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), request()->input('assessor'), "NEGADO", $director);
      $estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), request()->input('assessor'), "DESISTIDO", $director);
      $estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), request()->input('assessor'), array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $director);
    }

    if (request()->has('q')) {
      $list = $this->factoryInterface->searchFactoryDirectors(
        request()->input('q'),
        $skip,
        request()->input('from'),
        request()->input('to'),
        request()->input('status'),
        request()->input('assessor'),
        $director
      )->sortByDesc('FECHASOL');
      $listCount = $this->factoryInterface->searchFactoryDirectors(
        request()->input('q'),
        $skip,
        request()->input('from'),
        request()->input('to'),
        request()->input('status'),
        request()->input('assessor'),
        $director
      )->sortByDesc('FECHASOL');
    }

    $factoryRequestsTotal = $listCount->sum('GRAN_TOTAL');
    $listCount            = $listCount->count();

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

    return view('director.list', [
      'factoryRequests'      => $list,
      'optionsRoutes'        => (request()->segment(2)),
      'headers'              => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
      'listCount'            => $listCount,
      'skip'                 => $skip,
      'factoryRequestsTotal' => $factoryRequestsTotal,
      'statusesAprobadosValues'        => $statusesAprobadosValues,
      'statusesNegadosValues'        => $statusesNegadosValues,
      'statusesDesistidosValues'      => $statusesDesistidosValues,
      'statusesPendientesValues'     => $statusesPendientesValues
    ]);
  }


  public function dashboard(Request $request)
  {
    $director = auth()->user()->Assessor->SUCURSAL;
    $assessor = '';

    $to   = Carbon::now();
    $from = Carbon::now()->startOfMonth();

    $rand  = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

    $estadosNamesDirector   = $this->factoryInterface->countDirectorFactoryRequestStatuses($from, $to, $director);
    $webDirectorCounts      = $this->factoryInterface->countWebDirectorFactory($from, $to, $director);
    $factoryRequestsTotal   = $this->factoryInterface->getDirectorFactoryTotal($from, $to, $director);
    $estadosAprobados       = $this->factoryInterface->countFactoryRequestsStatusesAprobadosDirector($from, $to, $director, array('APROBADO', 'EN FACTURACION'));
    $estadosNegados         = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "NEGADO");
    $estadosDesistidos      = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "DESISTIDO");
    $estadosPendientes      = $this->factoryInterface->countFactoryRequestsStatusesPendientesDirector($from, $to, $director, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));

    $valuesEstadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'), $director);
    $valuesEstadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "NEGADO", $director);
    $valuesEstadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, "DESISTIDO", $director);
    $valuesEstadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $director);

    if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
      $valuesEstadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array('APROBADO', 'EN FACTURACION'), $director);
      $valuesEstadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "NEGADO", $director);
      $valuesEstadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "DESISTIDO", $director);
      $valuesEstadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'), $director);
    }

    if (request()->has('from')) {
      $estadosNamesDirector         = $this->factoryInterface->countDirectorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $director);
      $webDirectorCounts            = $this->factoryInterface->countWebDirectorFactory(request()->input('from'), request()->input('to'), $director);
      $factoryRequestsTotal = $this->factoryInterface->getDirectorFactoryTotal(request()->input('from'), request()->input('to'), $director);
      $estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosDirector(request()->input('from'), request()->input('to'), $director, array('APROBADO', 'EN FACTURACION'));
      $estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "NEGADO");
      $estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "DESISTIDO");
      $estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesDirector(request()->input('from'), request()->input('to'), $director, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
    }

    $estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
    $estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
    $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
    $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

    $valuesEstadosAprobados = $this->toolsInterface->extractValuesToArray($valuesEstadosAprobados);
    $valuesEstadosNegados = $this->toolsInterface->extractValuesToArray($valuesEstadosNegados);
    $valuesEstadosDesistidos = $this->toolsInterface->extractValuesToArray($valuesEstadosDesistidos);
    $valuesEstadosPendientes = $this->toolsInterface->extractValuesToArray($valuesEstadosPendientes);

    $estadosNamesDirector   = $estadosNamesDirector->toArray();
    $webDirectorCounts      = $webDirectorCounts->toArray();
    $estadosNamesDirector   = array_values($estadosNamesDirector);
    $webDirectorCounts      = array_values($webDirectorCounts);

    $statusesDirectorNames  = [];
    $statusesDirectorValues = [];
    $statusesDirectorColors = [];

    foreach ($estadosNamesDirector as $estadosName) {
      array_push($statusesDirectorNames, trim($estadosName['ESTADO']));
      array_push($statusesDirectorValues, trim($estadosName['total']));
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
      array_push($statusesDirectorColors, trim($color));
    }

    $webValues   = [];
    $webNames    = [];
    $webColors   = [];

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


    foreach ($webDirectorCounts as $webCount) {
      array_push($webNames, trim($webCount['ESTADO']));
      array_push($webValues, trim($webCount['total']));
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
      array_push($webColors, trim($color));
    }

    return view('director.dashboard', [
      'statusesDirectorNames'    => $statusesDirectorNames,
      'statusesValues'           => $statusesDirectorValues,
      'statusesColors'           => $statusesDirectorColors,
      'webValues'                => $webValues,
      'webNames'                 => $webNames,
      'webColors'                => $webColors,
      'totalWeb'                 => array_sum($webValues),
      'totalStatuses'            => array_sum($statusesDirectorValues),
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

  public function directorZona1(Request $request)
  {
    $to = Carbon::now();
    $from = Carbon::now()->startOfMonth();
    $skip     = $this->toolsInterface->getSkip($request->input('skip'));
    $listCountForAssessor = $this->SubsidiaryInterface->listSubsidiaryForDirector();
    $list     = $this->factoryInterface->listFactoryDirectorZona($skip * 30, $listCountForAssessor);
    $listCount = $this->factoryInterface->listFactoryForDirectorZonaUp($from, $to, $listCountForAssessor);


    if (request()->has('q')) {
      $list = $this->factoryInterface->searchFactoryDirectorsZona(
        request()->input('q'),
        $skip,
        request()->input('from'),
        request()->input('to'),
        request()->input('status'),
        request()->input('assessor'),
        $listCountForAssessor
      )->sortByDesc('FECHASOL');
      $listCount = $this->factoryInterface->searchFactoryDirectorsZona(
        request()->input('q'),
        $skip,
        request()->input('from'),
        request()->input('to'),
        request()->input('status'),
        request()->input('assessor'),
        $listCountForAssessor
      )->sortByDesc('FECHASOL');
    }

    $factoryRequestsTotal = $listCount->sum('GRAN_TOTAL');
    $listCount            = $listCount->count();

    return view('directorZona.list', [
      'factoryRequests'      => $list,
      'optionsRoutes'        => (request()->segment(2)),
      'headers'              => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
      'listCount'            => $listCount,
      'skip'                 => $skip,
      'factoryRequestsTotal' => $factoryRequestsTotal,

    ]);
  }


  public function dashboardZona1(Request $request)
  {

    $director = $this->SubsidiaryInterface->listSubsidiaryForDirector();

    $to   = Carbon::now();
    $from = Carbon::now()->startOfMonth();

    $rand  = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

    $estadosNamesDirector   = $this->factoryInterface->countDirectorZonaFactoryRequestStatuses($from, $to, $director);
    $webDirectorCounts      = $this->factoryInterface->countWebDirectorZonaFactory($from, $to, $director);
    $factoryRequestsTotal   = $this->factoryInterface->getDirectorFactoryTotal($from, $to, $director);
    $estadosAprobados       = $this->factoryInterface->countFactoryRequestsStatusesAprobadosDirectorZona($from, $to, $director, array('APROBADO', 'EN FACTURACION'));
    $estadosNegados         = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirectorZona($from, $to, $director, "NEGADO");
    $estadosDesistidos      = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirectorZona($from, $to, $director, "DESISTIDO");
    $estadosPendientes      = $this->factoryInterface->countFactoryRequestsStatusesPendientesDirectorZona($from, $to, $director, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));

    if (request()->has('from')) {
      $estadosNamesDirector         = $this->factoryInterface->countDirectorZonaFactoryRequestStatuses(request()->input('from'), request()->input('to'), $director);
      $webDirectorCounts            = $this->factoryInterface->countWebDirectorZonaFactory(request()->input('from'), request()->input('to'), $director);
      $factoryRequestsTotal = $this->factoryInterface->getDirectorFactoryTotal(request()->input('from'), request()->input('to'), $director);
      $estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosDirectorZona(request()->input('from'), request()->input('to'), $director, array('APROBADO', 'EN FACTURACION'));
      $estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirectorZona(request()->input('from'), request()->input('to'), $director, "NEGADO");
      $estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirectorZona(request()->input('from'), request()->input('to'), $director, "DESISTIDO");
      $estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesDirectorZona(request()->input('from'), request()->input('to'), $director, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
    }

    $estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
    $estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
    $estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
    $estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);
    $estadosNamesDirector   = $estadosNamesDirector->toArray();
    $webDirectorCounts      = $webDirectorCounts->toArray();
    $estadosNamesDirector   = array_values($estadosNamesDirector);
    $webDirectorCounts      = array_values($webDirectorCounts);

    $statusesDirectorNames  = [];
    $statusesDirectorValues = [];
    $statusesDirectorColors = [];

    foreach ($estadosNamesDirector as $estadosName) {
      array_push($statusesDirectorNames, trim($estadosName['ESTADO']));
      array_push($statusesDirectorValues, trim($estadosName['total']));
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
      array_push($statusesDirectorColors, trim($color));
    }

    $webValues   = [];
    $webNames    = [];
    $webColors   = [];

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

    foreach ($webDirectorCounts as $webCount) {
      array_push($webNames, trim($webCount['ESTADO']));
      array_push($webValues, trim($webCount['total']));
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
      array_push($webColors, trim($color));
    }

    return view('directorZona.dashboard', [
      'statusesDirectorNames'  => $statusesDirectorNames,
      'statusesValues'         => $statusesDirectorValues,
      'statusesColors'         => $statusesDirectorColors,
      'webValues'              => $webValues,
      'webNames'               => $webNames,
      'webColors'              => $webColors,
      'totalWeb'               => array_sum($webValues),
      'totalStatuses'          => array_sum($statusesDirectorValues),
      'factoryRequestsTotal'   => $factoryRequestsTotal,
      'statusesAprobadosValues'  => $statusesAprobadosValues,
      'statusesNegadoValues'     => $statusesNegadoValues,
      'statusesPendientesValues' => $statusesPendientesValues,
      'statusesDesistidosValues' => $statusesDesistidosValues
    ]);
  }
}