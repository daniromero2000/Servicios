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
  )
  {
    $this->factoryInterface = $factoryRequestRepositoryInterface;
    $this->toolsInterface = $toolRepositoryInterface;
    $this->middleware('auth')->except('logout');
  }

  public function index(Request $request)
  {
    $user = auth()->user()->codeOportudata;

    $query = sprintf("SELECT cf. CEDULA, cf.NOMBRES, cf.APELLIDOS, cf.CELULAR, cf.EMAIl, cf.CREACION, cf.ESTADO, ti.TARJETA
    FROM CLIENTE_FAB as cf, TB_INTENCIONES as ti
    where ti.CEDULA = cf.CEDULA
    and cf.SUC =  $user
    and cf.CLIENTE_WEB = 1
    and cf.ORIGEN = 'ASESORES-CREDITO'
    and ti.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)");

    if ($request['q'] != '') {
      $query .= sprintf(" AND (cf.`NOMBRES` LIKE '%s' OR cf.`APELLIDOS` LIKE '%s' OR cf.`CEDULA` LIKE '%s') ", '%' . $request['q'] . '%', '%' . $request['q'] . '%', '%' . $request['q'] . '%');
    }

    if ($request['qtipoTarjeta'] != '') {
      $query .= sprintf(" AND (ti.`TARJETA` = '%s') ", $request['qtipoTarjeta']);
    }

    if ($request['qtypeStatus'] != '') {
      $query .= sprintf(" AND (cf.`ESTADO` = '%s') ", $request['qtypeStatus']);
    }

    if ($request['qfechaInicial'] != '') {
      $request['qfechaInicial'] .= " 00:00:00";
      $query .= sprintf(" AND (cf.`CREACION` >= '%s') ", $request['qfechaInicial']);
    }

    if ($request['qfechaFinal'] != '') {
      $request['qfechaFinal'] .= " 23:59:59";
      $query .= sprintf(" AND (cf.`CREACION` <= '%s') ", $request['qfechaFinal']);
    }

    $respTotalLeads = DB::connection('oportudata')->select($query);

    return response()->json([
      'leads' => $respTotalLeads,
      'totalLeads' => count($respTotalLeads)
    ]);
  }


  public function dashboard(Request $request)
  {

      $director = auth()->user()->codeOportudata;   
     
      $to = Carbon::now();
      $from = Carbon::now()->subMonth();

      $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

      $estadosNames = $this->factoryInterface->countDirectorFactoryRequestStatuses($from, $to, $director);
      $webCounts    = $this->factoryInterface->countWebFactoryRequests($from, $to);
      $factoryRequestsTotal = $this->factoryInterface->getFactoryRequestsTotal($from, $to);
      if (request()->has('from')) {
          $estadosNames = $this->factoryInterface->countDirectorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $director);
          $webCounts    = $this->factoryInterface->countWebFactoryRequests(request()->input('from'), request()->input('to'));
          $factoryRequestsTotal = $this->factoryInterface->getFactoryRequestsTotal(request()->input('from'), request()->input('to'));
      }

      $estadosNames   = $estadosNames->toArray();
      $webCounts      = $webCounts->toArray();
      $estadosNames   = array_values($estadosNames);
      $webCounts      = array_values($webCounts);

      $statusesNames  = [];
      $statusesValues = [];
      $statusesColors = [];
      foreach ($estadosNames as $estadosName) {
          array_push($statusesNames, trim($estadosName['ESTADO']));
          array_push($statusesValues, trim($estadosName['total']));
          $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
          array_push($statusesColors, trim($color));
      }

      $webValues      = [];
      $webNames       = [];
      $webColors = [];
      foreach ($webCounts as $webCount) {
          array_push($webNames, trim($webCount['ESTADO']));
          array_push($webValues, trim($webCount['total']));
          $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
          array_push($webColors, trim($color));
      }

      return view('director.dashboard', [
          'statusesNames'  => $statusesNames,
          'statusesValues' => $statusesValues,
          'statusesColors' => $statusesColors,
          'webValues'      => $webValues,
          'webNames'       => $webNames,
          'webColors'       => $webColors,
          'totalWeb'       => array_sum($webValues),
          'totalStatuses'  => array_sum($statusesValues),
          'factoryRequestsTotal'       => $factoryRequestsTotal,
      ]);
  }
}
