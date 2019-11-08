<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectorController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth')->except('logout');
  }

  public function index(Request $request)
  {
    $query = sprintf("SELECT cf. CEDULA, cf.NOMBRES, cf.APELLIDOS, cf.CELULAR, cf.EMAIl, cf.CREACION, cf.ESTADO, ti.TARJETA
    FROM CLIENTE_FAB as cf, TB_INTENCIONES as ti
    where ti.CEDULA = cf.CEDULA
    and cf.SUC = 125
    and cf.CLIENTE_WEB = 1
    and ti.FECHA_INTENCION = (
      SELECT MAX(`FECHA_INTENCION`)
      FROM `TB_INTENCIONES`
      WHERE `CEDULA` = `cf`.`CEDULA`)");

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
}
