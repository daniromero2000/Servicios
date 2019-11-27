<?php

namespace App\Http\Controllers\Admin;

use App\cliCel;
use App\Entities\Customers\Customer;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class assessorsController extends Controller
{
    private $customerInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface
    )
    {
        //$this->middleware(['auth:assessor']);
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

    public function store(Request $request)
    {
        $authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
        if (Auth::user()) {
            $authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
        }
        $assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
        $leadOportudata  = new Customer;
        $usuarioCreacion = $assessorCode;
        $clienteCelular  = new CliCel;
        $clienteWeb = 1;
        $getExistLead = Customer::find($request->CEDULA);
        if (!empty($getExistLead)) {
            $clienteWeb      = $getExistLead->CLIENTE_WEB;
            $usuarioCreacion = $getExistLead->USUARIO_CREACION;
        }
        if ($request->tipoCliente == 'CONTADO') {
            $cityName     = $this->getCity(trim($request->get('CIUD_UBI')));
            $getIdcityUbi = $this->getIdcityUbi(trim($cityName[0]->CIUDAD));
            $dataOportudata = [
                'TIPO_DOC'    => trim($request->get('TIPO_DOC')),
                'CEDULA'      => trim($request->get('CEDULA')),
                'NOMBRES'     => trim($request->get('NOMBRES')),
                'APELLIDOS'   => trim($request->get('APELLIDOS')),
                'EMAIL'       => trim($request->get('EMAIL')),
                'TELFIJO'     => ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO'))  : '0',
                'CELULAR'     => trim($request->get('CELULAR')),
                'SEXO'        => trim($request->get('SEXO')),
                'DIRECCION'   => trim($request->get('DIRECCION')),
                'VCON_NOM1'   => trim($request->get('VCON_NOM1')),
                'VCON_CED1'   => trim($request->get('VCON_CED1')),
                'VCON_TEL1'   => trim($request->get('VCON_TEL1')),
                'VCON_NOM2'   => ($request->get('VCON_NOM2') != '') ? trim($request->get('VCON_NOM2')) : 'NA',
                'VCON_CED2'   => ($request->get('VCON_CED2') != '') ? trim($request->get('VCON_CED2')) : 'NA',
                'VCON_TEL2'   => ($request->get('VCON_TEL2') != '') ? trim($request->get('VCON_TEL2')) : 'NA',
                'VCON_DIR'    => trim($request->get('VCON_DIR')),
                'TRAT_DATOS'  => trim($request->get('TRAT_DATOS')),
                'TIPOCLIENTE' => 'NUEVO',
                'SUBTIPO'     => 'NUEVO',
                'EDAD'        => $this->calculateAge($request->get('FEC_NAC')),
                'CIUD_UBI'    => trim($cityName[0]->CIUDAD),
                'DEPTO'       => trim(strtoupper($cityName[0]->DEPARTAMENTO)),
                'ID_CIUD_UBI' => trim($getIdcityUbi[0]->ID_DIAN),
                'MEDIO_PAGO'  => 1,
                'ORIGEN'      => 'ASESORES-CONTADO',
                'CLIENTE_WEB' => $clienteWeb,
                'PASO'        => '',
            ];
            unset($dataOportudata['tipoCliente']);
            $createOportudaLead = $leadOportudata->updateOrCreate(['CEDULA' => trim($request->get('CEDULA'))], $dataOportudata)->save();
            $queryExistCel = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => trim($request->get('CEDULA')), 'telefono' => trim($request->get('CELULAR'))]);
            if ($queryExistCel[0]->total == 0) {
                $clienteCelular          = new CliCel;
                $clienteCelular->IDENTI  = trim($request->get('CEDULA'));
                $clienteCelular->NUM     = trim($request->get('CELULAR'));
                $clienteCelular->TIPO    = 'CEL';
                $clienteCelular->CEL_VAL = 0;
                $clienteCelular->FECHA   = date("Y-m-d H: i: s");
                $clienteCelular->save();
            }
            $queryExistTelFijo = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => trim($request->get('CEDULA')), 'telefono' => trim($request->get('TELFIJO'))]);
            if ($queryExistTelFijo[0]->total == 0) {
                $clienteCelular          = new CliCel;
                $clienteCelular->IDENTI  = trim($request->get('CEDULA'));
                $clienteCelular->NUM     = trim($request->get('TELFIJO'));
                $clienteCelular->TIPO    = 'FIJO';
                $clienteCelular->CEL_VAL = 0;
                $clienteCelular->FECHA   = date("Y-m-d H: i: s");
                $clienteCelular->save();
            }
            return $dataOportudata;
        } elseif ($request->tipoCliente == 'CREDITO') {
            $cityName         = $this->getCity(trim($request->get('CIUD_UBI')));
            $getIdcityUbi     = $this->getIdcityUbi(trim($cityName[0]->CIUDAD));
            $getNameCiudadExp = $this->getNameCiudadExp(trim($request->get('CIUD_EXP')));
            $getIdcityExp     = $this->getIdcityUbi(trim($getNameCiudadExp[0]->NOMBRE));
            $antig            = $request->get('ANTIG');
            $indp             = $request->get('EDAD_INDP');
            if (trim($request->get('ACTIVIDAD')) == 'EMPLEADO' || trim($request->get('ACTIVIDAD')) == 'SOLDADO-MILITAR-POLICÍA' || trim($request->get('ACTIVIDAD')) == 'PRESTACIÓN DE SERVICIOS') {
                $antig = $this->calculateTimeCompany(trim($request->get('FEC_ING')) . "-01");
            } else {
                $indp = $this->calculateTimeCompany(trim($request->get('FEC_CONST')) . "-01");
            }
            $dataOportudata = [
                'TIPO_DOC'              => trim($request->get('TIPO_DOC')),
                'CEDULA'                => trim($request->get('CEDULA')),
                'FEC_EXP'               => trim($request->get('FEC_EXP')),
                'NOMBRES'               => trim($request->get('NOMBRES')),
                'APELLIDOS'             => trim($request->get('APELLIDOS')),
                'EMAIL'                 => trim($request->get('EMAIL')),
                'CELULAR'               => trim($request->get('CELULAR')),
                'ACTIVIDAD'             => trim($request->get('ACTIVIDAD')),
                'FEC_NAC'               => trim($request->get('FEC_NAC')),
                'EDAD'                  => $this->calculateAge($request->get('FEC_NAC')),
                'CIUD_UBI'              => trim($cityName[0]->CIUDAD),
                'ID_CIUD_UBI'           => trim($getIdcityUbi[0]->ID_DIAN),
                'DEPTO'                 => trim(strtoupper($cityName[0]->DEPARTAMENTO)),
                'CIUD_EXP'              => trim($getNameCiudadExp[0]->NOMBRE),
                'ID_CIUD_EXP'           => trim($getIdcityExp[0]->ID_DIAN),
                'TIPOV'                 => trim($request->get('TIPOV')),
                'TIEMPO_VIV'            => trim($request->get('TIEMPO_VIV')),
                'PROPIETARIO'           => trim($request->get('PROPIETARIO')),
                'DIRECCION'             => trim($request->get('DIRECCION')),
                'VRARRIENDO'            => trim($request->get('VRARRIENDO')),
                'TELFIJO'               => trim($request->get('TELFIJO')),
                'ESTRATO'               => trim($request->get('ESTRATO')),
                'SEXO'                  => trim($request->get('SEXO')),
                'ESTADOCIVIL'           => trim($request->get('ESTADOCIVIL')),
                'NIT_EMP'               => trim($request->get('NIT_EMP')),
                'RAZON_SOC'             => trim($request->get('RAZON_SOC')),
                'DIR_EMP'               => trim($request->get('DIR_EMP')),
                'TEL_EMP'               => trim($request->get('TEL_EMP')),
                'TEL2_EMP'              => trim($request->get('TEL2_EMP')),
                'ACT_ECO'               => trim($request->get('ACT_ECO')),
                'CARGO'                 => trim($request->get('CARGO')),
                'FEC_ING'               => trim($request->get('FEC_ING')) . "-01",
                'ANTIG'                 => $antig,
                'SUELDO'                => trim($request->get('SUELDO')),
                'TIPO_CONT'             => trim($request->get('TIPO_CONT')),
                'OTROS_ING'             => trim($request->get('OTROS_ING')),
                'CAMARAC'               => trim($request->get('CAMARAC')),
                'NIT_IND'               => trim($request->get('NIT_IND')),
                'RAZON_IND'             => trim($request->get('RAZON_IND')),
                'ACT_IND'               => trim($request->get('ACT_IND')),
                'FEC_CONST'             => trim($request->get('FEC_CONST')) . "-01",
                'EDAD_INDP'             => $indp,
                'SUELDOIND'             => trim($request->get('SUELDOIND')),
                'BANCOP'                => trim($request->get('BANCOP')),
                'SUC'                   => trim($request->get('CIUD_UBI')),
                'TIPOCLIENTE'           => 'NUEVO',
                'SUBTIPO'               => 'WEB',
                'MEDIO_PAGO'            => trim($request->get('MEDIO_PAGO')),
                'TRAT_DATOS'            => trim($request->get('TRAT_DATOS')),
                'ORIGEN'                => 'ASESORES-CREDITO',
                'USUARIO_CREACION'      => $usuarioCreacion,
                'USUARIO_ACTUALIZACION' => $assessorCode,
                'CLIENTE_WEB'           => $clienteWeb
            ];
            $createOportudaLead = $leadOportudata->updateOrCreate(['CEDULA' => trim($request->get('CEDULA'))], $dataOportudata)->save();
            $queryExistCel = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => trim($request->get('CEDULA')), 'telefono' => trim($request->get('CELULAR'))]);
            if ($request->get('CEL_VAL') == 0 && $queryExistCel[0]->total == 0) {
                $clienteCelular          = new CliCel;
                $clienteCelular->IDENTI  = trim($request->get('CEDULA'));
                $clienteCelular->NUM     = trim($request->get('CELULAR'));
                $clienteCelular->TIPO    = 'CEL';
                $clienteCelular->CEL_VAL = 1;
                $clienteCelular->FECHA   = date("Y-m-d H: i: s");
                $clienteCelular->save();
            }
            $queryExistTelFijo = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => trim($request->get('CEDULA')), 'telefono' => trim($request->get('TELFIJO'))]);
            if ($queryExistTelFijo[0]->total == 0) {
                $clienteCelular          = new CliCel;
                $clienteCelular->IDENTI  = trim($request->get('CEDULA'));
                $clienteCelular->NUM     = trim($request->get('TELFIJO'));
                $clienteCelular->TIPO    = 'FIJO';
                $clienteCelular->CEL_VAL = 0;
                $clienteCelular->FECHA   = date("Y-m-d H: i: s");
                $clienteCelular->save();
            }
            $lastName = explode(" ", trim($request->get('APELLIDOS')));
            $fechaExpIdentification = strtotime(trim($request->get('FEC_EXP')));
            $fechaExpIdentification = date("d/m/Y", $fechaExpIdentification);
            return ['identificationNumber' => trim($request->get('CEDULA')), 'tipoDoc' => trim($request->get('TIPO_DOC')), 'tipoCreacion' => $request->tipoCliente, 'lastName' => $lastName[0], 'dateExpIdentification' => $fechaExpIdentification];
        }
    }

    public function getInfoVentaContado()
    {
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

    public function getinfoLeadVentaContado($cedula)
    {
        $query = sprintf("SELECT cf.`TIPO_DOC`, cf.`CEDULA`, cf.`APELLIDOS`, cf.`NOMBRES`, cf.`TIPOCLIENTE`, cf.`SUBTIPO`, cf.`EDAD`, CONCAT(cf.`FEC_EXP`, ' 01:00:00') as FEC_EXP, cf.`SEXO`, CONCAT(cf.`FEC_NAC`, ' 01:00:00') as FEC_NAC, cf.`ESTADOCIVIL`, cf.`TIPOV`, cf.`PROPIETARIO`, cf.`VRARRIENDO`, cf.`DIRECCION`, cf. `TELFIJO`, cf. `TIEMPO_VIV`, cf.`CIUD_UBI`, cf.`DEPTO`, cf.`ACTIVIDAD`, cf.`ACT_ECO`, cf.`NIT_EMP`, cf.`RAZON_SOC`, CONCAT(cf.`FEC_ING`, ' 01:00:00') as FEC_ING, cf.`ANTIG`, cf.`CARGO`, cf.`DIR_EMP`, cf.`TEL_EMP`, cf.`TEL2_EMP`, cf.`TIPO_CONT`, cf.`SUELDO`, cf.`NIT_IND`, cf.`RAZON_IND`, cf.`ACT_IND`, cf.`EDAD_INDP`, CONCAT(cf.`FEC_CONST`, ' 01:00:00') as FEC_CONST, cf.`OTROS_ING`, cf.`ESTRATO`, cf.`SUELDOIND`, cf.`VCON_NOM1`, cf.`VCON_CED1`, cf.`VCON_TEL1`, cf.`VCON_NOM2`, cf.`VCON_CED2`, cf.`VCON_TEL2`, cf.`VCON_DIR`,cf.`MEDIO_PAGO`, cf.`TRAT_DATOS`, cf.`BANCOP`, cf.`CAMARAC`, cf.`PASO`, cf.`ORIGEN`, cf.`SUC`, cf.`ID_CIUD_EXP`, cf.`ID_CIUD_UBI`, cf.`PERSONAS`, cf.`ESTUDIOS`, cf.`POSEEVEH`, cf.`PLACA`, cf.`TEL_PROP`, cf.`N_EMPLEA`, cf.`VENTASMES`, cf.`COSTOSMES`, cf.`GASTOS`, cf.`DEUDAMES`, cf.`TEL3`, cf.`TEL4`, cf.`TEL5`, cf.`TEL6`, cf.`TEL7`, cf.`DIRECCION2`, cf.`DIRECCION3`, cf.`DIRECCION4`, cf.`CIUD_NAC`, suc.CODIGO as CIUD_UBI, ciu.`CODIGO` as CIUD_EXP
        FROM `CLIENTE_FAB` as cf
        LEFT JOIN SUCURSALES as suc ON suc.CIUDAD = cf.CIUD_UBI
        LEFT JOIN CIUDADES as ciu ON ciu.`NOMBRE` = cf.`CIUD_EXP`
        WHERE `CEDULA` = '%s' AND suc.PRINCIPAL = 1 ", $cedula);
        $resp = DB::connection('oportudata')->select($query);

        if (empty($resp)) {
            return "false";
        }

        return $resp;
    }

    public function getFormVentaContado()
    {
        if (Auth::user()) {
            return view('assessors.forms.crearCliente');
        } else {
            return view('assessors.login');
        }
    }

    private function getCity($code)
    {
        $queryCity = sprintf("SELECT suc.`CIUDAD` as CIUDAD, depto.NAME as DEPARTAMENTO FROM `SUCURSALES` as suc LEFT JOIN DEPARTAMENTOS as depto ON suc.DEPARTAMENTO_ID = depto.DEPARTAMENTO_ID WHERE `CODIGO` = %s ", $code);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }

    private function getNameCiudadExp($city)
    {
        $queryCity = sprintf("SELECT `NOMBRE` FROM `CIUDADES` WHERE `CODIGO` = %s ", $city);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }

    private function getIdcityUbi($city)
    {
        $queryCity = sprintf('SELECT `ID_DIAN` FROM `CIUDADES` WHERE `NOMBRE` = "%s" ', $city);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }

    private function calculateAge($fecha)
    {
        $time = strtotime($fecha);
        $now  = time();
        $age  = ($now - $time) / (60 * 60 * 24 * 365.25);
        $age  = floor($age);

        return $age;
    }

    private function calculateTimeCompany($fechaIngreso)
    {
        $fechaActual = date("Y-m-d");
        $dateDiff    = floor((strtotime($fechaActual) - strtotime($fechaIngreso)) / (60 * 60 * 24 * 30));
        return $dateDiff;
    }

    public function getInfoLead($identificationNumber){
        $customer = $this->customerInterface->findCustomerById($identificationNumber);
        $definition = $customer->latestIntention->definition;
        return $customer;
    }
}
