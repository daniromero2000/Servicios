<?php

namespace App\Http\Controllers\Admin\Directors;

use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DirectorController extends Controller
{
  private $toolsInterface, $factoryInterface;

  public function __construct(
    FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
    ToolRepositoryInterface $toolRepositoryInterface
  ) {
    $this->factoryInterface = $factoryRequestRepositoryInterface;
    $this->toolsInterface = $toolRepositoryInterface;
    $this->middleware('auth')->except('logout');
  }

  public function index(Request $request)
  {
    $director = auth()->user()->codeOportudata;
    $skip     = $this->toolsInterface->getSkip($request->input('skip'));
    $list     = $this->factoryInterface->listFactoryDirector($skip * 30, $director);

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
    }

    $listCount            = $list->count();
    $factoryRequestsTotal = $list->sum('GRAN_TOTAL');

    return view('director.list', [
      'factoryRequests'      => $list,
      'optionsRoutes'        => (request()->segment(2)),
      'headers'              => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
      'listCount'            => $listCount,
      'skip'                 => $skip,
      'factoryRequestsTotal' => $factoryRequestsTotal,

    ]);
  }


  public function dashboard(Request $request)
  {

    $director = auth()->user()->codeOportudata;

    $to   = Carbon::now();
    $from = Carbon::now()->subMonth();

    $rand  = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

    $estadosNamesDirector         = $this->factoryInterface->countDirectorFactoryRequestStatuses($from, $to, $director);
    $webDirectorCounts            = $this->factoryInterface->countWebDirectorFactory($from, $to, $director);
    $factoryRequestsTotal = $this->factoryInterface->getDirectorFactoryTotal($from, $to, $director);
    $estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "APROBADO");
    $estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "NEGADO");
    $estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "DESISTIDO");
    $estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector($from, $to, $director, "PENDIENTE");

    if (request()->has('from')) {
      $estadosNamesDirector         = $this->factoryInterface->countDirectorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $director);
      $webDirectorCounts            = $this->factoryInterface->countWebDirectorFactory(request()->input('from'), request()->input('to'), $director);
      $factoryRequestsTotal = $this->factoryInterface->getDirectorFactoryTotal(request()->input('from'), request()->input('to'), $director);
      $estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "APROBADO");
      $estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "NEGADO");
      $estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "DESISTIDO");
      $estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesGeneralsDirector(request()->input('from'), request()->input('to'), $director, "PENDIENTE");
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

    $statusesAprobadosValues = [];
    foreach ($estadosAprobados as $estadosAprobado) {
      array_push($statusesAprobadosValues, trim($estadosAprobado['total']));
    }


    $statusesNegadoValues = [];
    foreach ($estadosNegados as $estadosNegado) {
      array_push($statusesNegadoValues, trim($estadosNegado['total']));
    }


    $statusesDesistidosValues = [];
    foreach ($estadosDesistidos as $estadosDesistido) {
      array_push($statusesDesistidosValues, trim($estadosDesistido['total']));
    }


    $statusesPendientesValues = [];
    foreach ($estadosPendientes as $estadosPendiente) {
      array_push($statusesPendientesValues, trim($estadosPendiente['total']));
    }


    foreach ($webDirectorCounts as $webCount) {
      array_push($webNames, trim($webCount['ESTADO']));
      array_push($webValues, trim($webCount['total']));
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
      array_push($webColors, trim($color));
    }

    return view('director.dashboard', [
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