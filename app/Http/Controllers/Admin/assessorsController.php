<?php

namespace App\Http\Controllers\Admin;

use App\Assessor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class assessorsController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:assessor']);
    }
/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assessors.dashboard');
    }

    public function getInfoVentaContado(){
        // Ciudad de ubicación
        $query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 ORDER BY CIUDAD ASC";
        $resp = DB::connection('oportudata')->select($query);
        
        // Ciudad de nacimiento
        $query2 = "SELECT `CODIGO` as value, `NOMBRE` as label FROM `CIUDADES` WHERE `STATE` = 'A' ORDER BY NOMBRE ";
        $resp2 = DB::connection('oportudata')->select($query2);

        // Banco Pensionado
        $query3 = "SELECT `CODIGO` as value, `BANCO` as label FROM BANCO ";
        $resp3 = DB::connection('oportudata')->select($query3);

        return response()->json(['ubicationsCities' => $resp, 'cities' => $resp2, 'banks' => $resp3]);
    }

    public function getFormVentaContado(){
        if(Auth::guard('assessor')->check()){
            return view('assessors.forms.ventaContado');
        }else{
            return view('assessors.login');
        }
    }
}
