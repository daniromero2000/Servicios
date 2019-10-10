<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DirectorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth')->except('logout');
  }

  public function index()
  {

    $query = sprintf("SELECT cf.NOMBRES, cf.APELLIDOS, cf.CELULAR, cf.EMAIl, cf.CREACION, cf.ESTADO, ti.TARJETA
    FROM CLIENTE_FAB as cf, TB_INTENCIONES as ti
    where ti.CEDULA = cf.CEDULA
    and cf.SUC = 156
    AND ti.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)
    ");
  }
}
