<?php

namespace App\Http\Controllers\Assessor;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guest()) {

            $codAssessor = Auth::guard('assessor')->user()->CODIGO;

            $query = 'SELECT `SOLIC_FAB`.`SOLICITUD`,`SOLIC_FAB`.`SUCURSAL`,`CLIENTE_FAB`.`APELLIDOS`,`CLIENTE_FAB`.`NOMBRES`,`SOLIC_FAB`.`CLIENTE`,`SOLIC_FAB`.`CODASESOR`,`SOLIC_FAB`.`FECHASOL`, `SOLIC_FAB`.`CODEUDOR1`,`SOLIC_FAB`.`CODEUDOR2`, `SOLIC_FAB`.`ESTADO`  FROM SOLIC_FAB LEFT JOIN CLIENTE_FAB ON `SOLIC_FAB`.`CLIENTE` = `CLIENTE_FAB`.`CEDULA` WHERE CODASESOR=' . $codAssessor . ' ';

            if ($request->get('q')) {
                $query .= sprintf(" AND (CLIENTE_FAB.`NOMBRES` LIKE '%s' OR CLIENTE_FAB.`APELLIDOS` LIKE '%s' OR SOLIC_FAB.`CLIENTE` LIKE '%s' )",  '%' . $request->get('q') . '%', '%' . $request->get('q') . '%', '%' . $request->get('q') . '%');
            }

            if ($request->get('solic')) {
                $query .= sprintf(" AND SOLIC_FAB.`SOLICITUD` = '%s' ", $request->get('solic'));
            }

            if ($request->get('state')) {
                $query .= sprintf(" AND SOLIC_FAB.`ESTADO` = '%s' ", $request->get('state'));
            }

            if ($request->get('fechaSol')) {
                $query .= sprintf(" AND SOLIC_FAB.`FECHASOL` = '%s' ", $request->get('fechaSol'));
            }

            if (($request->get('firstDate')) && !($request->get('lastDate'))) {
                $query .= sprintf(" AND SOLIC_FAB.`FECHASOL` BETWEEN '%s' AND '%s' ", $request->get('fisrtDate'), $request->get('fisrtDate'));
            }

            if (($request->get('lastDate')) && !($request->get('firstDate'))) {
                $query .= sprintf(" AND SOLIC_FAB.`FECHASOL` BETWEEN '%s' AND '%s' ", $request->get('lastDate'), $request->get('lastDate'));
            }

            if (($request->get('lastDate')) && ($request->get('firstDate'))) {
                $query .= sprintf(" AND SOLIC_FAB.`FECHASOL` BETWEEN '%s' AND '%s' ", $request->get('firstDate'), $request->get('lastDate'));
            }

            $initFrom = ($request->get('limitFrom')) ? $request->get('limitFrom') : 0;
            $query .= sprintf("ORDER BY `SOLIC_FAB`.`SOLICITUD` DESC LIMIT %s,30", $initFrom);

            $customers =  DB::connection('oportudata')->select($query);

            return response()->json([$customers, $query]);
        }

        return false;
    }

    public function show($id)
    {
        $customer = DB::connection('oportudata')
            ->select('SELECT `SOLIC_FAB`.`SOLICITUD`,`CLIENTE_FAB`.`APELLIDOS`,`CLIENTE_FAB`.`NOMBRES`,`SOLIC_FAB`.`CLIENTE`,`SOLIC_FAB`.`CODASESOR`,`SOLIC_FAB`.`FECHASOL`, `SOLIC_FAB`.`CODEUDOR1`,`SOLIC_FAB`.`CODEUDOR2`, `SOLIC_FAB`.`ESTADO`  FROM SOLIC_FAB LEFT JOIN CLIENTE_FAB ON `SOLIC_FAB`.`CLIENTE` = `CLIENTE_FAB`.`CEDULA` WHERE SOLICITUD=' . $id . ' LIMIT 30');

        return response()->json($customer);
    }
}
