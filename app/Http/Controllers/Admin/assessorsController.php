<?php

namespace App\Http\Controllers\Admin;

use App\Assessor;
use App\OportuyaV2;
use App\cliCel;
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

    public function store(Request $request){
        $leadOportudata = new OportuyaV2;
        $clienteCelular = new CliCel;
        $cityName = $this->getCity(trim($request->get('CIUD_UBI')));
        $getIdcityUbi = $this->getIdcityUbi(trim($cityName[0]->CIUDAD));
        $getNameCiudadExp = $this->getNameCiudadExp(trim($request->get('CIUD_EXP')));
        $getIdcityExp = $this->getIdcityUbi(trim($getNameCiudadExp[0]->NOMBRE));
        $dataOportudata = [
            'TIPO_DOC' => trim($request->get('TIPO_DOC')),
            'CEDULA' => trim($request->get('CEDULA')),
            'APELLIDOS' => trim($request->get('APELLIDOS')),
            'NOMBRES' => trim($request->get('NOMBRES')),
            'TIPOCLIENTE' => 'NUEVO',
            'SUBTIPO' => 'NUEVO',
            'EDAD' => trim($request->get('EDAD')),
            'FEC_EXP' => trim($request->get('FEC_EXP')),
            'CIUD_EXP' => trim($getNameCiudadExp[0]->NOMBRE),
            'SEXO' => trim($request->get('SEXO')),
            'FEC_NAC' => trim($request->get('FEC_NAC')),
            'EDAD' => $this->calculateAge($request->get('FEC_NAC')),
            'ESTADOCIVIL' => trim($request->get('ESTADOCIVIL')),
            'TIPOV' => trim($request->get('TIPOV')),
            'PROPIETARIO' => trim($request->get('PROPIETARIO')),
            'VRARRIENDO' => trim($request->get('VRARRIENDO')),
            'DIRECCION' => trim($request->get('DIRECCION')),
            'TELFIJO' => trim($request->get('TELFIJO')),
            'CELULAR' => trim($request->get('CELULAR')),
            'TIEMPO_VIV' => trim($request->get('TIEMPO_VIV')),
            'CIUD_UBI' => trim($cityName[0]->CIUDAD),
            'DEPTO' => trim(strtoupper($cityName[0]->DEPARTAMENTO)),
            'EMAIL' => trim($request->get('EMAIL')),
            'ACTIVIDAD' => trim($request->get('ACTIVIDAD')),
            'ACT_ECO' => trim($request->get('ACT_ECO')),
            'NIT_EMP' => trim($request->get('NIT_EMP')),
            'RAZON_SOC' => trim($request->get('RAZON_SOC')),
            'FEC_ING' => trim($request->get('FEC_ING')),
            'ANTIG' => trim($request->get('ANTIG')),
            'CARGO' => trim($request->get('CARGO')),
            'DIR_EMP' => trim($request->get('DIR_EMP')),
            'TEL_EMP' => trim($request->get('TEL_EMP')),
            'TEL2_EMP' => trim($request->get('TEL2_EMP')),
            'TIPO_CONT' => trim($request->get('TIPO_CONT')),
            'SUELDO' => trim($request->get('SUELDO')),
            'NIT_IND' => trim($request->get('NIT_IND')),
            'RAZON_IND' => trim($request->get('RAZON_IND')),
            'ACT_IND' => trim($request->get('ACT_IND')),
            'EDAD_INDP' => trim($request->get('EDAD_INDP')),
            'FEC_CONST' => trim($request->get('FEC_CONST')),
            'OTROS_ING' => trim($request->get('OTROS_ING')),
            'ESTRATO' => trim($request->get('ESTRATO')),
            'SUELDOIND' => trim($request->get('SUELDOIND')),
            'VCON_NOM1' => trim($request->get('VCON_NOM1')),
            'VCON_CED1' => trim($request->get('VCON_CED1')),
            'VCON_TEL1' => trim($request->get('VCON_TEL1')),
            'VCON_NOM2' => trim($request->get('VCON_NOM2')),
            'VCON_CED2' => trim($request->get('VCON_CED2')),
            'VCON_TEL2' => trim($request->get('VCON_TEL2')),
            'VCON_DIR' => trim($request->get('VCON_DIR')),
            'MEDIO_PAGO' => trim($request->get('MEDIO_PAGO')),
            'TRAT_DATOS' => trim($request->get('TRAT_DATOS')),
            'BANCOP' => trim($request->get('BANCOP')),
            'CAMARAC' => trim($request->get('CAMARAC')),
            'CEL_VAL' => trim($request->get('CEL_VAL')),
            'EPS_CONYU' => 'NA',
            'CEDULA_C' =>  '0',
            'TRABAJO_CONYU' => 'NA' ,
            'CARGO_CONYU' => 'NA',
            'NOMBRE_CONYU' => 'NA',
            'PROFESION_CONYU' => 'NA' ,
            'SALARIO_CONYU' => '0',
            'CELULAR_CONYU' => '0',
            'PASO' => '',
            'ORIGEN' => 'CONTADO',
            'SUC' => trim($request->get('CIUD_UBI')),
            'ID_CIUD_EXP' => trim($getIdcityExp[0]->ID_DIAN),
            'ID_CIUD_UBI' => trim($getIdcityUbi[0]->ID_DIAN),
            'PERSONAS' => 0,
            'MIGRADO' => 0,
            'ESTUDIOS' => 'NA',
            'POSEEVEH' => 'NA',
            'PLACA' => 'NA',
            'TEL_PROP' => 'NA',
            'N_EMPLEA' => 0,
            'VENTASMES' => 0,
            'COSTOSMES' => 0,
            'GASTOS' => 0,
            'DEUDAMES' => 0,
            'TEL3' => 0,
            'TEL4' => 0,
            'TEL5' => 0,
            'TEL6' => 0,
            'TEL7' => 0,
            'DIRECCION2' => 'NA',
            'DIRECCION3' => 'NA',
            'DIRECCION4' => 'NA',
            'CIUD_NAC' => 'NA'
        ];
        $createOportudaLead = $leadOportudata->updateOrCreate(['CEDULA'=>trim($request->get('CEDULA'))],$dataOportudata)->save();
        if($request->get('CEL_VAL') == 0){
            $clienteCelular = new CliCel;
            $clienteCelular->IDENTI = trim($request->get('CEDULA'));
            $clienteCelular->NUM = trim($request->get('CELULAR'));
            $clienteCelular->TIPO = 'CEL';
            $clienteCelular->CEL_VAL = 1;
            $clienteCelular->FECHA = date("Y-m-d H:i:s");
            $clienteCelular->save();
        }
        return $request;
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

    public function getinfoLeadVentaContado($cedula){
        $query = sprintf("SELECT cf.`TIPO_DOC`, cf.`CEDULA`, cf.`APELLIDOS`, cf.`NOMBRES`, cf.`TIPOCLIENTE`, cf.`SUBTIPO`, cf.`EDAD`, cf.`FEC_EXP`, cf.`SEXO`, cf.`FEC_NAC`, cf.`ESTADOCIVIL`, cf.`TIPOV`, cf.`PROPIETARIO`, cf.`VRARRIENDO`, cf.`DIRECCION`, cf. `TELFIJO`, cf. `TIEMPO_VIV`, cf.`CIUD_UBI`, cf.`DEPTO`, cf.`ACTIVIDAD`, cf.`ACT_ECO`, cf.`NIT_EMP`, cf.`RAZON_SOC`, cf.`FEC_ING`, cf.`ANTIG`, cf.`CARGO`, cf.`DIR_EMP`, cf.`TEL_EMP`, cf.`TEL2_EMP`, cf.`TIPO_CONT`, cf.`SUELDO`, cf.`NIT_IND`, cf.`RAZON_IND`, cf.`ACT_IND`, cf.`EDAD_INDP`, cf.`FEC_CONST`, cf.`OTROS_ING`, cf.`ESTRATO`, cf.`SUELDOIND`, cf.`VCON_NOM1`, cf.`VCON_CED1`, cf.`VCON_TEL1`, cf.`VCON_NOM2`, cf.`VCON_CED2`, cf.`VCON_TEL2`, cf.`VCON_DIR`,cf.`MEDIO_PAGO`, cf.`TRAT_DATOS`, cf.`BANCOP`, cf.`CAMARAC`, cf.`PASO`, cf.`ORIGEN`, cf.`SUC`, cf.`ID_CIUD_EXP`, cf.`ID_CIUD_UBI`, cf.`PERSONAS`, cf.`ESTUDIOS`, cf.`POSEEVEH`, cf.`PLACA`, cf.`TEL_PROP`, cf.`N_EMPLEA`, cf.`VENTASMES`, cf.`COSTOSMES`, cf.`GASTOS`, cf.`DEUDAMES`, cf.`TEL3`, cf.`TEL4`, cf.`TEL5`, cf.`TEL6`, cf.`TEL7`, cf.`DIRECCION2`, cf.`DIRECCION3`, cf.`DIRECCION4`, cf.`CIUD_NAC`, suc.CODIGO as CIUD_UBI, ciu.`CODIGO` as CIUD_EXP
        FROM `CLIENTE_FAB` as cf
        LEFT JOIN SUCURSALES as suc ON suc.CIUDAD = cf.CIUD_UBI
        LEFT JOIN CIUDADES as ciu ON ciu.`NOMBRE` = cf.`CIUD_EXP`
        WHERE `CEDULA` = '%s' AND suc.PRINCIPAL = 1 ", $cedula);

        $resp = DB::connection('oportudata')->select($query);

        return $resp;
    }

    public function getFormVentaContado(){
        if(Auth::guard('assessor')->check()){
            return view('assessors.forms.ventaContado');
        }else{
            return view('assessors.login');
        }
    }

    private function getCity($code){
		$queryCity = sprintf("SELECT suc.`CIUDAD` as CIUDAD, depto.NAME as DEPARTAMENTO FROM `SUCURSALES` as suc LEFT JOIN DEPARTAMENTOS as depto ON suc.DEPARTAMENTO_ID = depto.DEPARTAMENTO_ID WHERE `CODIGO` = %s ", $code);

		$resp = DB::connection('oportudata')->select($queryCity);

		return $resp;
    }

    private function getNameCiudadExp($city){
        $queryCity = sprintf("SELECT `NOMBRE` FROM `CIUDADES` WHERE `CODIGO` = %s ", $city);

        $resp = DB::connection('oportudata')->select($queryCity);

		return $resp;
    }

    private function getIdcityUbi($city){
        $queryCity = sprintf('SELECT `ID_DIAN` FROM `CIUDADES` WHERE `NOMBRE` = "%s" ', $city);
        
        $resp = DB::connection('oportudata')->select($queryCity);

		return $resp;
    }

    private function calculateAge($fecha){
		$time = strtotime($fecha);
		$now = time();
		$age = ($now-$time)/(60*60*24*365.25);
		$age = floor($age);

		return $age;
	}

}
