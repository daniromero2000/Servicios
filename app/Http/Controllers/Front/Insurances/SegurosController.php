<?php

namespace App\Http\Controllers\Front\Insurances;

use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SegurosController extends Controller
{
    private $customerInterface, $subsidiaryInterface, $customerCellPhoneInterface, $cityInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerCellPhoneRepositoryInterface $customerCellPhoneRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->subsidiaryInterface        = $subsidiaryRepositoryInterface;
        $this->customerInterface          = $customerRepositoryInterface;
        $this->customerCellPhoneInterface = $customerCellPhoneRepositoryInterface;
        $this->cityInterface              = $cityRepositoryInterface;
    }

    public function index()
    {
        return view('seguros.index', [
            'images' =>  Imagenes::all(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
        if (Auth::user()) {
            $authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
        }
        $identificationNumber = trim($request->get('CEDULA'));
        $customer             = $this->customerInterface->checkIfExists($identificationNumber);
        $clienteWeb           = 1;
        $usuarioActualizacion = "";
        $assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;

        $clienteWeb = ($customer->CLIENTE_WEB != '') ? $customer->CLIENTE_WEB : 1;
        $usuarioCreacion = ($customer->USUARIO_CREACION != '') ? $customer->USUARIO_CREACION : (string) $assessorCode;
        $usuarioActualizacion = (string) $assessorCode;

        $cityExp            = $this->cityInterface->getCityByCode($request->input('CIUD_EXP'));
        $antig_ind          = new Carbon($request['FEC_CONST']);
        $birthday           = new Carbon($request->FEC_NAC);
        $subsidiaryCityName = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('CIUD_UBI'))->CIUDAD;
        $cityUbi            = $this->cityInterface->getCityByName($subsidiaryCityName);
        $antig              = new Carbon($request['FEC_ING']);

        $request['CIUD_EXP']              = $cityExp->NOMBRE;
        $request['ID_CIUD_EXP']           = $cityExp->ID_DIAN;
        $request['FEC_ING']               = $request->input('FEC_ING') . "-01";
        $request['FEC_CONST']             = $request->input('FEC_CONST') . "-01";
        $request['EDAD_INDP']             = $antig_ind->diffInYears(Carbon::now());
        $request['ANTIG']                 = $antig->diffInMonths(Carbon::now());
        $request['EDAD']                  = $birthday->diffInYears(Carbon::now());
        $request['SUC']                   = $request->get('CIUD_UBI');
        $request['TIPOCLIENTE']           = 'OPORTUYA';
        $request['SUBTIPO']               = 'WEB';
        $request['CLIENTE_WEB']           = $clienteWeb;
        $request['USUARIO_CREACION']      = $usuarioCreacion;
        $request['USUARIO_ACTUALIZACION'] = $usuarioActualizacion;
        $request['TRAT_DATOS']            = "SI";
        $request['FECHA_ACTUALIZACION']   = date('Y-m-d H                 :i:s');
        $request['DEPTO']                 = $cityUbi->DEPARTAMENTO;
        $request['ID_CIUD_UBI']           = $cityUbi->ID_DIAN;
        $request['CIUD_UBI']              = $subsidiaryCityName;
        $request['POSEEVEH']              = "S";

        foreach ($request->input() as $key => $value) {
            $request[$key] = trim(strtoupper($request[$key]));
        }

        $this->customerInterface->updateOrCreateCustomer($request->input());

        if (empty($this->customerCellPhoneInterface->checkIfExists($request->input('CEDULA'), $request->input('CELULAR')))) {
            $clienteCelular = [];
            $clienteCelular['IDENTI'] = $request->input('CEDULA');
            $clienteCelular['NUM'] = trim($request->get('CELULAR'));
            $clienteCelular['TIPO'] = 'CEL';
            $clienteCelular['CEL_VAL'] = 1;
            $clienteCelular['FECHA'] = date("Y-m-d H:i:s");
            $this->customerCellPhoneInterface->createCustomerCellPhone($clienteCelular);
        }
    }

    public function getInfoForm()
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
}