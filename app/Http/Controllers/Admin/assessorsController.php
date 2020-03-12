<?php

namespace App\Http\Controllers\Admin;

use App\Analisis;
use App\cliCel;
use App\DatosCliente;
use App\Entities\Customers\Customer;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\ConsultationValidities\Repositories\Interfaces\ConsultationValidityRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use App\Entities\ConfirmationMessages\Repositories\Interfaces\ConfirmationMessageRepositoryInterface;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use App\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Kinships\Repositories\Interfaces\KinshipRepositoryInterface;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use App\TurnosOportuya;

class assessorsController extends Controller
{
	private $kinshipInterface;
	private $customerInterface, $toolsInterface, $factoryInterface, $temporaryCustomerInterface;
	private $daysToIncrement, $consultationValidityInterface;
	private $subsidiaryInterface;
	private $fosygaInterface, $registraduriaInterface, $webServiceInterface;
	private $commercialConsultationInterface, $customerProfessionInterface;
	private $creditCardInterface, $customerVerificationCodeInterface;
	private $UpToDateFinancialCifinInterface, $CifinFinancialArrearsInterface, $cifinRealArrearsInterface;
	private $cifinScoreInterface, $intentionInterface, $extintFinancialCifinInterface;
	private $UpToDateRealCifinInterface, $extinctRealCifinInterface, $cifinBasicDataInterface;
	private $ubicaInterface;
	private $assessorInterface;
	private $codebtorInterface, $secondCodebtorInterface;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(
		SecondCodebtorRepositoryInterface $secondCodebtorRepositoryInterface,
		CodebtorRepositoryInterface $codebtorRepositoryInterface,
		KinshipRepositoryInterface $kinshipRepositoryInterface,
		TemporaryCustomerRepositoryInterface $temporaryCustomerRepositoryInterface,
		CustomerProfessionRepositoryInterface $customerProfessionRepositoryInterface,
		AssessorRepositoryInterface $AssessorRepositoryInterface,
		FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
		ToolRepositoryInterface $toolRepositoryInterface,
		CustomerRepositoryInterface $customerRepositoryInterface,
		ConsultationValidityRepositoryInterface $consultationValidityRepositoryInterface,
		SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
		CustomerCellPhoneRepositoryInterface $customerCellPhoneRepositoryInterface,
		FosygaRepositoryInterface $fosygaRepositoryInterface,
		WebServiceRepositoryInterface $WebServiceRepositoryInterface,
		RegistraduriaRepositoryInterface $registraduriaRepositoryInterface,
		CommercialConsultationRepositoryInterface $commercialConsultationRepositoryInterface,
		CreditCardRepositoryInterface $creditCardRepositoryInterface,
		UpToDateFinancialCifinRepositoryInterface $UpToDateFinancialCifinRepositoryInterface,
		CifinFinancialArrearRepositoryInterface $CifinFinancialArrearRepositoryInterface,
		CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface,
		CifinScoreRepositoryInterface $cifinScoreRepositoryInterface,
		IntentionRepositoryInterface $intentionRepositoryInterface,
		ExtintFinancialCifinRepositoryInterface $extintFinancialCifinRepositoryInterface,
		UpToDateRealCifinRepositoryInterface $upToDateRealCifinsRepositoryInterface,
		ExtintRealCifinRepositoryInterface $extintRealCifinRepositoryInterface,
		CifinBasicDataRepositoryInterface $cifinBasicDataRepositoryInterface,
		UbicaRepositoryInterface $ubicaRepositoryInterface
	) {
		$this->secondCodebtorInterface         = $secondCodebtorRepositoryInterface;
		$this->codebtorInterface               = $codebtorRepositoryInterface;
		$this->kinshipInterface                = $kinshipRepositoryInterface;
		$this->temporaryCustomerInterface      = $temporaryCustomerRepositoryInterface;
		$this->customerProfessionInterface     = $customerProfessionRepositoryInterface;
		$this->assessorInterface               = $AssessorRepositoryInterface;
		$this->factoryInterface                = $factoryRequestRepositoryInterface;
		$this->toolsInterface                  = $toolRepositoryInterface;
		$this->consultationValidityInterface   = $consultationValidityRepositoryInterface;
		$this->customerInterface               = $customerRepositoryInterface;
		$this->subsidiaryInterface             = $subsidiaryRepositoryInterface;
		$this->customerCellPhoneInterface      = $customerCellPhoneRepositoryInterface;
		$this->fosygaInterface                 = $fosygaRepositoryInterface;
		$this->webServiceInterface             = $WebServiceRepositoryInterface;
		$this->registraduriaInterface          = $registraduriaRepositoryInterface;
		$this->commercialConsultationInterface = $commercialConsultationRepositoryInterface;
		$this->creditCardInterface             = $creditCardRepositoryInterface;
		$this->UpToDateFinancialCifinInterface = $UpToDateFinancialCifinRepositoryInterface;
		$this->CifinFinancialArrearsInterface  = $CifinFinancialArrearRepositoryInterface;
		$this->cifinRealArrearsInterface       = $cifinRealArrearRepositoryInterface;
		$this->cifinScoreInterface             = $cifinScoreRepositoryInterface;
		$this->intentionInterface              = $intentionRepositoryInterface;
		$this->extintFinancialCifinInterface   = $extintFinancialCifinRepositoryInterface;
		$this->UpToDateRealCifinInterface      = $upToDateRealCifinsRepositoryInterface;
		$this->extinctRealCifinInterface       = $extintRealCifinRepositoryInterface;
		$this->cifinBasicDataInterface         = $cifinBasicDataRepositoryInterface;
		$this->ubicaInterface                  = $ubicaRepositoryInterface;
		$this->middleware('auth');
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$to = Carbon::now();
		$from = Carbon::now()->startOfMonth();
		$assessor = auth()->user()->email;
		$skip         = $this->toolsInterface->getSkip($request->input('skip'));
		$list         = $this->factoryInterface->listFactoryAssessors($skip * 30, $assessor);
		$listCount = $this->factoryInterface->listFactoryAssessorsTotal($from, $to, $assessor);
		// $estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'));
		// $estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, "NEGADO");
		// $estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, "DESISTIDO");
		// $estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
		// if (request()->has('from') && request()->input('from') != '') {
		// 	$estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array('APROBADO', 'EN FACTURACION'));
		// 	$estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "NEGADO");
		// 	$estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "DESISTIDO");
		// 	dd($estadosDesistidos);
		// 	$estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
		// }
		if (request()->has('q')) {
			$list = $this->factoryInterface->searchFactoryAseessors(
				request()->input('q'),
				$skip,
				request()->input('from'),
				request()->input('to'),
				request()->input('status'),
				request()->input('subsidiary'),
				$assessor
			)->sortByDesc('FECHASOL');
			$listCount = $this->factoryInterface->searchFactoryAseessors(
				request()->input('q'),
				$skip,
				request()->input('from'),
				request()->input('to'),
				request()->input('status'),
				request()->input('subsidiary'),
				$assessor
			)->sortByDesc('FECHASOL');
		}

		$factoryRequestsTotal = $listCount->sum('GRAN_TOTAL');
		$listCount = $listCount->count();

		return view('assessors.assessors.list', [
			'factoryRequests'      => $list,
			'optionsRoutes'        => (request()->segment(2)),
			'headers'              => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
			'listCount'            => $listCount,
			'skip'                 => $skip,
			'factoryRequestsTotal' => $factoryRequestsTotal,

		]);
	}

	public function store(Request $request)
	{
		$search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
		$replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		$sucursal = trim($request->get('CIUD_UBI'));
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

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
				'TIPO_DOC'    			=> trim($request->get('TIPO_DOC')),
				'CEDULA'      			=> trim($request->get('CEDULA')),
				'FEC_EXP'     			=> '1980-01-01',
				'NOMBRES'   			=> ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'APELLIDOS'   			=> ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'EMAIL'       			=> trim($request->get('EMAIL')),
				'TELFIJO'     			=> ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO'))  : '0',
				'CELULAR'     			=> trim($request->get('CELULAR')),
				'PROFESION'   			=> 'NO APLICA',
				'PERSONAS'  			=>  0,
				'TIPOV'       			=> '',
				'TIEMPO_VIV'  			=> '',
				'PROPIETARIO' 			=> '',
				'VRARRIENDO'  			=> 	0,
				'ESTUDIOS'  			=> '',
				'ESTRATO'     			=> '',
				'SEXO'        			=> trim($request->get('SEXO')),
				'DIRECCION'   			=> ($request->get('DIRECCION') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIRECCION')))) : 'NA',
				'VCON_NOM1'   			=> ($request->get('VCON_NOM1') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM1')))) : 'NA',
				'VCON_CED1'   			=> ($request->get('VCON_CED1') != '') ? trim($request->get('VCON_CED1')) : 'NA',
				'VCON_TEL1'   			=> ($request->get('VCON_TEL1') != '') ? trim($request->get('VCON_TEL1')) : 'NA',
				'VCON_NOM2'   			=> ($request->get('VCON_NOM2') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM2')))) : 'NA',
				'VCON_CED2'   			=> ($request->get('VCON_CED2') != '') ? trim($request->get('VCON_CED2')) : 'NA',
				'VCON_TEL2'   			=> ($request->get('VCON_TEL2') != '') ? trim($request->get('VCON_TEL2')) : 'NA',
				'VCON_DIR'   			=> ($request->get('VCON_DIR') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_DIR')))) : 'NA',
				'TRAT_DATOS'  			=> trim($request->get('TRAT_DATOS')),
				'TIPOCLIENTE' 			=> 'NUEVO',
				'SUBTIPO'     			=> 'NUEVO',
				'FEC_NAC'	  			=> '1900-01-01',
				'EDAD'        			=> 0,
				'CIUD_UBI'    			=> trim($cityName[0]->CIUDAD),
				'DEPTO'       			=> trim(strtoupper($cityName[0]->DEPARTAMENTO)),
				'ID_CIUD_UBI' 			=> trim($getIdcityUbi[0]->ID_DIAN),
				'ID_CIUD_EXP' 			=> '',
				'MEDIO_PAGO'  			=> 00,
				'CIUD_EXP'    			=> '',
				'ORIGEN'      			=> 'ASESORES-CONTADO',
				'CLIENTE_WEB' 			=> $clienteWeb,
				'SUC'         			=> $sucursal,
				'PASO'        			=> '',
				'ESTADOCIVIL'           => '',
				'NIT_EMP'               => '',
				'RAZON_SOC'             => '',
				'DIR_EMP'               => '',
				'TEL_EMP'               => '',
				'TEL2_EMP'              => '',
				'ACT_ECO'               => '',
				'CARGO'                 => '',
				'FEC_ING'               => '1900-01-01',
				'ANTIG'                 => '',
				'SUELDO'                => '',
				'TIPO_CONT'             => '',
				'PLACA' 				=> 'NA',
				'OTROS_ING'             => '',
				'CAMARAC'               => 'NO',
				'NIT_IND'               => '',
				'RAZON_IND'             => 'NA',
				'ACT_IND'               => '0',
				'FEC_CONST'             => '1900-01-01',
				'EDAD_INDP'             => '0',
				'SUELDOIND'             => '',
				'BANCOP'                => 'NA',
				'USUARIO_CREACION'      => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $assessorCode,
				'EPS_CONYU' 			=> '',
				'CEDULA_C' 				=> '',
				'DIRECCION4'			=> 'NA',
				'TRABAJO_CONYU' 		=> '',
				'CARGO_CONYU' 			=> '',
				'NOMBRE_CONYU' 			=> '',
				'PROFESION_CONYU'		=> '',
				'SALARIO_CONYU' 		=> '',
				'CELULAR_CONYU' 		=> '',
				'STATE' 				=> 'A'

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
			if ($request->get('CIUD_EXP') != '') {
				$getNameCiudadExp = $this->getNameCiudadExp(trim($request->get('CIUD_EXP')));
				$getIdcityExp     = $this->getIdcityUbi(trim($getNameCiudadExp[0]->NOMBRE));
			}
			$age = 0;
			if ($request->get('FEC_EXP') != '') {
				$age = $this->calculateAgeFromExpeditionDate($request->get('FEC_EXP'));
			}
			if ($request->get('CIUD_NAC') != '' && $request->get('CIUD_NAC') != 'NA') {
				$getIdcityNac     = $this->getIdcityUbi(trim($request->get('CIUD_NAC')));
			}
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
				'APELLIDOS'   			=> ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'NOMBRES'   			=> ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'TIPOCLIENTE'           => 'OPORTUYA',
				'SUBTIPO'               => 'WEB',
				'EDAD'                  => $age,
				'FEC_EXP'     			=> ($request->get('FEC_EXP') != '') ?  trim($request->get('FEC_EXP')) : '1900-01-01',
				'CIUD_EXP'              => ($request->get('CIUD_EXP') != '') ? trim($getNameCiudadExp[0]->NOMBRE) : '',
				'SEXO'  				=> ($request->get('SEXO') != '') ? trim($request->get('SEXO')) : '',
				'PERSONAS'  			=> ($request->get('PERSONAS') != '') ? trim($request->get('PERSONAS')) : '0',
				'FEC_NAC'               => ($request->get('FEC_NAC') != '') ? trim($request->get('FEC_NAC')) : '1980-01-01',
				'ESTADOCIVIL'  			=> ($request->get('ESTADOCIVIL') != '') ? trim($request->get('ESTADOCIVIL')) : '',
				'ESTUDIOS'  			=> ($request->get('ESTUDIOS') != '') ? trim($request->get('ESTUDIOS')) : '',
				'POSEEVEH'  			=> ($request->get('POSEEVEH') != '') ? trim($request->get('POSEEVEH')) : '',
				'PLACA'  				=> ($request->get('PLACA') != '') ? trim($request->get('PLACA')) : '',
				'PROFESION'  			=> ($request->get('PROFESION') != '') ? trim($request->get('PROFESION')) : '',
				'TIPOV'  				=> ($request->get('TIPOV') != '') ? trim($request->get('TIPOV')) : '',
				'PROPIETARIO'   		=> ($request->get('PROPIETARIO') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('PROPIETARIO')))) : 'NA',
				'TEL_PROP'   			=> ($request->get('TEL_PROP') != '') ? trim($request->get('TEL_PROP')) : '0',
				'VRARRIENDO'            => trim($request->get('VRARRIENDO') != '') ? trim($request->get('VRARRIENDO')) : 0,
				'DIRECCION'   			=> ($request->get('DIRECCION') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIRECCION')))) : 'NA',
				'TELFIJO'   			=> ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO')) : '0',
				'CELULAR'   			=> ($request->get('CELULAR') != '') ? trim($request->get('CELULAR')) : '0',
				'TIEMPO_VIV'   			=> ($request->get('TIEMPO_VIV') != '') ? trim($request->get('TIEMPO_VIV')) : '0',
				'CIUD_UBI'   			=> ($request->get('CIUD_UBI') != '') ?  trim($cityName[0]->CIUDAD) : '',
				'EMAIL'   				=> ($request->get('EMAIL') != '') ? trim($request->get('EMAIL')) : '',
				'DEPTO'                 => trim(strtoupper($cityName[0]->DEPARTAMENTO)),
				'ACTIVIDAD'             => trim($request->get('ACTIVIDAD')),
				'ACT_ECO'   			=> ($request->get('ACT_ECO') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('ACT_ECO')))) : 'NA',
				'NIT_EMP'   			=> ($request->get('NIT_EMP') != '') ? trim($request->get('NIT_EMP')) : '0',
				'RAZON_SOC'             => trim($request->get('RAZON_SOC') != '') ? trim(strtoupper($request->get('RAZON_SOC'))) : 'NA',
				'FEC_ING'               => ($request->get('FEC_ING') != '') ? trim($request->get('FEC_ING')) . "-01" : '1990-01-01',
				'ANTIG'   				=> ($antig != '') ? trim($antig) : '',
				'CARGO'   				=> ($request->get('CARGO') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('CARGO')))) : 'NA',
				'DIR_EMP'   			=> ($request->get('DIR_EMP') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIR_EMP')))) : 'NA',
				'TEL_EMP'   			=> ($request->get('TEL_EMP') != '') ? trim($request->get('TEL_EMP')) : 'NA',
				'TEL2_EMP'   			=> ($request->get('TEL2_EMP') != '') ? trim($request->get('TEL2_EMP')) : 'NA',
				'TIPO_CONT'   			=> ($request->get('TIPO_CONT') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('TIPO_CONT')))) : 'NA',
				'SUELDO'          	    => trim($request->get('SUELDO') != '') ? trim(strtoupper($request->get('SUELDO'))) : '0',
				'NIT_IND'          	    => ($request->get('NIT_IND') != '') ? trim($request->get('NIT_IND')) : '0',
				'RAZON_IND'   			=> ($request->get('RAZON_IND') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('RAZON_IND')))) : 'NA',
				'ACT_IND'          	    => ($request->get('ACT_IND') != '') ? trim($request->get('ACT_IND')) : 'NA',
				'EDAD_INDP'          	=> ($indp != '') ? trim($indp) : '',
				'FEC_CONST'             => ($request->get('FEC_CONST') != '') ? trim($request->get('FEC_CONST')) . "-01" : '1990-01-01',
				'N_EMPLEA'              => trim($request->get('N_EMPLEA')) . "-01",
				'VENTASMES'             => trim($request->get('VENTASMES')),
				'COSTOSMES'             => trim($request->get('COSTOSMES')),
				'GASTOS'             	=> trim($request->get('GASTOS')),
				'DEUDAMES'             	=> trim($request->get('DEUDAMES')),
				'OTROS_ING'             => ($request->get('OTROS_ING') != '') ? trim($request->get('OTROS_ING')) : '0',
				'ESTRATO'            	=> ($request->get('ESTRATO') != '') ? trim($request->get('ESTRATO')) : '0',
				'SUELDOIND'          	=> ($request->get('SUELDOIND') != '') ? trim($request->get('SUELDOIND')) : '0',
				'SUC'                   => $sucursal,
				'TEL3'          		=> ($request->get('TEL3') != '') ? trim($request->get('TEL3')) : '0',
				'TEL4'          		=> ($request->get('TEL4') != '') ? trim($request->get('TEL4')) : '0',
				'TEL5'          		=> ($request->get('TEL5') != '') ? trim($request->get('TEL5')) : '0',
				'TEL6'          		=> ($request->get('TEL6') != '') ? trim($request->get('TEL6')) : '0',
				'TEL7'          		=> ($request->get('TEL7') != '') ? trim($request->get('TEL7')) : '0',
				'DIRECCION2'       	  	=> ($request->get('DIRECCION2') != '') ? trim($request->get('DIRECCION2')) : 'NA',
				'DIRECCION3'          	=> ($request->get('DIRECCION3') != '') ? trim($request->get('DIRECCION3')) : 'NA',
				'DIRECCION4'          	=> ($request->get('DIRECCION4') != '') ? trim($request->get('DIRECCION4')) : 'NA',
				'CIUD_NAC'          	=> ($request->get('CIUD_NAC') != '') ? trim($request->get('CIUD_NAC')) : 'NA',
				'NOMBRE_CONYU'   		=> ($request->get('NOMBRE_CONYU') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRE_CONYU')))) : 'NA',
				'CELULAR_CONYU'         => ($request->get('CELULAR_CONYU') != '') ? trim($request->get('CELULAR_CONYU')) : '0',
				'TRABAJO_CONYU'         => ($request->get('TRABAJO_CONYU') != '') ? trim($request->get('TRABAJO_CONYU')) : 'NA',
				'SALARIO_CONYU'         => ($request->get('SALARIO_CONYU') != '') ? trim($request->get('SALARIO_CONYU')) : '0',
				'CAMARAC'          		=> ($request->get('CAMARAC') != '') ? trim($request->get('CAMARAC')) : 'NO',
				'BANCOP'           		=> ($request->get('BANCOP') != '') ? trim($request->get('BANCOP')) : '0',
				'CEDULA_C'              => ($request->get('CEDULA_C') != '') ? trim($request->get('CEDULA_C')) : '0',
				'PROFESION_CONYU'       => ($request->get('PROFESION_CONYU') != '') ? trim($request->get('PROFESION_CONYU')) : 'NA',
				'CARGO_CONYU'           => ($request->get('CARGO_CONYU') != '') ? trim($request->get('CARGO_CONYU')) : 'NA',
				'EPS_CONYU'           	=> ($request->get('EPS_CONYU') != '') ? trim($request->get('EPS_CONYU')) : 'NA',
				'TARJETA_OP'            => ($request->get('TARJETA_OP') != '') ? trim($request->get('TARJETA_OP')) : '',
				'CON1'            		=> ($request->get('CON1') != '') ? trim($request->get('CON1')) : '',
				'CON2'            		=> ($request->get('CON2') != '') ? trim($request->get('CON2')) : '',
				'CON3'            		=> ($request->get('CON3') != '') ? trim($request->get('CON3')) : '',
				'USU'           		=> ($request->get('USU') != '') ? trim($request->get('USU')) : '',
				'NOTA1'            		=> ($request->get('NOTA1') != '') ? trim($request->get('NOTA1')) : '',
				'NOTA2'            		=> ($request->get('NOTA2') != '') ? trim($request->get('NOTA2')) : '',
				'VCON_NOM1'            	=> ($request->get('VCON_NOM1') != '') ? trim($request->get('VCON_NOM1')) : '',
				'VCON_CED1'            	=> ($request->get('VCON_CED1') != '') ? trim($request->get('VCON_CED1')) : '',
				'VCON_TEL1'            	=> ($request->get('VCON_TEL1') != '') ? trim($request->get('VCON_TEL1')) : '',
				'VCON_NOM2'            	=> ($request->get('VCON_NOM2') != '') ? trim($request->get('VCON_NOM2')) : 'NA',
				'VCON_CED2'            	=> ($request->get('VCON_CED2') != '') ? trim($request->get('VCON_CED2')) : '',
				'VCON_TEL2'            	=> ($request->get('VCON_TEL2') != '') ? trim($request->get('VCON_TEL2')) : '',
				'VCON_DIR'            	=> ($request->get('VCON_DIR') != '') ? trim($request->get('VCON_DIR')) : '',
				'ORIGEN'                => 'ASESORES-CREDITO',
				'PASO'            		=> ($request->get('PASO') != '') ? trim($request->get('PASO')) : '',
				'STATE'            		=> 'A',
				'MEDIO_PAGO'            => ($request->get('MEDIO_PAGO') != '') ? trim($request->get('MEDIO_PAGO')) : '',
				'ID_CIUD_EXP'           => ($request->get('CIUD_EXP') != '') ? trim($getIdcityExp[0]->ID_DIAN) : '',
				'ID_CIUD_NAC'           => ($request->get('CIUD_NAC') != '' && $request->get('CIUD_NAC') != 'NA') ? trim($getIdcityNac[0]->ID_DIAN) : '',
				'ID_CIUD_UBI'           => trim($getIdcityUbi[0]->ID_DIAN),
				'TRAT_DATOS'            => trim($request->get('TRAT_DATOS')),
				'CLIENTE_WEB'           => $clienteWeb,
				'USUARIO_CREACION'      => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $assessorCode
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

	public function execConsultasleadAsesores($identificationNumber)
	{
		$oportudataLead = DB::connection('oportudata')->select("SELECT `CEDULA`, `TIPO_DOC`, `NOMBRES`, `APELLIDOS`, `FEC_EXP`
		FROM `CLIENTE_FAB`
		WHERE `CEDULA` = :cedula", ['cedula' => $identificationNumber]);

		$lastName = explode(" ", $oportudataLead[0]->APELLIDOS);

		$dateExpIdentification = explode("-", $oportudataLead[0]->FEC_EXP);
		$dateExpIdentification = $dateExpIdentification[2] . "/" . $dateExpIdentification[1] . "/" . $dateExpIdentification[0];

		$consultasFosyga = $this->execConsultaFosygaLead(
			$identificationNumber,
			$oportudataLead[0]->TIPO_DOC,
			$oportudataLead[0]->FEC_EXP,
			$oportudataLead[0]->NOMBRES,
			$oportudataLead[0]->APELLIDOS
		);


		if ($consultasFosyga == "-1" || $consultasFosyga == "-3") {
			return ['resp' => $consultasFosyga];
		}

		$consultaComercial = $this->execConsultaComercialLead($identificationNumber, $oportudataLead[0]->TIPO_DOC);
		if ($consultaComercial == 0) {
			$customer = $this->customerInterface->findCustomerById($identificationNumber);
			$customer->ESTADO = "SIN COMERCIAL";
			$customer->save();

			$dataIntention = [
				'CEDULA' => $identificationNumber,
				'ESTADO_INTENCION' => 3
			];

			$this->intentionInterface->createIntention($dataIntention);
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0,
				'resp'                 => 'true'
			];
		} else {
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0
			];

			$policyCredit = $this->validatePolicyCredit_new($identificationNumber);
			$infoLead     = [];
			$infoLead     = $this->getInfoLeadCreate($identificationNumber);
			return [
				'policy'               => $policyCredit,
				'resp'                 => $policyCredit['resp'],
				'quotaApprovedProduct' => (isset($policyCredit['quotaApprovedProduct'])) ? $policyCredit['quotaApprovedProduct'] : 0,
				'quotaApprovedAdvance' => (isset($policyCredit['quotaApprovedAdvance'])) ? $policyCredit['quotaApprovedAdvance'] : 0,
				'infoLead'             => $infoLead
			];
		}
	}

	private function execConsultaFosygaLead($identificationNumber, $typeDocument, $dateDocument, $name, $lastName)
	{
		// Fosyga
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$dateConsultaFosyga = $this->fosygaInterface->validateDateConsultaFosyga($identificationNumber, $this->daysToIncrement);
		if ($dateConsultaFosyga == "true") {
			$infoBdua = $this->webServiceInterface->execWebServiceFosygaRegistraduria($identificationNumber, '23948865', $typeDocument, "");
			$infoBdua = (array) $infoBdua;
			$consultaFosyga =  $this->fosygaInterface->createConsultaFosyga($infoBdua, $identificationNumber);
		} else {
			$consultaFosyga = 1;
		}

		$validateConsultaFosyga = 0;

		if ($consultaFosyga > 0) {
			$validateConsultaFosyga = $this->fosygaInterface->validateConsultaFosyga($identificationNumber, trim($name), trim($lastName), $dateDocument);
		} else {
			$validateConsultaFosyga = 1;
		}

		// Registraduria
		$dateConsultaRegistraduria = $this->registraduriaInterface->validateDateConsultaRegistraduria($identificationNumber,  $this->daysToIncrement);
		if ($dateConsultaRegistraduria == "true") {
			$infoEstadoCedula = $this->webServiceInterface->execWebServiceFosygaRegistraduria($identificationNumber, '91891024', $typeDocument, $dateDocument);
			$infoEstadoCedula = (array) $infoEstadoCedula;
			$consultaRegistraduria = $this->registraduriaInterface->createConsultaRegistraduria($infoEstadoCedula, $identificationNumber);
		} else {
			$consultaRegistraduria = 1;
		}

		$validateConsultaRegistraduria = 0;
		if ($consultaRegistraduria > 0) {
			$validateConsultaRegistraduria = $this->registraduriaInterface->validateConsultaRegistraduria($identificationNumber, strtolower(trim($name)), strtolower(trim($lastName)), $dateDocument);
		} else {
			$validateConsultaRegistraduria = 1;
		}

		if ($validateConsultaRegistraduria == -1) {
			return -1;
		}

		if ($validateConsultaRegistraduria < 0 || $validateConsultaFosyga < 0) {
			return "-3";
		}

		return "true";
	}

	private function execConsultaComercialLead($identificationNumber, $tipoDoc)
	{
		$dateConsultaComercial = $this->commercialConsultationInterface->validateDateConsultaComercial($identificationNumber, $this->daysToIncrement);
		if ($dateConsultaComercial == 'true') {
			$consultaComercial = $this->webServiceInterface->execConsultaComercial($identificationNumber, $tipoDoc);
		} else {
			$consultaComercial = 1;
		}

		return $consultaComercial;
	}

	private function validatePolicyCredit_new($identificationNumber)
	{
		// 5	Puntaje y 3.4 Calificacion Score
		$customerStatusDenied = false;
		$idDef = "";
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customerScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)->score;
		$data = ['CEDULA' => $identificationNumber];
		$customerIntention =  $this->intentionInterface->createIntention($data);

		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			if ($customerScore <= -8) {
				$perfilCrediticio = 'TIPO NE';
				$customerIntention->ID_DEF = '8';
				$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
				$customerIntention->save();
				return ['resp' => "false"];
			}

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customerStatusDenied = true;
				$idDef = '5';
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= -7 && $customerScore <= 0) {
				$perfilCrediticio = 'TIPO 5';
			}

			if ($customerScore >= 275 && $customerScore <= 527) {
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= 528 && $customerScore <= 624) {
				$perfilCrediticio = 'TIPO C';
			}

			if ($customerScore >= 625 && $customerScore <= 674) {
				$perfilCrediticio = 'TIPO B';
			}

			if ($customerScore >= 675 && $customerScore <= 1000) {
				$perfilCrediticio = 'TIPO A';
			}

			$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
			$customerIntention->save();
		}

		// 3.3 Estado de obligaciones
		$respValorMoraFinanciero = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($identificationNumber)->sum('finvrmora');
		$respValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');
		$totalValorMora          = $respValorMoraFinanciero + $respValorMoraReal;

		if ($totalValorMora > 100) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "6";
			}
			$customerIntention->ESTADO_OBLIGACIONES = 0;
			$customerIntention->save();
		} else {
			$customerIntention->ESTADO_OBLIGACIONES = 1;
			$customerIntention->save();
		}

		$customerRealDoubtful = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealDoubtful($identificationNumber);
		$customerFinDoubtful = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialDoubtful($identificationNumber);
		if ($customerRealDoubtful->isNotEmpty()) {
			if ($customerRealDoubtful[0]->rmsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		if ($customerFinDoubtful->isNotEmpty()) {
			if ($customerFinDoubtful[0]->finsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		//3.5 Historial de Crédito
		$historialCrediticio = 0;
		$historialCrediticio = $this->UpToDateFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extintFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->UpToDateRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extinctRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		$customerIntention->HISTORIAL_CREDITO = $historialCrediticio;
		//4.1 Zona de riesgo
		$customerIntention->ZONA_RIESGO =  $this->subsidiaryInterface->getSubsidiaryRiskZone($customer->SUC)->ZONA;
		// 4.2 Tipo de cliente
		$tipoCliente = '';
		$queryGetClienteActivo = sprintf("SELECT COUNT(`CEDULA`) as tipoCliente
		FROM TB_CLIENTES_ACTIVOS
		WHERE `CEDULA` = %s AND FECHA >= date_add(NOW(), INTERVAL -24 MONTH)", $identificationNumber);

		$respClienteActivo = DB::connection('oportudata')->select($queryGetClienteActivo);
		if ($respClienteActivo[0]->tipoCliente == 1) {
			$tipoCliente = 'OPORTUNIDADES';
		} else {
			$tipoCliente = 'NUEVO';
		}

		$customerIntention->TIPO_CLIENTE = $tipoCliente;
		$customerIntention->save();

		// 4.3 Edad.
		$queryEdad = $this->cifinBasicDataInterface->checkCustomerHasCifinBasicData($identificationNumber)->teredad;
		if ($queryEdad == false || empty($queryEdad)) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		if ($queryEdad == 'Mas 75') {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		$queryEdad = explode('-', $queryEdad);
		$edadMin = $queryEdad[0];
		$edadMax = $queryEdad[1];

		$validateTipoCliente = TRUE;
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$validateTipoCliente = FALSE;
			if ($edadMin >= 18 && $edadMax <= 80) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		if ($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 75) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		if ($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 70) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		// 4.5 Tiempo en Labor
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$customerIntention->TIEMPO_LABOR = 1;
			$customerIntention->save();
		} else {
			if ($customer->ACTIVIDAD == 'RENTISTA' || $customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($customer->EDAD_INDP >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			} else {
				if ($customer->ANTIG >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			}
		}

		// 4.7 Inspecciones Oculares
		if ($tipoCliente == 'NUEVO') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5') {
					$customerIntention->INSPECCION_OCULAR = 1;
					$customerIntention->save();
				}
			}
		}

		// 3.6 Tarjeta Black
		$tarjeta = '';
		$aprobado = false;
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1) {
			$aprobado =  $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($identificationNumber);
			if ($aprobado == true) {
				$tarjeta = "Tarjeta Black";
				$quotaApprovedProduct = 1900000;
				$quotaApprovedAdvance = 500000;
			}
		}

		// 3.7 Tarjeta Gray
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1 && $aprobado == false) {
			if ($customer->ACTIVIDAD == 'PENSIONADO' || $customer->ACTIVIDAD == 'EMPLEADO') {
				$aprobado = true;
				$tarjeta = "Tarjeta Gray";
				$quotaApprovedProduct = 1600000;
				$quotaApprovedAdvance = 200000;
			}
		}

		if ($aprobado == true) {
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->save();
		}

		if ($aprobado == false && $perfilCrediticio == 'TIPO A') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($historialCrediticio == 1) {
					$customerIntention->ID_DEF  = '17';
				} else {
					$customerIntention->ID_DEF =  '18';
				}
			} else {
				$customerIntention->ID_DEF  = '15';
			}
			$customer->ESTADO           = 'PREAPROBADO';
			$tarjeta                    = "Crédito Tradicional";
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->ESTADO_INTENCION  = '2';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "-2"];
		}

		// 2. WS Fosyga
		$estadoCliente = "PREAPROBADO";
		$fuenteFallo = "false";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultationPolicy($identificationNumber);
		if (!empty($getDataFosyga)) {
			if ($getDataFosyga->fuenteFallo == 'SI') {
				$fuenteFallo = "true";
			} elseif (empty($getDataFosyga->estado) || empty($getDataFosyga->regimen) || empty($getDataFosyga->tipoAfiliado)) {
				$fuenteFallo = "true";
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = 0;
		if ($perfilCrediticio == 'TIPO 5' && ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PENSIONADO') && $statusAfiliationCustomer == true) {
			$tipo5Especial = 1;
		}

		$customerIntention->TIPO_5_ESPECiAL = $tipo5Especial;
		$customerIntention->save();

		//3.1 Estado de documento
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultationPolicy($identificationNumber);
		if (!empty($getDataRegistraduria)) {
			if ($getDataRegistraduria->fuenteFallo == 'SI') {
				$fuenteFallo = "true";
			} elseif (!empty($getDataRegistraduria->estado)) {
				if ($getDataRegistraduria->estado != 'VIGENTE') {
					$customer->ESTADO                     = 'NEGADO';
					$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
					$customerIntention->ID_DEF            =  '4';
					$customerIntention->ESTADO_INTENCION  = '1';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "false"];
				}
			} else {
				$fuenteFallo = "true";
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		if ($customerStatusDenied == true) {
			$customer->ESTADO          = 'NEGADO';
			$customerIntention->ID_DEF =  $idDef;
			$customerIntention->ESTADO_INTENCION  = '1';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "false"];
		}
		// 5 Definiciones cliente

		if ($customer->ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA') {
			$customer->ESTADO = 'PREAPROBADO';
			$customer->save();
			$customerIntention->TARJETA          = 'Crédito Tradicional';
			$customerIntention->ID_DEF           = '13';
			$customerIntention->ESTADO_INTENCION = '2';
			$customerIntention->save();
			return ['resp' =>  "-2"];
		}

		if ($perfilCrediticio == 'TIPO A') {
			if ($statusAfiliationCustomer == true) {
				if ($tipoCliente == 'OPORTUNIDADES') {
					$customer->ESTADO = 'PREAPROBADO';
					$customer->save();
					$customerIntention->TARJETA =  $tarjeta;
					$customerIntention->ID_DEF =  '14';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '15';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '16';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO           = 'PREAPROBADO';
						$customerIntention->TARJETA = $tarjeta;
						$customerIntention->ID_DEF  = '17';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customer->save();
						$customerIntention->save();
						return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
					} else {
						$customer->ESTADO = 'PREAPROBADO';
						$customer->save();
						$customerIntention->TARJETA = 'Crédito Tradicional';
						$customerIntention->ID_DEF =  '18';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customerIntention->save();
						return ['resp' => "-2"];
					}
				}
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '18';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO B') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '19';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '20';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO C') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '21';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '22';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $customerScore >= 275) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '23';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerIntention->TARJETA = '';
				$customerIntention->ID_DEF =  '24';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if ($tipo5Especial == 1) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '12';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '11';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '13';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
		}
		return ['resp' => "true"];
	}

	private function getInfoLeadCreate($identificationNumber)
	{
		$queryDataLead = DB::connection('oportudata')->select('SELECT cf.`TIPO_DOC`, cf.`CEDULA`, inten.`TIPO_CLIENTE`, cf.`FEC_NAC`, cf.`TIPOV`, cf.`ACTIVIDAD`, cf.`ACT_IND`, inten.`TIEMPO_LABOR`, cf.`SUELDO`, cf.`OTROS_ING`, cf.`SUELDOIND`, cf.`SUC`, cf.`DIRECCION`, cf.`CELULAR`, cf.`CREACION`, cfs.`score`, inten.`TARJETA`, cf.`ESTADO`, inten.`ID_DEF`, def.`DESCRIPCION`, def.`CARACTERISTICA`
		FROM `CLIENTE_FAB` as cf
		LEFT JOIN `TB_INTENCIONES` as inten ON inten.`CEDULA` = cf.`CEDULA`
		LEFT JOIN `TB_DEFINICIONES` as def ON def.id = inten.`ID_DEF`
		LEFT JOIN `cifin_score` as cfs ON cf.`CEDULA` = cfs.`scocedula`
		WHERE inten.`CEDULA` = :cedula AND cfs.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = :cedulaScore )
		ORDER BY FECHA_INTENCION DESC
		LIMIT 1', ['cedula' => $identificationNumber, 'cedulaScore' => $identificationNumber]);

		return $queryDataLead[0];
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

		$professions = $this->customerProfessionInterface->listCustomerProfessions();
		$kinships = $this->kinshipInterface->listKinships();
		return response()->json(['ubicationsCities' => $resp, 'cities' => $resp2, 'banks' => $resp3, 'professions' => $professions->toArray(), 'kinships' => $kinships->toArray()]);
	}

	public function getinfoLeadVentaContado($cedula)
	{

		$resp = [];
		$query = sprintf("SELECT cf.`TIPO_DOC`, cf.`CEDULA`, cf.`APELLIDOS`, cf.`NOMBRES`, cf.`TIPOCLIENTE`, cf.`PROFESION`, cf.`SUBTIPO`, cf.`EDAD`, cf.`EMAIL`, CONCAT(cf.`FEC_EXP`, ' 01:00:00') as FEC_EXP, cf.`SEXO`, CONCAT(cf.`FEC_NAC`, ' 01:00:00') as FEC_NAC, cf.`ESTADOCIVIL`, cf.`TIPOV`, cf.`PROPIETARIO`, cf.`VRARRIENDO`, cf.`DIRECCION`, cf. `TELFIJO`, cf. `TIEMPO_VIV`, cf.`CIUD_UBI`, cf.`DEPTO`, cf.`ACTIVIDAD`, cf.`ACT_ECO`, cf.`NIT_EMP`, cf.`RAZON_SOC`, CONCAT(cf.`FEC_ING`, ' 01:00:00') as FEC_ING, cf.`ANTIG`, cf.`CARGO`, cf.`DIR_EMP`, cf.`TEL_EMP`, cf.`TEL2_EMP`, cf.`TIPO_CONT`, cf.`SUELDO`, cf.`NIT_IND`, cf.`RAZON_IND`, cf.`ACT_IND`, cf.`EDAD_INDP`, CONCAT(cf.`FEC_CONST`, ' 01:00:00') as FEC_CONST, cf.`OTROS_ING`, cf.`ESTRATO`, cf.`SUELDOIND`, cf.`VCON_NOM1`, cf.`VCON_CED1`, cf.`VCON_TEL1`, cf.`VCON_NOM2`, cf.`VCON_CED2`, cf.`VCON_TEL2`, cf.`VCON_DIR`,cf.`MEDIO_PAGO`, cf.`TRAT_DATOS`, cf.`BANCOP`, cf.`CAMARAC`, cf.`PASO`, cf.`ORIGEN`, cf.`SUC`, cf.`ID_CIUD_EXP`, cf.`ID_CIUD_UBI`, cf.`PERSONAS`, cf.`ESTUDIOS`, cf.`POSEEVEH`, cf.`PLACA`, cf.`TEL_PROP`, cf.`N_EMPLEA`, cf.`VENTASMES`, cf.`COSTOSMES`, cf.`GASTOS`, cf.`DEUDAMES`, cf.`TEL3`, cf.`TEL4`, cf.`TEL5`, cf.`TEL6`, cf.`TEL7`, cf.`DIRECCION2`, cf.`DIRECCION3`, cf.`DIRECCION4`, cf.`CIUD_NAC`, cf.`CEDULA_C`, cf.`NOMBRE_CONYU`, cf.`CELULAR_CONYU`, cf.`TRABAJO_CONYU`, cf.`PROFESION_CONYU`, cf.`CARGO_CONYU`, cf.`SALARIO_CONYU`, cf.`EPS_CONYU`, suc.CODIGO as CIUD_UBI, ciu.`CODIGO` as CIUD_EXP
			FROM `CLIENTE_FAB` as cf
			LEFT JOIN SUCURSALES as suc ON suc.CIUDAD = cf.CIUD_UBI
			LEFT JOIN CIUDADES as ciu ON ciu.`NOMBRE` = cf.`CIUD_EXP`
			WHERE `CEDULA` = '%s' AND suc.PRINCIPAL = 1 ", $cedula);
		$data = DB::connection('oportudata')->select($query);
		if (!empty($data)) {
			foreach ($data[0] as $key => $value) {
				if ($key != 'CIUD_UBI' && $key != 'CIUD_EXP') {
					$data[0]->$key = trim($value);
				}
			}
			$resp = response()->json($data[0]);
		} else {
			$data = $this->temporaryCustomerInterface->findCustomerById($cedula);
			if (!empty($data)) {
				$data = $data->toArray();
				foreach ($data as $key => $value) {
					if ($key != 'CIUD_UBI' && $key != 'CIUD_EXP') {
						$data[$key] = trim($value);
					} else {
						$data[$key] = intval($value);
					}
				}

				$resp = $data;
			}
		}


		return $resp;
	}



	public function desistCredit($identificationNumber)
	{
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Desistido';
		$intention->save();

		return "1";
	}


	public function decisionCreditCard($lastName, $identificationNumber, $quotaApprovedProduct, $quotaApprovedAdvance, $dateExpIdentification, $nom_refper, $dir_refper, $tel_refper, $nom_refpe2, $dir_refpe2, $tel_refpe2, $nom_reffam, $dir_reffam, $tel_reffam, $parentesco, $nom_reffa2, $dir_reffa2, $tel_reffa2, $parentesc2, $fuenteFallo)
	{
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tarjeta Oportuya';
		$intention->save();
		$tipoDoc = 1;
		$lastName = explode(" ", $lastName);
		$lastName = $lastName[0];
		$fechaExpIdentification = explode("-", $dateExpIdentification);
		$fechaExpIdentification = $fechaExpIdentification[2] . "/" . $fechaExpIdentification[1] . "/" . $fechaExpIdentification[0];
		$estadoSolic = 'ANALISIS';
		$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
		$resultUbica = $this->validateConsultaUbica($identificationNumber);
		if ($resultUbica == 0) {
			$confronta = $this->webServiceInterface->execConsultaConfronta($tipoDoc, $identificationNumber, $fechaExpIdentification, $lastName);
			if ($confronta == 1) {
				$form = $this->getFormConfronta($identificationNumber);
				if (empty($form)) {
					$estadoSolic = "ANALISIS";
				} else {
					return [
						'form' => $form,
						'resp' => 'confronta'
					];
				}
			} else {
				$estadoSolic = 'ANALISIS';
			}
		} else {
			$estadoSolic = 'APROBADO';
		}

		$policyCredit = [
			'quotaApprovedProduct' => $quotaApprovedProduct,
			'quotaApprovedAdvance' => $quotaApprovedAdvance,
			'resp' => 'true'
		];

		$data = [
			'NOM_REFPER' => $nom_refper,
			'DIR_REFPER' => $dir_refper,
			'BAR_REFPER' => '',
			'TEL_REFPER' => $tel_refper,
			'CIU_REFPER' => '',
			'NOM_REFPE2' => $nom_refpe2,
			'DIR_REFPE2' => $dir_refpe2,
			'BAR_REFPE2' => '',
			'TEL_REFPE2' => $tel_refpe2,
			'CIU_REFPE2' => '',
			'NOM_REFFAM' => $nom_reffam,
			'DIR_REFFAM' => $dir_reffam,
			'BAR_REFFAM' => '',
			'TEL_REFFAM' => $tel_reffam,
			'PARENTESCO' => $parentesco,
			'NOM_REFFA2' => $nom_reffa2,
			'DIR_REFFA2' => $dir_reffa2,
			'BAR_REFFA2' => '',
			'TEL_REFFA2' => $tel_reffa2,
			'PARENTESC2' => $parentesc2,
			'CON_CLI1' => '',
			'CON_CLI2' => '',
			'CON_CLI3' => '',
			'CON_CLI4' => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		$estadoSolic = ($fuenteFallo == 'true') ? 'ANALISIS' : $estadoSolic;

		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data);
	}


	private function execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName)
	{
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$dateConsultaUbica = $this->ubicaInterface->validateDateConsultaUbica($identificationNumber, $this->daysToIncrement);
		if ($dateConsultaUbica == 'true') {
			$consultaUbica = $this->webServiceInterface->execConsultaUbica($identificationNumber, $tipoDoc, $lastName);
		} else {
			$consultaUbica = 1;
		}

		return $consultaUbica;
	}

	public function validateConsultaUbica($identificationNumber)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customerUbicaConsultation = $customer->lastUbicaConsultation;
		$consec = $customerUbicaConsultation->consec;
		$aprobo = 0;
		$celLead = 0;

		$customerPhone =  $customer->checkedPhone;
		if (!empty($customerPhone)) {
			$celLead =	$customerPhone =  $customer->checkedPhone->NUM;
		}

		$telConsultaUbica = DB::connection('oportudata')->select("SELECT `ubicelular`, `ubiprimerrep` FROM `ubica_celular` WHERE `ubicelular` = :celular AND `ubiconsul` = :consec ", ['celular' => $celLead, 'consec' => $consec]);
		if (!empty($telConsultaUbica)) {
			$aprobo = $this->validateDateUbica($telConsultaUbica[0]->ubiprimerrep);
		} else {
			$aprobo = 0;
		}

		if ($aprobo == 0) {
			// Validacion Telefono empresarial
			if ($customer->TEL_EMP != '' && $customer->TEL_EMP != '0') {
				$telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_telefono` WHERE `ubitipoubi` LIKE '%LAB%' AND `ubiconsul` = :consec AND (`ubitelefono` = :tel_emp OR `ubitelefono` = :tel2_emp ) ", ['consec' => $consec, 'tel_emp' => $customer->TEL_EMP, 'tel2_emp' => $customer->TEL2_EMP]);
				if (!empty($telEmpConsultaUbica)) {
					$aprobo = $this->validateDateUbica($telEmpConsultaUbica[0]->ubiprimerrep);
				} else {
					$aprobo = 0;
				}
			} else {
				$aprobo = 0;
			}
		}

		if ($aprobo == 0) {
			// Validacion Correo
			if ($customer->EMAIL != '') {
				$emailConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_mail` WHERE `ubiconsul` = :consec AND `ubicorreo` = :correo ", ['consec' => $consec, 'correo' => $customer->EMAIL]);
				if (!empty($emailConsultaUbica)) {
					$aprobo = $this->validateDateUbica($emailConsultaUbica[0]->ubiprimerrep);
				}
			} else {
				$aprobo = 0;
			}
		}
		return $aprobo;
	}

	private function validateDateUbica($fecha)
	{
		$fechaTelConsultaUbica = explode("/", $fecha);
		$fechaTelConsultaUbica = "20" . $fechaTelConsultaUbica[2] . "-" . $fechaTelConsultaUbica[1] . "-" . $fechaTelConsultaUbica[0];
		$fechaTelConsultaUbica = strtotime($fechaTelConsultaUbica);
		$dateNow = date('Y-m-d');
		$dateNew = strtotime("- 12 month", strtotime($dateNow));
		$dateNew = date('Y-m-d', $dateNew);
		if ($fechaTelConsultaUbica < strtotime($dateNew)) {
			$aprobo = 1;
		} else {
			$aprobo = 0;
		}

		return $aprobo;
	}

	public function getFormConfronta($identificationNumber)
	{
		$queryForm = DB::connection('oportudata')->select("SELECT cws.consec, preg.secuencia_cuest, preg.secuencia_preg, preg.texto_preg, opcion.secuencia_resp, opcion.texto_resp
		FROM confronta_ws as cws, confronta_preg as preg, confronta_opcion as opcion
		WHERE cws.cedula = :cedula AND cws.consec = (SELECT MAX(consec) FROM confronta_ws WHERE cedula = :cedula2 )
		AND preg.consec = cws.consec AND opcion.consec=cws.consec
		AND preg.secuencia_preg = opcion.secuencia_preg", ['cedula' => $identificationNumber, 'cedula2' => $identificationNumber]);
		$form = [];
		foreach ($queryForm as $value) {
			$form[$value->secuencia_preg]['secuencia'] = $value->secuencia_preg;
			$form[$value->secuencia_preg]['pregunta'] = $value->texto_preg;
			$form[$value->secuencia_preg]['cuestionario'] = $value->secuencia_cuest;
			$form[$value->secuencia_preg]['cedula'] = $identificationNumber;
			$form[$value->secuencia_preg]['consec'] = $value->consec;
			$form[$value->secuencia_preg]['opciones'][] = ['secuencia_resp' => $value->secuencia_resp, 'opcion' => $value->texto_resp];
		}

		return $form;
	}

	public function validateFormConfronta(Request $request)
	{
		$leadInfo = $request->leadInfo;
		$confronta = $request->confronta;
		$cedula = "";
		$cuestionario = "";
		$consec = "";
		foreach ($confronta as $pregunta) {
			$insertSelec = DB::connection('oportudata')->select(
				'INSERT INTO `confronta_selec` (`consec`, `cedula`, `secuencia_cuest`, `secuencia_preg`, `secuencia_resp`)
			VALUES (:consec, :cedula, :secuencia_cuest, :secuencia_preg, :secuencia_resp)',
				['consec' => $pregunta['consec'], 'cedula' => $pregunta['cedula'], 'secuencia_cuest' => $pregunta['cuestionario'], 'secuencia_preg' => $pregunta['secuencia'], 'secuencia_resp' => $pregunta['opcion']]
			);
			$cedula = $pregunta['cedula'];
			$cuestionario = $pregunta['cuestionario'];
			$consec = $pregunta['consec'];
		}

		$this->execEvaluarConfronta($cedula, $cuestionario);

		$getResultConfronta = DB::connection('oportudata')->select("SELECT `cod_resp`
		FROM `confronta_result`
		WHERE `consec` = :consec AND `cedula` = :cedula", ['consec' => $consec, 'cedula' => $cedula]);

		if ($getResultConfronta[0]->cod_resp == 1) {
			$estadoSolic = "APROBADO";
		} else {
			$estadoSolic = "ANALISIS";
		}
		$dataDatosCliente = ['NOM_REFPER' => $leadInfo['NOM_REFPER'], 'TEL_REFPER' => $leadInfo['TEL_REFPER'], 'NOM_REFFAM' => $leadInfo['NOM_REFFAM'], 'TEL_REFFAM' => $leadInfo['TEL_REFFAM']];
		$leadInfo['identificationNumber'] = (isset($leadInfo['identificationNumber'])) ? $leadInfo['identificationNumber'] : $leadInfo['CEDULA'];
		$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($cedula);
		if ($customerIntention->TARJETA == 'Tarjeta Black') {
			$policyCredit = [
				'quotaApprovedProduct' => 1900000,
				'quotaApprovedAdvance' => 500000,
				'resp' => 'true'
			];
		} elseif ($customerIntention->TARJETA == 'Tarjeta Gray') {
			$policyCredit = [
				'quotaApprovedProduct' => 1600000,
				'quotaApprovedAdvance' => 200000,
				'resp' => 'true'
			];
		}

		$solicCredit = $this->addSolicCredit($leadInfo['identificationNumber'], $policyCredit, $estadoSolic, "PASOAPASO", $dataDatosCliente);

		$estado = ($estadoSolic == "APROBADO") ? "APROBADO" : "PREAPROBADO";
		$quotaApprovedProduct = $solicCredit['quotaApprovedProduct'];
		$quotaApprovedAdvance = $solicCredit['quotaApprovedAdvance'];
		return response()->json(['data' => true, 'quota' => $quotaApprovedProduct, 'numSolic' => $solicCredit['infoLead']->numSolic, 'textPreaprobado' => 2, 'quotaAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
	}

	private function addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data)
	{

		$numSolic = $this->addSolicFab($identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic);
		if (!empty($data)) {
			$data['identificationNumber'] = $identificationNumber;
			$data['numSolic']             = $numSolic;
		} else {
			$dataDatosCliente = [
				'identificationNumber' => $identificationNumber,
				'numSolic'             => $numSolic,
				'NOM_REFPER'           => 'NA',
				'TEL_REFPER'           => 'NA',
				'NOM_REFFAM'           => 'NA',
				'TEL_REFFAM'           => 'NA'
			];
		}

		$addDatosCliente = $this->addDatosCliente($data);
		$addAnalisis        = $this->addAnalisis($numSolic, $identificationNumber);
		$infoLead           = (object) [];
		if ($estadoSolic != 'ANALISIS') {
			$infoLead = $this->getInfoLeadCreate($identificationNumber);
		}
		$infoLead->numSolic = $numSolic->SOLICITUD;
		if ($estadoSolic == "APROBADO") {
			$customer = $this->customerInterface->findCustomerById($identificationNumber);
			$customer->ESTADO = "APROBADO";
			$customer->save();

			$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
			$customerIntention->ESTADO_INTENCION = 4;
			$customerIntention->save();

			$estadoResult = "APROBADO";
			$tarjeta = $this->creditCardInterface->createCreditCard($numSolic->SOLICITUD, $identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $infoLead->SUC, $infoLead->TARJETA);
		} elseif ($estadoSolic == "EN SUCURSAL") {
			$estadoResult = "PREAPROBADO";
		} else {
			$estadoResult = "PREAPROBADO";
			$turnos = $this->addTurnosOportuya($identificationNumber, $numSolic);
		}
		$dataLead = [
			'ESTADO' => $estadoResult,
		];
		$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', ' = ', $identificationNumber)->update($dataLead);
		$infoLead = (object) [];
		if ($estadoSolic != 'ANALISIS') {
			$infoLead = $this->getInfoLeadCreate($identificationNumber);
		}
		$infoLead->numSolic = $numSolic->SOLICITUD;

		return [
			'estadoCliente'        => $estadoResult,
			'resp'                 => $policyCredit['resp'],
			'infoLead'             => $infoLead,
			'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']
		];
	}

	private function addSolicFab($identificationNumber, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado)
	{
		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
		$queryIdEmpresa = sprintf("SELECT `ID_EMPRESA` FROM `ASESORES` WHERE `CODIGO` = '%s'", $assessorCode);
		$IdEmpresa = DB::connection('oportudata')->select($queryIdEmpresa);

		$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', '=', $identificationNumber)->get();
		$sucursal = DB::connection('oportudata')->select(sprintf("SELECT `CODIGO` FROM `SUCURSALES` WHERE `CIUDAD` = '%s' AND `PRINCIPAL` = 1 ", $oportudataLead[0]->CIUD_UBI));
		$sucursal = $sucursal[0]->CODIGO;
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$solic_fab                = new FactoryRequest;
		$solic_fab->AVANCE_W      = $quotaApprovedAdvance;
		$solic_fab->PRODUC_W      = $quotaApprovedProduct;
		$solic_fab->CLIENTE       = $identificationNumber;
		$solic_fab->CODASESOR     = $assessorCode;
		$solic_fab->id_asesor     = $assessorCode;
		$solic_fab->ID_EMPRESA    = $IdEmpresa[0]->ID_EMPRESA;
		$solic_fab->FECHASOL      = date("Y-m-d H:i:s");
		$solic_fab->SUCURSAL      = $sucursal;
		$solic_fab->ESTADO        = $estado;
		$solic_fab->FTP           = 0;
		$solic_fab->STATE         = "A";
		$solic_fab->GRAN_TOTAL    = 0;
		$solic_fab->SOLICITUD_WEB = 1;
		$solic_fab->save();
		$numSolic = $this->factoryInterface->getCustomerFactoryRequest($identificationNumber);
		$this->codebtorInterface->createCodebtor($numSolic);
		$this->secondCodebtorInterface->createSecondCodebtor($numSolic);
		return $numSolic;
	}

	private function addDatosCliente($data = [])
	{
		$datosCliente             = new DatosCliente();
		$datosCliente->CEDULA     = (isset($data['identificationNumber']) && $data['identificationNumber'] != '') ? $data['identificationNumber'] : 'NA';
		$datosCliente->SOLICITUD  = (isset($data['numSolic']->SOLICITUD) && $data['numSolic']->SOLICITUD != '') ? $data['numSolic']->SOLICITUD : 'NA';
		$datosCliente->NOM_REFPER = (isset($data['NOM_REFPER']) && $data['NOM_REFPER'] != '') ? $data['NOM_REFPER'] : 'NA';
		$datosCliente->DIR_REFPER = (isset($data['DIR_REFPER']) && $data['DIR_REFPER'] != '') ? $data['DIR_REFPER'] : 'NA';
		$datosCliente->BAR_REFPER = (isset($data['BAR_REFPER']) && $data['BAR_REFPER'] != '') ? $data['BAR_REFPER'] : 'NA';
		$datosCliente->TEL_REFPER = (isset($data['TEL_REFPER']) && $data['TEL_REFPER'] != '') ? $data['TEL_REFPER'] : 'NA';
		$datosCliente->CIU_REFPER = (isset($data['CIU_REFPER']) && $data['CIU_REFPER'] != '') ? $data['CIU_REFPER'] : 'NA';
		$datosCliente->NOM_REFPE2 = (isset($data['NOM_REFPE2']) && $data['NOM_REFPE2'] != '') ? $data['NOM_REFPE2'] : 'NA';
		$datosCliente->DIR_REFPE2 = (isset($data['DIR_REFPE2']) && $data['DIR_REFPE2'] != '') ? $data['DIR_REFPE2'] : 'NA';
		$datosCliente->BAR_REFPE2 = (isset($data['BAR_REFPE2']) && $data['BAR_REFPE2'] != '') ? $data['BAR_REFPE2'] : 'NA';
		$datosCliente->TEL_REFPE2 = (isset($data['TEL_REFPE2']) && $data['TEL_REFPE2'] != '') ? $data['TEL_REFPE2'] : 'NA';
		$datosCliente->CIU_REFPE2 = (isset($data['CIU_REFPE2']) && $data['CIU_REFPE2'] != '') ? $data['CIU_REFPE2'] : 'NA';
		$datosCliente->NOM_REFFAM = (isset($data['NOM_REFFAM']) && $data['NOM_REFFAM'] != '') ? $data['NOM_REFFAM'] : 'NA';
		$datosCliente->DIR_REFFAM = (isset($data['DIR_REFFAM']) && $data['DIR_REFFAM'] != '') ? $data['DIR_REFFAM'] : 'NA';
		$datosCliente->BAR_REFFAM = (isset($data['BAR_REFFAM']) && $data['BAR_REFFAM'] != '') ? $data['BAR_REFFAM'] : 'NA';
		$datosCliente->TEL_REFFAM = (isset($data['TEL_REFFAM']) && $data['TEL_REFFAM'] != '') ? $data['TEL_REFFAM'] : 'NA';
		$datosCliente->PARENTESCO = (isset($data['PARENTESCO']) && $data['PARENTESCO'] != '') ? $data['PARENTESCO'] : 'NA';
		$datosCliente->NOM_REFFA2 = (isset($data['NOM_REFFA2']) && $data['NOM_REFFA2'] != '') ? $data['NOM_REFFA2'] : 'NA';
		$datosCliente->DIR_REFFA2 = (isset($data['DIR_REFFA2']) && $data['DIR_REFFA2'] != '') ? $data['DIR_REFFA2'] : 'NA';
		$datosCliente->BAR_REFFA2 = (isset($data['BAR_REFFA2']) && $data['BAR_REFFA2'] != '') ? $data['BAR_REFFA2'] : 'NA';
		$datosCliente->TEL_REFFA2 = (isset($data['TEL_REFFA2']) && $data['TEL_REFFA2'] != '') ? $data['TEL_REFFA2'] : 'NA';
		$datosCliente->PARENTESC2 = (isset($data['PARENTESC2']) && $data['PARENTESC2'] != '') ? $data['PARENTESC2'] : 'NA';
		$datosCliente->NOM_REFCOM = 'NA';
		$datosCliente->TEL_REFCOM = 'NA';
		$datosCliente->NOM_REFCO2 = 'NA';
		$datosCliente->TEL_REFCO2 = 'NA';
		$datosCliente->NOM_CONYUG = 'NA';
		$datosCliente->CED_CONYUG = 'NA';
		$datosCliente->DIR_CONYUG = 'NA';
		$datosCliente->PROF_CONYU = " ";
		$datosCliente->EMP_CONYUG = 'NA';
		$datosCliente->CARGO_CONY = 'NA';
		$datosCliente->EPS_CONYUG = 'NA';
		$datosCliente->TEL_CONYUG = 'NA';
		$datosCliente->ING_CONYUG = 0;
		$datosCliente->CON_CLI1   = '';
		$datosCliente->CON_CLI2   = '';
		$datosCliente->CON_CLI3   = '';
		$datosCliente->CON_CLI4   = '';
		$datosCliente->EDIT_RFCLI = '';
		$datosCliente->EDIT_RFCL2 = '';
		$datosCliente->EDIT_RFCL3 = " ";
		$datosCliente->INFORMA1   = 'NA';
		$datosCliente->CARGO_INF1 = 'NA';
		$datosCliente->FEC_COM1   = 'NA';
		$datosCliente->FEC_COM2   = 'NA';
		$datosCliente->ART_COM1   = 'NA';
		$datosCliente->ART_COM2   = 'NA';
		$datosCliente->CUOT_COM1  = 'NA';
		$datosCliente->CUOT_COM2  = "Al Dia";
		$datosCliente->HABITO1    = "Al Dia";
		$datosCliente->HABITO2    = "Al Dia";
		$datosCliente->STATE      = "A";
		$createData = $datosCliente->save();

		return "true";
	}

	private function addAnalisis($numSolic, $identificationNumber)
	{
		$queryTemp = sprintf("SELECT `paz_cli`, `fos_cliente` FROM `temp_consultaFosyga` WHERE `cedula` = '%s' ORDER BY `id` DESC LIMIT 1 ", $identificationNumber);
		$respQueryTemp = DB::connection('oportudata')->select($queryTemp);

		$analisis               = new Analisis;
		$analisis->solicitud    = $numSolic->SOLICITUD;
		$analisis->ini_analis   = date("Y-m-d H:i:s");
		$analisis->fec_datacli  = "1900-01-01 00:00:00";
		$analisis->fec_datacod1 = "1900-01-01 00:00:00";
		$analisis->fec_datacod2 = "1900-01-01 00:00:00";
		$analisis->ini_ref      = "1900-01-01 00:00:00";
		$analisis->valor        = "0";
		$analisis->rf_fpago     = "1900-01-01 00:00:00";
		$analisis->fin_analis   = "1900-01-01 00:00:00";
		$analisis->fin_analis   = "1900-01-01 00:00:00";
		$analisis->Fin_ref      = "1900-01-01 00:00:00";
		$analisis->autoriz      = "0";
		$analisis->fact_aur     = "0";
		$analisis->ini_def      = "1900-01-01 00:00:00";
		$analisis->fin_def      = "1900-01-01 00:00:00";
		$analisis->fec_aur      = "1900-01-01 00:00:00";
		$analisis->aurfe_cli1   = "1900-01-01 00:00:00";
		$analisis->aurfe_cli3   = "1900-01-01 00:00:00";
		$analisis->aurfe_cli3   = "1900-01-01 00:00:00";
		$analisis->aurfe_cod1   = "1900-01-01 00:00:00";
		$analisis->aurfe_cod12  = "1900-01-01 00:00:00";
		$analisis->aurfe_cod13  = "1900-01-01 00:00:00";
		$analisis->aurfe_cod2   = "1900-01-01 00:00:00";
		$analisis->aurfe_cod21  = "1900-01-01 00:00:00";
		$analisis->aurfe_cod22  = "1900-01-01 00:00:00";
		$analisis->aurcu_cli1   = "0";
		$analisis->aurcu_cli2   = "0";
		$analisis->aurcu_cli3   = "0";
		$analisis->aurcu_cod1   = "0";
		$analisis->aurcu_cod12  = "0";
		$analisis->aurcu_cod13  = "0";
		$analisis->aurcu_cod2   = "0";
		$analisis->scor_cli     = "0";
		$analisis->scor_cod1    = "0";
		$analisis->scor_cod2    = "0";
		$analisis->data_cli     = "0";
		$analisis->data_cod1    = "0";
		$analisis->data_cod2    = "0";
		$analisis->rec_cod1     = "0";
		$analisis->rec_cod2     = "0";
		$analisis->io_cod1      = "0";
		$analisis->io_cod2      = "0";
		$analisis->aurcu_cod21  = "0";
		$analisis->aurcu_cod22  = "0";
		$analisis->vcu_cli1     = "0";
		$analisis->vcu_cli2     = "0";
		$analisis->vcu_cli3     = "0";
		$analisis->vcu_cod1     = "0";
		$analisis->vcu_cod12    = "0";
		$analisis->vcu_cod13    = "0";
		$analisis->vcu_cod2     = "0";
		$analisis->vcu_cod21    = "0";
		$analisis->vcu_cod22    = "0";
		$analisis->aurcre_cli1  = "0";
		$analisis->aurcre_cli2  = "0";
		$analisis->aurcre_cli3  = "0";
		$analisis->aurcre_cod1  = "0";
		$analisis->aurcre_cod12 = "0";
		$analisis->aurcre_cod13 = "0";
		$analisis->aurcre_cod2  = "0";
		$analisis->aurcre_cod21 = "0";
		$analisis->aurcre_cod22 = "0";
		if (count($respQueryTemp) > 0) {
			$analisis->paz_cli     = $respQueryTemp[0]->paz_cli;
			$analisis->fos_cliente = $respQueryTemp[0]->fos_cliente;
		}
		$analisis->save();
	}

	private function addTurnosOportuya($identificationNumber, $numSolic)
	{
		$queryScoreLead = sprintf("SELECT `score` FROM `cifin_score` WHERE `scocedula` = %s ORDER BY `scoconsul` DESC LIMIT 1 ", $identificationNumber);
		$respScoreLead = DB::connection('oportudata')->select($queryScoreLead);
		$scoreLead = 0;
		if (!empty($respScoreLead)) {
			$scoreLead = $respScoreLead[0]->score;
		}

		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
		$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', '=', $identificationNumber)->get();
		$sucursal = DB::connection('oportudata')->select(sprintf("SELECT `CODIGO` FROM `SUCURSALES` WHERE `CIUDAD` = '%s' AND `PRINCIPAL` = 1 ", $oportudataLead[0]->CIUD_UBI));
		$sucursal = $sucursal[0]->CODIGO;
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$turnosOportuya            = new TurnosOportuya;
		$turnosOportuya->SOLICITUD = $numSolic->SOLICITUD;
		$turnosOportuya->CEDULA    = $identificationNumber;
		$turnosOportuya->FECHA     = date("Y-m-d H:i:s");
		$turnosOportuya->SUC       = $sucursal;
		$turnosOportuya->USUARIO   = '';
		$turnosOportuya->PRIORIDAD = '2';
		$turnosOportuya->ESTADO    = 'ANALISIS';
		$turnosOportuya->TIPO      = 'OPORTUYA';
		$turnosOportuya->SUB_TIPO  = 'WEB';
		$turnosOportuya->FEC_RET   = '1994-09-30 00:00:00';
		$turnosOportuya->FEC_FIN   = '1994-09-30 00:00:00';
		$turnosOportuya->VALOR     = '0';
		$turnosOportuya->FEC_ASIG  = '1994-09-30 00:00:00';
		$turnosOportuya->SCORE     = $scoreLead;
		$turnosOportuya->TIPO_CLI  = '';
		$turnosOportuya->CED_COD1  = '';
		$turnosOportuya->SCO_COD1  = '0';
		$turnosOportuya->TIPO_COD1 = '';
		$turnosOportuya->CED_COD2  = '';
		$turnosOportuya->SCO_COD2  = '0';
		$turnosOportuya->TIPO_COD2 = '';
		$turnosOportuya->STATE     = 'A';
		$turnosOportuya->save();

		return "true";
	}

	private function execEvaluarConfronta($cedula, $cuestionario)
	{
		$dataEvaluar = DB::connection('oportudata')->select("SELECT * FROM `confronta_selec` WHERE `cedula` = :cedula AND `secuencia_cuest` = :cuestionario", ['cedula' => $cedula, 'cuestionario' => $cuestionario]);
		try {
			// 2050 Confronta Pruebas
			$port = config('portsWs.confronta');
			$ws = new \SoapClient("http://10.238.14.181:" . $port . "/Service1.svc?singleWsdl"); //correcta
			$result = $ws->evaluarCuestionario(['Code' => 7081, 'question1' => $dataEvaluar[0]->secuencia_preg, 'answer1' => $dataEvaluar[0]->secuencia_resp, 'question2' => $dataEvaluar[1]->secuencia_preg, 'answer2' => $dataEvaluar[1]->secuencia_resp, 'question3' => $dataEvaluar[2]->secuencia_preg, 'answer3' => $dataEvaluar[2]->secuencia_resp, 'question4' => $dataEvaluar[3]->secuencia_preg, 'answer4' => $dataEvaluar[3]->secuencia_resp, 'secuence' => $cuestionario]);  // correcta
			return 1;
		} catch (\Throwable $th) {
			return 0;
		}
	}

	public function decisionTraditionalCredit($identificationNumber, $nom_refper, $dir_refper, $tel_refper, $nom_refpe2, $dir_refpe2, $tel_refpe2, $nom_reffam, $dir_reffam, $tel_reffam, $parentesco, $nom_reffa2, $dir_reffa2, $tel_reffa2, $parentesc2)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customer->TIPOCLIENTE = "NUEVO";
		$customer->SUBTIPO = "NUEVO";
		$customer->save();
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tradicional';
		$intention->save();
		$estadoSolic = 'EN SUCURSAL';
		$policyCredit = [
			'quotaApprovedProduct' => 0,
			'quotaApprovedAdvance' => 0,
			'resp' => 'true'
		];
		$data = [
			'NOM_REFPER' => $nom_refper,
			'DIR_REFPER' => $dir_refper,
			'BAR_REFPER' => '',
			'TEL_REFPER' => $tel_refper,
			'CIU_REFPER' => '',
			'NOM_REFPE2' => $nom_refpe2,
			'DIR_REFPE2' => $dir_refpe2,
			'BAR_REFPE2' => '',
			'TEL_REFPE2' => $tel_refpe2,
			'CIU_REFPE2' => '',
			'NOM_REFFAM' => $nom_reffam,
			'DIR_REFFAM' => $dir_reffam,
			'BAR_REFFAM' => '',
			'TEL_REFFAM' => $tel_reffam,
			'PARENTESCO' => $parentesco,
			'NOM_REFFA2' => $nom_reffa2,
			'DIR_REFFA2' => $dir_reffa2,
			'BAR_REFFA2' => '',
			'TEL_REFFA2' => $tel_reffa2,
			'PARENTESC2' => $parentesc2,
			'CON_CLI1'   => '',
			'CON_CLI2'   => '',
			'CON_CLI3'   => '',
			'CON_CLI4'   => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data);
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

	private function calculateAgeFromExpeditionDate($date){
		$expeditionDate = date('Y-m-d', strtotime($date));
		$dateExpeditionCustomer = Carbon::createFromFormat('Y-m-d', $expeditionDate);
		$dateNow = Carbon::now();
		$age = $dateExpeditionCustomer->diffInYears($dateNow) + 18;

		return $age;
	}

	private function calculateTimeCompany($fechaIngreso)
	{
		$fechaActual = date("Y-m-d");
		$dateDiff    = floor((strtotime($fechaActual) - strtotime($fechaIngreso)) / (60 * 60 * 24 * 30));
		return $dateDiff;
	}

	public function getInfoLead($identificationNumber)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);

		return $customer;
	}

	public function dashboard(Request $request)
	{
		$assessor = auth()->user()->email;
		$to = Carbon::now();
		$from = Carbon::now()->startOfMonth();

		$estadosAssessors      = $this->factoryInterface->countAssessorFactoryRequestStatuses($from, $to, $assessor);
		$webAssessorsCounts    = $this->factoryInterface->countWebAssessorFactory($from, $to, $assessor);
		$factoryAssessorsTotal = $this->factoryInterface->getAssessorFactoryTotal($from, $to, $assessor);
		$estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, array('APROBADO', 'EN FACTURACION'));
		$estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, "NEGADO");
		$estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, "DESISTIDO");
		$estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));

		if (request()->has('from')) {
			$estadosAssessors      = $this->factoryInterface->countAssessorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $assessor);
			$webAssessorsCounts    = $this->factoryInterface->countWebAssessorFactory(request()->input('from'), request()->input('to'), $assessor);
			$factoryAssessorsTotal = $this->factoryInterface->getAssessorFactoryTotal(request()->input('from'), request()->input('to'), $assessor);
			$estadosAprobados = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array('APROBADO', 'EN FACTURACION'));
			$estadosNegados = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "NEGADO");
			$estadosDesistidos = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, "DESISTIDO");
			$estadosPendientes = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array('NEGADO', 'DESISTIDO', 'APROBADO', 'EN FACTURACION'));
		}


		$estadosAprobados = $this->toolsInterface->extractValuesToArray($estadosAprobados);
		$estadosNegados = $this->toolsInterface->extractValuesToArray($estadosNegados);
		$estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
		$estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

		$estadosAssessors     = $estadosAssessors->toArray();
		$webAssessorsCounts   = $webAssessorsCounts->toArray();
		$estadosAssessors     = array_values($estadosAssessors);
		$webAssessorsCounts   = array_values($webAssessorsCounts);
		$statusesAssessors    = [];
		$statusesValues       = [];
		$statusesColors       = [];


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

		foreach ($estadosAssessors as $estadosName) {
			array_push($statusesAssessors, trim($estadosName['ESTADO']));
			array_push($statusesValues, trim($estadosName['total']));
		}

		$webValues     = [];
		$webAssessors  = [];

		foreach ($webAssessorsCounts as $webAssessorCount) {
			array_push($webAssessors, trim($webAssessorCount['ESTADO']));
			array_push($webValues, trim($webAssessorCount['total']));
		}


		return view('assessors.assessors.dashboard', [
			'statusesAssessors'       => $statusesAssessors,
			'statusesValues'          => $statusesValues,
			'statusesColors'          => $statusesColors,
			'webValues'               => $webValues,
			'webAssessors'            => $webAssessors,
			'totalStatuses'           => array_sum($statusesValues),
			'totalWeb'                => array_sum($webValues),
			'factoryAssessorsTotal'   => $factoryAssessorsTotal,
			'statusesAprobadosValues'  => $statusesAprobadosValues,
			'statusesNegadoValues'     => $statusesNegadoValues,
			'statusesPendientesValues' => $statusesPendientesValues,
			'statusesDesistidosValues' => $statusesDesistidosValues
		]);
	}
}
