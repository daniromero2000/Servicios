<?php

namespace App\Http\Controllers\Admin;

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
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use App\Entities\DebtorInsuranceOportuyas\DebtorInsuranceOportuya;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Kinships\Repositories\Interfaces\KinshipRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use App\Entities\Ruafs\Repositories\Interfaces\RuafRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use App\Entities\CreditCards\Black;
use App\Entities\CreditCards\Gray;
use App\Entities\EconomicSectors\Repositories\Interfaces\EconomicSectorRepositoryInterface;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\Policies\PolicyTrait;

class assessorsController extends Controller
{
	use PolicyTrait;

	private $kinshipInterface, $subsidiaryInterface, $ubicaInterface;
	private $customerInterface, $toolsInterface, $factoryRequestInterface, $temporaryCustomerInterface;
	private $daysToIncrement, $consultationValidityInterface, $analisisInterface;
	private $fosygaInterface, $registraduriaInterface, $webServiceInterface;
	private $commercialConsultationInterface, $customerProfessionInterface;
	private $creditCardInterface, $cifinRealArrearsInterface;
	private $UpToDateFinancialCifinInterface, $CifinFinancialArrearsInterface;
	private $intentionInterface, $extintFinancialCifinInterface;
	private $UpToDateRealCifinInterface, $extinctRealCifinInterface, $datosClienteInterface;
	private $codebtorInterface, $secondCodebtorInterface, $assessorInterface;
	private $cityInterface, $policyInterface, $OportuyaTurnInterface;
	private $confrontaSelectinterface, $ubicaMailInterface, $ubicaCellPhoneInterfac, $confrontaResultInterface;
	private $userInterface, $customerCellPhoneInterface, $economicSectorInterface;

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
		RuafRepositoryInterface $ruafRepositoryInterface,
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
		UbicaRepositoryInterface $ubicaRepositoryInterface,
		CityRepositoryInterface $cityRepositoryInterface,
		PolicyRepositoryInterface $policyRepositoryInterface,
		OportuyaTurnRepositoryInterface $oportuyaTurnRepositoryInterface,
		DatosClienteRepositoryInterface $datosClienteRepositoryInterface,
		FosygaTempRepositoryInterface $fosygaTempRepositoryInterface,
		AnalisisRepositoryInterface $analisisRepositoryInterface,
		ConfrontaSelectRepositoryInterface $confrontaSelectRepositoryInterface,
		UbicaEmailRepositoryInterface $ubicaEmailRepositoryInterface,
		UbicaCellPhoneRepositoryInterface $ubicaCellPhoneRepositoryInterface,
		ConfrontaResultRepositoryInterface $confrontaResultRepositoryInterface,
		UserRepositoryInterface $userRepositoryInterface,
		CustomerCellPhoneRepositoryInterface $customerCellPhoneInterface,
		EconomicSectorRepositoryInterface $economicSectorRepositoryInterface
	) {
		$this->secondCodebtorInterface         = $secondCodebtorRepositoryInterface;
		$this->codebtorInterface               = $codebtorRepositoryInterface;
		$this->kinshipInterface                = $kinshipRepositoryInterface;
		$this->temporaryCustomerInterface      = $temporaryCustomerRepositoryInterface;
		$this->customerProfessionInterface     = $customerProfessionRepositoryInterface;
		$this->assessorInterface               = $AssessorRepositoryInterface;
		$this->factoryRequestInterface         = $factoryRequestRepositoryInterface;
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
		$this->ubicaInterface                  = $ubicaRepositoryInterface;
		$this->ruafInterface                   = $ruafRepositoryInterface;
		$this->cityInterface                   = $cityRepositoryInterface;
		$this->policyInterface                 = $policyRepositoryInterface;
		$this->OportuyaTurnInterface           = $oportuyaTurnRepositoryInterface;
		$this->datosClienteInterface           = $datosClienteRepositoryInterface;
		$this->fosygaTempInterface             = $fosygaTempRepositoryInterface;
		$this->analisisInterface               = $analisisRepositoryInterface;
		$this->confrontaSelectinterface        = $confrontaSelectRepositoryInterface;
		$this->ubicaMailInterface              = $ubicaEmailRepositoryInterface;
		$this->ubicaCellPhoneInterfac          = $ubicaCellPhoneRepositoryInterface;
		$this->confrontaResultInterface        = $confrontaResultRepositoryInterface;
		$this->userInterface                   = $userRepositoryInterface;
		$this->customerCellPhoneInterface      = $customerCellPhoneInterface;
		$this->economicSectorInterface         = $economicSectorRepositoryInterface;
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$to 				= Carbon::now();
		$from 				= Carbon::now()->startOfMonth();
		$assessor 			= auth()->user()->email;
		$subsidiary 		= '';
		$skip         		= $this->toolsInterface->getSkip($request->input('skip'));
		$list         		= $this->factoryRequestInterface->listFactoryAssessors($skip * 30, $assessor);
		$listCount 	 		= $this->factoryRequestInterface->listFactoryAssessorsTotal($from, $to, $assessor);
		$estadosAprobados 	= $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
		$estadosNegados 	= $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
		$estadosDesistidos 	= $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
		$estadosPendientes 	= $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20), $subsidiary);

		if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
			$estadosAprobados = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20), $subsidiary);
			$estadosNegados = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16, $subsidiary);
			$estadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15, $subsidiary);
			$estadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20), $subsidiary);
		}
		if (request()->has('q')) {
			$list = $this->factoryRequestInterface->searchFactoryAseessors(
				request()->input('q'),
				$skip,
				request()->input('from'),
				request()->input('to'),
				request()->input('status'),
				request()->input('subsidiary'),
				$assessor
			)->sortByDesc('FECHASOL');
			$listCount = $this->factoryRequestInterface->searchFactoryAseessors(
				request()->input('q'),
				$skip,
				request()->input('from'),
				request()->input('to'),
				request()->input('status'),
				request()->input('subsidiary'),
				$assessor
			)->sortByDesc('FECHASOL');
		}

		$estadosAprobados  = $this->toolsInterface->extractValuesToArray($estadosAprobados);
		$estadosNegados    = $this->toolsInterface->extractValuesToArray($estadosNegados);
		$estadosDesistidos = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
		$estadosPendientes = $this->toolsInterface->extractValuesToArray($estadosPendientes);

		$statusesAprobadosValue = [];
		foreach ($estadosAprobados as $estadosAprobado) {
			array_push($statusesAprobadosValue, trim($estadosAprobado['total']));
		}
		$statusesAprobadosValues = 0;
		foreach ($statusesAprobadosValue as $key => $status) {
			$statusesAprobadosValues +=  $statusesAprobadosValue[$key];
		}

		$statusesNegadosValue = [];
		foreach ($estadosNegados as $estadosNegado) {
			array_push($statusesNegadosValue, trim($estadosNegado['total']));
		}
		$statusesNegadosValues = 0;
		foreach ($statusesNegadosValue as $key => $status) {
			$statusesNegadosValues +=  $statusesNegadosValue[$key];
		}

		$statusesDesistidosValue = [];
		foreach ($estadosDesistidos as $estadosDesistido) {
			array_push($statusesDesistidosValue, trim($estadosDesistido['total']));
		}
		$statusesDesistidosValues = 0;
		foreach ($statusesDesistidosValue as $key => $status) {
			$statusesDesistidosValues +=  $statusesDesistidosValue[$key];
		}

		$statusesPendientesValue = [];
		foreach ($estadosPendientes as $estadosPendiente) {
			array_push($statusesPendientesValue, trim($estadosPendiente['total']));
		}
		$statusesPendientesValues = 0;
		foreach ($statusesPendientesValue as $key => $status) {
			$statusesPendientesValues +=  $statusesPendientesValue[$key];
		}
		$factoryRequestsTotal = $listCount->sum('GRAN_TOTAL');
		$listCount            = $listCount->count();

		return view('assessors.assessors.list', [
			'factoryRequests'          => $list,
			'optionsRoutes'            => (request()->segment(2)),
			'headers'                  => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
			'listCount'                => $listCount,
			'skip'                     => $skip,
			'factoryRequestsTotal'     => $factoryRequestsTotal,
			'statusesAprobadosValues'  => $statusesAprobadosValues,
			'statusesNegadosValues'    => $statusesNegadosValues,
			'statusesDesistidosValues' => $statusesDesistidosValues,
			'statusesPendientesValues' => $statusesPendientesValues,
			'statuses'                 => FactoryRequestStatus::select('id', 'name')->orderBy('name', 'ASC')->get()

		]);
	}

	public function store(Request $request)
	{
		$assessorCode = $this->userInterface->getAssessorCode();
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		$this->customerCellPhoneInterface->validateHomePhoneContado($request);
		$sucursal     = trim($request->get('CIUD_UBI'));

		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$leadOportudata  = new Customer;
		$usuarioCreacion = $assessorCode;
		$clienteWeb      = 1;
		$getExistLead    = Customer::find($request->CEDULA);

		if (!empty($getExistLead)) {
			$clienteWeb      = $getExistLead->CLIENTE_WEB;
			$usuarioCreacion = $getExistLead->USUARIO_CREACION;
		}

		$subsidiaryCityName = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('CIUD_UBI'))->CIUDAD;
		$city               = $this->cityInterface->getCityByName($subsidiaryCityName);

		$search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
		$replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
		if ($request->tipoCliente == 'CONTADO') {
			$dataOportudata = [
				'TIPO_DOC'    			 	=> trim($request->get('TIPO_DOC')),
				'CEDULA'      			 	=> trim($request->get('CEDULA')),
				'FEC_EXP'     			 	=> '1980-01-01',
				'NOMBRES'   			 	=> ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'APELLIDOS'   			 	=> ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'EMAIL'       			 	=> trim($request->get('EMAIL')),
				'TELFIJO'     			 	=> ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO'))  : '0',
				'CELULAR'     			 	=> trim($request->get('CELULAR')),
				'PROFESION'   			 	=> 'NO APLICA',
				'PERSONAS'  			 	=> 0,
				'TIPOV'       			 	=> '',
				'TIEMPO_VIV'  			 	=> '',
				'PROPIETARIO' 			 	=> '',
				'VRARRIENDO'  			 	=> 0,
				'ESTUDIOS'  			 	=> '',
				'ESTRATO'     			 	=> '',
				'SEXO'        			 	=> trim($request->get('SEXO')),
				'DIRECCION'   			 	=> ($request->get('DIRECCION') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIRECCION')))) : 'NA',
				'VCON_NOM1'   			 	=> ($request->get('VCON_NOM1') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM1')))) : 'NA',
				'VCON_CED1'   			 	=> ($request->get('VCON_CED1') != '') ? trim($request->get('VCON_CED1')) : 'NA',
				'VCON_TEL1'   			 	=> ($request->get('VCON_TEL1') != '') ? trim($request->get('VCON_TEL1')) : 'NA',
				'VCON_NOM2'   			 	=> ($request->get('VCON_NOM2') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM2')))) : 'NA',
				'VCON_CED2'   			 	=> ($request->get('VCON_CED2') != '') ? trim($request->get('VCON_CED2')) : 'NA',
				'VCON_TEL2'   			 	=> ($request->get('VCON_TEL2') != '') ? trim($request->get('VCON_TEL2')) : 'NA',
				'VCON_DIR'   			 	=> ($request->get('VCON_DIR') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_DIR')))) : 'NA',
				'TRAT_DATOS'  			 	=> trim($request->get('TRAT_DATOS')),
				'TIPOCLIENTE' 			 	=> 'NUEVO',
				'SUBTIPO'     			 	=> 'NUEVO',
				'FEC_NAC'	  			 	=> '1900-01-01',
				'EDAD'        			 	=> 0,
				'CIUD_UBI'    			 	=> trim($subsidiaryCityName),
				'DEPTO'       			 	=> trim($city->DEPARTAMENTO),
				'ID_CIUD_UBI' 			 	=> trim($city->ID_DIAN),
				'ID_CIUD_EXP' 			 	=> '',
				'MEDIO_PAGO'  			 	=> 00,
				'CIUD_EXP'    			 	=> '',
				'ORIGEN'      			 	=> 'ASESORES',
				'CLIENTE_WEB' 			 	=> $clienteWeb,
				'SUC'         			 	=> $sucursal,
				'PASO'        			 	=> '',
				'ESTADOCIVIL'          		=> '',
				'NIT_EMP'              		=> '',
				'RAZON_SOC'            		=> '',
				'DIR_EMP'              		=> '',
				'TEL_EMP'              		=> '',
				'TEL2_EMP'             		=> '',
				'ACT_ECO'              		=> '',
				'CARGO'                		=> '',
				'FEC_ING'              		=> '1900-01-01',
				'ANTIG'                		=> '',
				'SUELDO'               		=> '',
				'TIPO_CONT'            		=> '',
				'PLACA' 					=> 'NA',
				'OTROS_ING'            		=> '',
				'CAMARAC'              		=> 'NO',
				'NIT_IND'              		=> '',
				'RAZON_IND'            		=> 'NA',
				'ACT_IND'              		=> '0',
				'FEC_CONST'            		=> '1900-01-01',
				'EDAD_INDP'            		=> '0',
				'SUELDOIND'            		=> '',
				'BANCOP'               		=> 'NA',
				'USUARIO_CREACION'     		=> $usuarioCreacion,
				'USUARIO_ACTUALIZACION'		=> $assessorCode,
				'EPS_CONYU' 			 	=> '',
				'CEDULA_C' 				 	=> '',
				'DIRECCION4'			 	=> 'NA',
				'TRABAJO_CONYU' 		 	=> '',
				'CARGO_CONYU' 			 	=> '',
				'NOMBRE_CONYU' 			 	=> '',
				'PROFESION_CONYU'		 	=> '',
				'SALARIO_CONYU' 		 	=> '',
				'CELULAR_CONYU' 		 	=> '',
				'STATE' 				 	=> 'A'
			];

			unset($dataOportudata['tipoCliente']);
			$leadOportudata->updateOrCreate(['CEDULA' => trim($request->get('CEDULA'))], $dataOportudata)->save();
			$this->customerCellPhoneInterface->validateCellPhoneContado($request);
			$this->webServiceInterface->execMigrateCustomer($request->get('CEDULA'));

			return $dataOportudata;
		} elseif ($request->tipoCliente == 'CREDITO') {
			if ($request->get('CIUD_EXP') != '') {
				$getNameCiudadExp = $this->cityInterface->getCityByCode($request->get('CIUD_EXP'));
			}

			if ($request->get('FEC_NAC') != '' && $request->get('FEC_NAC') != '1900-01-01') {
				$age = $this->customerInterface->calculateCustomerAge($request->get('FEC_NAC'));
			}

			if ($request->get('CIUD_NAC') != '' && $request->get('CIUD_NAC') != 'NA') {
				$getIdcityNac = $this->cityInterface->getCityByName(trim($request->get('CIUD_NAC')));
			}

			$antig = $request->get('ANTIG');
			$indp  = $request->get('EDAD_INDP');

			if (trim($request->get('ACTIVIDAD')) == 'EMPLEADO' || trim($request->get('ACTIVIDAD')) == 'SOLDADO-MILITAR-POLICÍA' || trim($request->get('ACTIVIDAD')) == 'PRESTACIÓN DE SERVICIOS') {
				$antig = $this->customerInterface->calculateCustomerCompanyTime(trim($request->get('FEC_ING')) . "-01");
			} else {
				$indp = $this->customerInterface->calculateCustomerCompanyTime(trim($request->get('FEC_CONST')) . "-01");
			}

			$dataOportudata = [
				'TIPO_DOC' 				=> trim($request->get('TIPO_DOC')),
				'CEDULA'   				=> trim($request->get('CEDULA')),
				'APELLIDOS'   			=> ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'NOMBRES'   			=> ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'TIPOCLIENTE' 		    => 'OPORTUYA',
				'SUBTIPO'               => 'WEB',
				'EDAD'       		 	=> ($age) ? $age : '0',
				'FEC_EXP'     			=> ($request->get('FEC_EXP') != '') ?  trim($request->get('FEC_EXP')) : '1900-01-01',
				'CIUD_EXP'              => ($request->get('CIUD_EXP') != '') ? trim($getNameCiudadExp->NOMBRE) : '',
				'SEXO'  				=> ($request->get('SEXO') != '') ? trim($request->get('SEXO')) : '',
				'PERSONAS'  			=> ($request->get('PERSONAS') != '') ? trim($request->get('PERSONAS')) : '0',
				'FEC_NAC'               => ($request->get('FEC_NAC') != '') ? trim($request->get('FEC_NAC')) : '1980-01-01',
				'ESTADOCIVIL'  			=> ($request->get('ESTADOCIVIL') != '') ? trim($request->get('ESTADOCIVIL')) : '',
				'ESTUDIOS'  			=> ($request->get('ESTUDIOS') != '') ? trim($request->get('ESTUDIOS')) : '',
				'POSEEVEH'  			=> ($request->get('POSEEVEH') != '') ? trim($request->get('POSEEVEH')) : '',
				'PLACA'  				=> ($request->get('PLACA') != '') ? trim($request->get('PLACA')) : 'NA',
				'PROFESION'  			=> ($request->get('PROFESION') != '') ? trim($request->get('PROFESION')) : '',
				'TIPOV'  				=> ($request->get('TIPOV') != '') ? trim($request->get('TIPOV')) : '',
				'PROPIETARIO'   		=> ($request->get('PROPIETARIO') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('PROPIETARIO')))) : 'NA',
				'TEL_PROP'   			=> ($request->get('TEL_PROP') != '') ? trim($request->get('TEL_PROP')) : '0',
				'VRARRIENDO'            => trim($request->get('VRARRIENDO') != '') ? trim($request->get('VRARRIENDO')) : 0,
				'DIRECCION'   			=> ($request->get('DIRECCION') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIRECCION')))) : 'NA',
				'TELFIJO'   			=> ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO')) : '0',
				'CELULAR'   			=> ($request->get('CELULAR') != '') ? trim($request->get('CELULAR')) : '0',
				'TIEMPO_VIV'   			=> ($request->get('TIEMPO_VIV') != '') ? trim($request->get('TIEMPO_VIV')) : '0',
				'CIUD_UBI'   			=> ($request->get('CIUD_UBI') != '') ?  trim($subsidiaryCityName) : '',
				'EMAIL'   				=> ($request->get('EMAIL') != '') ? trim($request->get('EMAIL')) : '',
				'DEPTO'                 => trim(strtoupper($city->DEPARTAMENTO)),
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
				'ORIGEN'                => 'ASESORES',
				'PASO'            		=> ($request->get('PASO') != '') ? trim($request->get('PASO')) : '',
				'STATE'            		=> 'A',
				'MEDIO_PAGO'            => ($request->get('MEDIO_PAGO') != '') ? trim($request->get('MEDIO_PAGO')) : '',
				'ID_CIUD_EXP'           => ($request->get('CIUD_EXP') != '') ? trim($getNameCiudadExp->ID_DIAN) : '',
				'ID_CIUD_NAC'           => ($request->get('CIUD_NAC') != '' && $request->get('CIUD_NAC') != 'NA') ? trim($getIdcityNac->ID_DIAN) : '',
				'ID_CIUD_UBI'           => trim($city->ID_DIAN),
				'TRAT_DATOS'            => trim($request->get('TRAT_DATOS')),
				'CLIENTE_WEB'           => $clienteWeb,
				'USUARIO_CREACION'      => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $assessorCode
			];

			$leadOportudata->updateOrCreate(['CEDULA' => trim($request->get('CEDULA'))], $dataOportudata)->save();
			$this->customerCellPhoneInterface->validateCellPhoneCredit($request);

			return [
				'identificationNumber'  => trim($request->get('CEDULA')),
				'tipoDoc'               => trim($request->get('TIPO_DOC')),
				'tipoCreacion'          => $request->tipoCliente,
				'lastName'              => $this->customerInterface->getcustomerFirstLastName($request->get('APELLIDOS')),
				'dateExpIdentification' => $this->toolsInterface->getConfrontaDateFormat($request->get('FEC_EXP'))
			];
		}
	}

	public function execConsultasleadAsesores($identificationNumber)
	{
		$oportudataLead         = $this->customerInterface->findCustomerByIdForFosyga($identificationNumber);
		$dateExpIdentification  = explode("-", $oportudataLead->FEC_EXP);
		$dateExpIdentification  = $dateExpIdentification[2] . "/" . $dateExpIdentification[1] . "/" . $dateExpIdentification[0];
		$this->daysToIncrement  = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$consultasRegistraduria = $this->registraduriaInterface->doFosygaRegistraduriaConsult($oportudataLead, $this->daysToIncrement);

		if ($consultasRegistraduria == "-1") {
			$oportudataLead->ESTADO = 'NEGADO';
			$oportudataLead->save();

			$dataIntention = [
				'CEDULA'           => $identificationNumber,
				'ASESOR'           => $oportudataLead->USUARIO_ACTUALIZACION,
				'ESTADO_INTENCION' => 1,
				'CREDIT_DECISION'  => 'Negado',
				'ID_DEF'           => 2
			];

			$customerIntention                   = $this->intentionInterface->checkIfHasIntention($dataIntention,  $this->daysToIncrement);
			$customerIntention->ASESOR           = $dataIntention['ASESOR'];
			$customerIntention->ESTADO_INTENCION = $dataIntention['ESTADO_INTENCION'];
			$customerIntention->ID_DEF           = $dataIntention['ID_DEF'];
			$customerIntention->CREDIT_DECISION  = $dataIntention['CREDIT_DECISION'];
			$customerIntention->save();

			return ['resp' => $consultasRegistraduria, 'infoLead' => $customerIntention->definition];
		}

		if ($consultasRegistraduria == "-3") {
			return ['resp' => $consultasRegistraduria];
		}

		$consultaComercial = $this->commercialConsultationInterface->doConsultaComercial($oportudataLead, $this->daysToIncrement);

		if ($consultaComercial == 0) {
			$oportudataLead->ESTADO = 'SIN COMERCIAL';
			$oportudataLead->save();

			$dataIntention = [
				'CEDULA'           => $identificationNumber,
				'ASESOR'           => $oportudataLead->USUARIO_ACTUALIZACION,
				'ESTADO_INTENCION' => 3,
				'CREDIT_DECISION'  => 'Sin Comercial',
				'ID_DEF'           => 5
			];

			$customerIntention                   = $this->intentionInterface->checkIfHasIntention($dataIntention,  $this->daysToIncrement);
			$customerIntention->ASESOR           = $dataIntention['ASESOR'];
			$customerIntention->ESTADO_INTENCION = $dataIntention['ESTADO_INTENCION'];
			$customerIntention->ID_DEF           = $dataIntention['ID_DEF'];
			$customerIntention->CREDIT_DECISION  = $dataIntention['CREDIT_DECISION'];
			$customerIntention->save();

			return $policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0,
				'resp'                 => -5
			];
		} else {
			$this->fosygaInterface->doFosygaConsult($oportudataLead, $this->daysToIncrement);

			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0
			];

			$policyCredit = $this->validatePolicyAssessors($oportudataLead);
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

	private function validatePolicyAssessors($customer)
	{
		$customer                  = $this->customerInterface->findCustomerById($customer->CEDULA);
		$intentionData             = ['CEDULA' => $customer->CEDULA, 'ASESOR' => $customer->USUARIO_ACTUALIZACION];
		$this->daysToIncrement     = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$customerIntention         = $this->intentionInterface->checkIfHasIntention($intentionData,  $this->daysToIncrement);
		$customerIntention->ASESOR = $intentionData['ASESOR'];

		//3.1 Estado de documento
		$estadoCliente = 'PREAPROBADO';
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultationPolicy($customer->CEDULA);
		if (!empty($getDataRegistraduria)) {
			if ($getDataRegistraduria->fuenteFallo == 'SI') {
				$fuenteFallo = 'true';
			} elseif (!empty($getDataRegistraduria->estado)) {
				if ($getDataRegistraduria->estado != 'VIGENTE') {
					$customer->ESTADO  = 'NEGADO';
					$customer->save();
					$customerIntention->ID_DEF            =  '4';
					$customerIntention->ESTADO_INTENCION  = '1';
					$customerIntention->CREDIT_DECISION = 'Negado';
					$customerIntention->save();
					return ['resp' => 'false'];
				}
			} else {
				$fuenteFallo = "true";
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 5	Puntaje y 3.4 Calificacion Score
		if ($customer->latestCifinScore) {
			$lastCifinScore = $customer->latestCifinScore;
			$customerScore  = $lastCifinScore->score;
		} else {
			$this->commercialConsultationInterface->execConsultaSaveXml($customer->CEDULA);
			$customer        = $this->customerInterface->findCustomerById($customer->CEDULA);
			$lastCifinScore  = $customer->latestCifinScore;
			$customerScore   = $lastCifinScore->score;
		}

		$customerStatusDenied                 = false;
		$idDef                                = "";
		$perfilCrediticio                     = $this->policyInterface->CheckScorePolicy($customerScore);
		$customerStatusDenied                 = $perfilCrediticio['customerStatusDenied'];
		$idDef                                = $perfilCrediticio['idDef'];
		$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio['perfilCrediticio'];

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO 7') {
			$customer->ESTADO = 'NEGADO';
			$customer->save();
			$customerIntention->ID_DEF            = $idDef;
			$customerIntention->ESTADO_INTENCION  = '1';
			$customerIntention->CREDIT_DECISION   = 'Negado';
			$customerIntention->save();
			return ['resp' => "false"];
		}

		// 3.3 Estado de obligaciones
		$obligaciones         = $this->doArreas($customer, $lastCifinScore, $customerStatusDenied, $idDef);
		$customerStatusDenied = $obligaciones['customerStatusDenied'];
		$idDef                = $obligaciones['idDef'];
		$mora                 = $obligaciones['arreas'];
		$customerIntention->ESTADO_OBLIGACIONES = $obligaciones['arreas'];

		$realDoubtful = $this->cifinRealArrearsInterface->validateRealDoubtful($customer->CEDULA, $lastCifinScore->scoconsul, $customerStatusDenied, $idDef, $mora);
		$customerStatusDenied                   = $realDoubtful['customerStatusDenied'];
		$idDef                                  = $realDoubtful['idDef'];
		$mora = $realDoubtful['doubtful'];
		$customerIntention->ESTADO_OBLIGACIONES = $realDoubtful['doubtful'];

		$finDoubtful = $this->CifinFinancialArrearsInterface->validateFinDoubtful($customer->CEDULA, $lastCifinScore->scoconsul, $customerStatusDenied, $idDef, $mora);
		$customerStatusDenied                   = $finDoubtful['customerStatusDenied'];
		$idDef                                  = $finDoubtful['idDef'];
		$customerIntention->ESTADO_OBLIGACIONES = $finDoubtful['doubtful'];

		//3.5 Historial de Crédito
		$customerIntention->HISTORIAL_CREDITO = $this->getHistorialCrediticio($customer->CEDULA);
		$customerIntention->TIPO_CLIENTE = 'NUEVO';

		//Politica de Edad
		$edad                    = $this->policyInterface->validateCustomerAge($customer, $customerStatusDenied, $customerIntention->TIPO_CLIENTE, $idDef);
		$customerStatusDenied    = $edad['customerStatusDenied'];
		$idDef                   = $edad['idDef'];
		$customerIntention->EDAD = $edad['edad'];

		//Politica tiempo en labor
		$labor                           = $this->policyInterface->validateLabourTime($customer, $customerStatusDenied, $idDef);
		$customerStatusDenied            = $labor['customerStatusDenied'];
		$idDef                           = $labor['idDef'];
		$customerIntention->TIEMPO_LABOR = $labor['labor'];

		$customerIntention->INSPECCION_OCULAR = $this->policyInterface->validaOccularInspection($customer, $customerIntention);
		$customerIntention->ZONA_RIESGO       = $this->subsidiaryInterface->getSubsidiaryRiskZone($customer->SUC)->ZONA;

		// 3.6 Tarjeta Black
		$aprobado = false;
		$blackCard = false;
		if ($this->policyInterface->tipoAConHistorial($customerIntention)) {
			$blackCard = $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($customer->CEDULA);
			$aprobado = $blackCard;
		}

		$tarjeta              = '';
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;

		if ($blackCard) {
			$tarjetaBlack         = new Black;
			$tarjeta              = $tarjetaBlack->getName();
			$quotaApprovedProduct = $tarjetaBlack->getQuotaApprovedProduct();
			$quotaApprovedAdvance = $tarjetaBlack->getQuotaApprovedAdvance();
		}

		// 3.7 Tarjeta Gray
		if ($this->policyInterface->tipoAConHistorial($customerIntention) && $blackCard == false) {
			if ($this->policyInterface->pensionadoOEmpleado($customer)) {
				$aprobado             = true;
				$tarjetaGray          = new Gray;
				$tarjeta              = $tarjetaGray->getName();
				$quotaApprovedProduct = $tarjetaGray->getQuotaApprovedProduct();
				$quotaApprovedAdvance = $tarjetaGray->getQuotaApprovedAdvance();
			}
		}

		$idDef = $this->creditCardInterface->validateCreditCardStatus($aprobado, $customer, $customerIntention, $idDef);

		if ($aprobado == false && $customerIntention->PERFIL_CREDITICIO == 'TIPO A' && $customerStatusDenied == false && $customer->ACTIVIDAD != 'SOLDADO-MILITAR-POLICÍA') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($customerIntention->HISTORIAL_CREDITO == 1) {
					$customerIntention->ID_DEF  = '17';
				} else {
					$customerIntention->ID_DEF =  '18';
				}
			} else {
				$customerIntention->ID_DEF  = '15';
			}
			$customer->ESTADO                    = 'PREAPROBADO';
			$tarjeta                             = "Crédito Tradicional";
			$customerIntention->TARJETA          = $tarjeta;
			$customerIntention->ESTADO_INTENCION = '2';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "-2"];
		}

		if ($customerStatusDenied == true) {
			$customer->ESTADO                    = 'NEGADO';
			$customerIntention->ID_DEF           = $idDef;
			$customerIntention->ESTADO_INTENCION = '1';
			$customerIntention->CREDIT_DECISION  = 'Negado';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "false"];
		}

		// 2. WS Fosyga
		$fuenteFallo = "false";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultationPolicy($customer->CEDULA);
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
		$customerIntention->TIPO_5_ESPECiAL = $this->policyInterface->validateTipoEspecial(
			$customerIntention->PERFIL_CREDITICIO,
			$customer->ACTIVIDAD,
			$statusAfiliationCustomer
		);

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

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO A') {
			if ($statusAfiliationCustomer == true) {
				if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES') {
					$customer->ESTADO = 'PREAPROBADO';
					$customer->save();
					$customerIntention->TARJETA =  $tarjeta;
					if ($idDef == 25  || $idDef == 26) {
						$customerIntention->ID_DEF =  $idDef;
					} else {
						$customerIntention->ID_DEF =  '14';
					}
					$customerIntention->ESTADO_INTENCION  = '2';
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo,
						'ID_DEF'               => $idDef
					];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					if ($idDef == 25  || $idDef == 26) {
						$customerIntention->ID_DEF =  $idDef;
					} else {
						$customerIntention->ID_DEF  = '15';
					}
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo,
						'ID_DEF'               => $idDef
					];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					if ($idDef == 25  || $idDef == 26) {
						$customerIntention->ID_DEF =  $idDef;
					} else {
						$customerIntention->ID_DEF  = '16';
					}
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo,
						'ID_DEF'               => $idDef
					];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($customerIntention->HISTORIAL_CREDITO == 1) {
						$customer->ESTADO           = 'PREAPROBADO';
						$customerIntention->TARJETA = $tarjeta;
						if ($idDef == 25  || $idDef == 26) {
							$customerIntention->ID_DEF =  $idDef;
						} else {
							$customerIntention->ID_DEF  = '17';
						}
						$customerIntention->ESTADO_INTENCION  = '2';
						$customer->save();
						$customerIntention->save();
						return [
							'resp'                 => "true",
							'quotaApprovedProduct' => $quotaApprovedProduct,
							'quotaApprovedAdvance' => $quotaApprovedAdvance,
							'estadoCliente'        => $estadoCliente,
							'fuenteFallo'          => $fuenteFallo,
							'ID_DEF'               => $idDef
						];
					} else {
						$customer->ESTADO = 'PREAPROBADO';
						$customer->save();
						$customerIntention->TARJETA          = 'Crédito Tradicional';
						$customerIntention->ID_DEF           = '18';
						$customerIntention->ESTADO_INTENCION = '2';
						$customerIntention->save();
						return ['resp' => "-2"];
					}
				}
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '18';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO B') {
			if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				if ($idDef == 25  || $idDef == 26) {
					$customerIntention->ID_DEF =  $idDef;
				} else {
					$customerIntention->ID_DEF =  '19';
				}
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2", 'ID_DEF' => $idDef];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				if ($idDef == 25  || $idDef == 26) {
					$customerIntention->ID_DEF =  $idDef;
				} else {
					$customerIntention->ID_DEF =  '20';
				}
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2", 'ID_DEF' => $idDef];
			}
		}

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO C') {
			if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '21';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '22';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO D') {
			if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES' && $customerScore >= 275) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '23';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerIntention->TARJETA          = '';
				$customerIntention->ID_DEF           = '24';
				$customerIntention->ESTADO_INTENCION = '1';
				$customerIntention->CREDIT_DECISION  = 'Negado';
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		if ($customerIntention->PERFIL_CREDITICIO == 'TIPO 5') {
			if ($customerIntention->TIPO_5_ESPECiAL == 1) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '12';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
			if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '11';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '13';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
		}

		$customerIntention->save();
		$customer->save();
		return ['resp' => "true"];
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
		return response()->json([
			'ubicationsCities' => $resp,
			'cities' => $resp2,
			'banks' => $resp3,
			'professions' => $professions->toArray(),
			'kinships' => $kinships->toArray()
		]);
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

	public function decisionCreditCard(Request $request, $identificationNumber)
	{
		$customer                           = $this->customerInterface->findCustomerById($identificationNumber);
		$customerIntention                  = $customer->latestIntention;
		$customerIntention->CREDIT_DECISION = 'Tarjeta Oportuya';
		$customerIntention->save();
		$dataPolicy = $request['policyResult'];
		$policyCredit = [
			'quotaApprovedProduct' => $dataPolicy['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $dataPolicy['quotaApprovedAdvance'],
			'resp' => 'true'
		];

		$dataLead = $request['lead'];
		$data = [
			'NOM_REFPER' => (isset($dataLead['NOM_REFPER']) && $dataLead['NOM_REFPER'] != '') ? $dataLead['NOM_REFPER'] : '',
			'DIR_REFPER' => (isset($dataLead['DIR_REFPER']) && $dataLead['DIR_REFPER'] != '') ? $dataLead['DIR_REFPER'] : '',
			'TEL_REFPER' => (isset($dataLead['TEL_REFPER']) && $dataLead['TEL_REFPER'] != '') ? $dataLead['TEL_REFPER'] : '',
			'NOM_REFPE2' => (isset($dataLead['NOM_REFPE2']) && $dataLead['NOM_REFPE2'] != '') ? $dataLead['NOM_REFPE2'] : '',
			'DIR_REFPE2' => (isset($dataLead['DIR_REFPE2']) && $dataLead['DIR_REFPE2'] != '') ? $dataLead['DIR_REFPE2'] : '',
			'TEL_REFPE2' => (isset($dataLead['TEL_REFPE2']) && $dataLead['TEL_REFPE2'] != '') ? $dataLead['TEL_REFPE2'] : '',
			'NOM_REFFAM' => (isset($dataLead['NOM_REFFAM']) && $dataLead['NOM_REFFAM'] != '') ? $dataLead['NOM_REFFAM'] : '',
			'DIR_REFFAM' => (isset($dataLead['DIR_REFFAM']) && $dataLead['DIR_REFFAM'] != '') ? $dataLead['DIR_REFFAM'] : '',
			'TEL_REFFAM' => (isset($dataLead['TEL_REFFAM']) && $dataLead['TEL_REFFAM'] != '') ? $dataLead['TEL_REFFAM'] : '',
			'PARENTESCO' => (isset($dataLead['PARENTESCO']) && $dataLead['PARENTESCO'] != '') ? $dataLead['PARENTESCO'] : '',
			'NOM_REFFA2' => (isset($dataLead['NOM_REFFA2']) && $dataLead['NOM_REFFA2'] != '') ? $dataLead['NOM_REFFA2'] : '',
			'DIR_REFFA2' => (isset($dataLead['DIR_REFFA2']) && $dataLead['DIR_REFFA2'] != '') ? $dataLead['DIR_REFFA2'] : '',
			'TEL_REFFA2' => (isset($dataLead['TEL_REFFA2']) && $dataLead['TEL_REFFA2'] != '') ? $dataLead['TEL_REFFA2'] : '',
			'PARENTESC2' => (isset($dataLead['PARENTESC2']) && $dataLead['PARENTESC2'] != '') ? $dataLead['PARENTESC2'] : '',
			'BAR_REFPER' => '',
			'CIU_REFPER' => '',
			'BAR_REFPE2' => '',
			'CIU_REFPE2' => '',
			'BAR_REFFAM' => '',
			'BAR_REFFA2' => '',
			'CON_CLI1'   => '',
			'CON_CLI2'   => '',
			'CON_CLI3'   => '',
			'CON_CLI4'   => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		$lastName    = $this->customerInterface->getcustomerFirstLastName($customer->APELLIDOS);
		$resultUbica = $this->doUbica($customer, $lastName);
		$estadoSolic = 1;

		if ($resultUbica == 0) {
			$fechaExpIdentification = $this->toolsInterface->getConfrontaDateFormat($customer->FEC_EXP);
			$confronta = $this->webServiceInterface->execConsultaConfronta($customer, $fechaExpIdentification, $lastName);
			if ($confronta == 1) {
				$form = $this->toolsInterface->getFormConfronta($customer->CEDULA);
				if (empty($form)) {
					$estadoSolic = 1;
				} else {
					return [
						'form' => $form,
						'resp' => 'confronta'
					];
				}
			} else {
				$estadoSolic = 1;
			}
		} else {
			$estadoSolic = 19;
		}

		$estadoSolic = (isset($dataPolicy['policy']['fuenteFallo']) && $dataPolicy['policy']['fuenteFallo'] == 'true') ? 1 : $estadoSolic;
		$debtor = new DebtorInsuranceOportuya;
		$debtor->CEDULA = $identificationNumber;
		$debtor->save();
		return $this->addSolicCredit($customer, $policyCredit, $estadoSolic, $data);
	}

	public function decisionHasCreditCard(Request $request, $identificationNumber)
	{
		$customer                    = $this->customerInterface->findCustomerById($identificationNumber);
		$intention                   = $customer->latestIntention;
		$intention->CREDIT_DECISION  = 'Tarjeta Oportuya';
		$intention->ESTADO_INTENCION = 4;
		$intention->save();

		$policyCredit = [
			'quotaApprovedProduct' => 0,
			'quotaApprovedAdvance' => 0,
			'resp' => 'true'
		];

		$dataLead = $request['lead'];
		$data = [
			'NOM_REFPER' => (isset($dataLead['NOM_REFPER']) && $dataLead['NOM_REFPER'] != '') ? $dataLead['NOM_REFPER'] : '',
			'DIR_REFPER' => (isset($dataLead['DIR_REFPER']) && $dataLead['DIR_REFPER'] != '') ? $dataLead['DIR_REFPER'] : '',
			'TEL_REFPER' => (isset($dataLead['TEL_REFPER']) && $dataLead['TEL_REFPER'] != '') ? $dataLead['TEL_REFPER'] : '',
			'NOM_REFPE2' => (isset($dataLead['NOM_REFPE2']) && $dataLead['NOM_REFPE2'] != '') ? $dataLead['NOM_REFPE2'] : '',
			'DIR_REFPE2' => (isset($dataLead['DIR_REFPE2']) && $dataLead['DIR_REFPE2'] != '') ? $dataLead['DIR_REFPE2'] : '',
			'TEL_REFPE2' => (isset($dataLead['TEL_REFPE2']) && $dataLead['TEL_REFPE2'] != '') ? $dataLead['TEL_REFPE2'] : '',
			'NOM_REFFAM' => (isset($dataLead['NOM_REFFAM']) && $dataLead['NOM_REFFAM'] != '') ? $dataLead['NOM_REFFAM'] : '',
			'DIR_REFFAM' => (isset($dataLead['DIR_REFFAM']) && $dataLead['DIR_REFFAM'] != '') ? $dataLead['DIR_REFFAM'] : '',
			'TEL_REFFAM' => (isset($dataLead['TEL_REFFAM']) && $dataLead['TEL_REFFAM'] != '') ? $dataLead['TEL_REFFAM'] : '',
			'PARENTESCO' => (isset($dataLead['PARENTESCO']) && $dataLead['PARENTESCO'] != '') ? $dataLead['PARENTESCO'] : '',
			'NOM_REFFA2' => (isset($dataLead['NOM_REFFA2']) && $dataLead['NOM_REFFA2'] != '') ? $dataLead['NOM_REFFA2'] : '',
			'DIR_REFFA2' => (isset($dataLead['DIR_REFFA2']) && $dataLead['DIR_REFFA2'] != '') ? $dataLead['DIR_REFFA2'] : '',
			'TEL_REFFA2' => (isset($dataLead['TEL_REFFA2']) && $dataLead['TEL_REFFA2'] != '') ? $dataLead['TEL_REFFA2'] : '',
			'PARENTESC2' => (isset($dataLead['PARENTESC2']) && $dataLead['PARENTESC2'] != '') ? $dataLead['PARENTESC2'] : '',
			'BAR_REFPER' => '',
			'CIU_REFPER' => '',
			'BAR_REFPE2' => '',
			'CIU_REFPE2' => '',
			'BAR_REFFAM' => '',
			'BAR_REFFA2' => '',
			'CON_CLI1'   => '',
			'CON_CLI2'   => '',
			'CON_CLI3'   => '',
			'CON_CLI4'   => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		$debtor = new DebtorInsuranceOportuya;
		$debtor->CEDULA = $identificationNumber;
		$debtor->save();

		return $this->addSolicCredit($customer, $policyCredit, 1, $data);
	}

	public function validateFormConfronta(Request $request)
	{
		$confronta = $request->confronta;
		foreach ($confronta as $pregunta) {
			$cedula       = $pregunta['cedula'];
			$cuestionario = $pregunta['cuestionario'];
			$consec       = $pregunta['consec'];
		}

		$this->confrontaSelectinterface->insertCustomerConfronta($confronta);
		$dataEvaluar = $this->confrontaSelectinterface->getAllConfrontaSelect($cedula, $cuestionario);
		$this->webServiceInterface->execEvaluarConfronta($cuestionario, $dataEvaluar);

		$customerIntention  = $this->intentionInterface->findLatestCustomerIntentionByCedula($cedula);
		$policyCredit       = $this->intentionInterface->defineConfrontaCardValues($customerIntention->TARJETA);
		$getResultConfronta = $this->confrontaResultInterface->getCustomerConfrontaResult($consec, $cedula);
		$estadoSolic        = $this->intentionInterface->getConfrontaIntentionStatus($getResultConfronta[0]->cod_resp);
		$leadInfo           = $request->leadInfo;
		$leadInfo['identificationNumber'] = (isset($leadInfo['identificationNumber'])) ? $leadInfo['identificationNumber'] : $leadInfo['CEDULA'];
		$dataDatosCliente = [
			'NOM_REFPER' => $leadInfo['NOM_REFPER'],
			'DIR_REFPER' => $leadInfo['DIR_REFPER'],
			'TEL_REFPER' => $leadInfo['TEL_REFPER'],
			'NOM_REFPE2' => $leadInfo['NOM_REFPE2'],
			'DIR_REFPE2' => $leadInfo['DIR_REFPE2'],
			'TEL_REFPE2' => $leadInfo['TEL_REFPE2'],
			'NOM_REFFAM' => $leadInfo['NOM_REFFAM'],
			'TEL_REFFAM' => $leadInfo['TEL_REFFAM'],
			'DIR_REFFAM' => $leadInfo['DIR_REFFAM'],
			'PARENTESCO' => $leadInfo['PARENTESCO'],
			'NOM_REFFA2' => $leadInfo['NOM_REFFA2'],
			'DIR_REFFA2' => $leadInfo['DIR_REFFA2'],
			'TEL_REFFA2' => $leadInfo['TEL_REFFA2'],
			'PARENTESC2' => $leadInfo['PARENTESC2'],
		];
		$customer = $this->customerInterface->findCustomerById($leadInfo['identificationNumber']);
		$solicCredit = $this->addSolicCredit($customer, $policyCredit, $estadoSolic, $dataDatosCliente);

		return response()->json([
			'data'            => true,
			'quota'           => $solicCredit['quotaApprovedProduct'],
			'numSolic'        => $solicCredit['infoLead']->numSolic,
			'textPreaprobado' => 2,
			'quotaAdvance'    => $solicCredit['quotaApprovedAdvance'],
			'estado'          => ($estadoSolic == 19) ? "APROBADO" : "PREAPROBADO"
		]);
	}

	public function decisionTraditionalCredit(Request $request, $identificationNumber)
	{
		$customer              = $this->customerInterface->findCustomerById($identificationNumber);
		$customer->TIPOCLIENTE = 'NUEVO';
		$customer->SUBTIPO     = 'NUEVO';
		$customer->save();
		$intention = $customer->latestIntention;
		$intention->CREDIT_DECISION = 'Tradicional';
		$intention->save();

		$policyCredit = [
			'quotaApprovedProduct' => 0,
			'quotaApprovedAdvance' => 0,
			'resp'                 => 'true'
		];

		$data = [
			'NOM_REFPER' => (isset($request['NOM_REFPER']) && $request['NOM_REFPER'] != '') ? $request['NOM_REFPER'] : '',
			'DIR_REFPER' => (isset($request['DIR_REFPER']) && $request['DIR_REFPER'] != '') ? $request['DIR_REFPER'] : '',
			'TEL_REFPER' => (isset($request['TEL_REFPER']) && $request['TEL_REFPER'] != '') ? $request['TEL_REFPER'] : '',
			'NOM_REFPE2' => (isset($request['NOM_REFPE2']) && $request['NOM_REFPE2'] != '') ? $request['NOM_REFPE2'] : '',
			'DIR_REFPE2' => (isset($request['DIR_REFPE2']) && $request['DIR_REFPE2'] != '') ? $request['DIR_REFPE2'] : '',
			'TEL_REFPE2' => (isset($request['TEL_REFPE2']) && $request['TEL_REFPE2'] != '') ? $request['TEL_REFPE2'] : '',
			'NOM_REFFAM' => (isset($request['NOM_REFFAM']) && $request['NOM_REFFAM'] != '') ? $request['NOM_REFFAM'] : '',
			'DIR_REFFAM' => (isset($request['DIR_REFFAM']) && $request['DIR_REFFAM'] != '') ? $request['DIR_REFFAM'] : '',
			'TEL_REFFAM' => (isset($request['TEL_REFFAM']) && $request['TEL_REFFAM'] != '') ? $request['TEL_REFFAM'] : '',
			'PARENTESCO' => (isset($request['PARENTESCO']) && $request['PARENTESCO'] != '') ? $request['PARENTESCO'] : '',
			'NOM_REFFA2' => (isset($request['NOM_REFFA2']) && $request['NOM_REFFA2'] != '') ? $request['NOM_REFFA2'] : '',
			'DIR_REFFA2' => (isset($request['DIR_REFFA2']) && $request['DIR_REFFA2'] != '') ? $request['DIR_REFFA2'] : '',
			'TEL_REFFA2' => (isset($request['TEL_REFFA2']) && $request['TEL_REFFA2'] != '') ? $request['TEL_REFFA2'] : '',
			'PARENTESC2' => (isset($request['PARENTESC2']) && $request['PARENTESC2'] != '') ? $request['PARENTESC2'] : '',
			'BAR_REFPER' => '',
			'CIU_REFPER' => '',
			'BAR_REFPE2' => '',
			'CIU_REFPE2' => '',
			'BAR_REFFAM' => '',
			'BAR_REFFA2' => '',
			'CON_CLI1'   => '',
			'CON_CLI2'   => '',
			'CON_CLI3'   => '',
			'CON_CLI4'   => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		return $this->addSolicCredit($customer, $policyCredit, 1, $data);
	}

	public function getEconomicsSectors()
	{
		return $this->economicSectorInterface->listEconomicSector();
	}

	public function getFormVentaContado()
	{
		if (Auth::user()) {
			return view('assessors.forms.crearCliente');
		} else {
			return view('assessors.login');
		}
	}

	public function getInfoLead($identificationNumber)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);

		return $customer;
	}

	public function dashboard(Request $request)
	{
		$assessor   = auth()->user()->email;
		$to         = Carbon::now();
		$from       = Carbon::now()->startOfMonth();
		$subsidiary = '';
		$estadosAssessors        = $this->factoryRequestInterface->countAssessorFactoryRequestStatuses($from, $to, $assessor);
		$webAssessorsCounts      = $this->factoryRequestInterface->countWebAssessorFactory($from, $to, $assessor);
		$factoryAssessorsTotal   = $this->factoryRequestInterface->getAssessorFactoryTotal($from, $to, $assessor);
		$estadosAprobados        = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, array(19, 20));
		$estadosNegados          = $this->factoryRequestInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, 16);
		$estadosDesistidos       = $this->factoryRequestInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, 15);
		$estadosPendientes       = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20));
		$valuesEstadosAprobados  = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
		$valuesEstadosNegados    = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
		$valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
		$valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20), $subsidiary);

		if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
			$valuesEstadosAprobados  = $this->factoryRequestInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20), $subsidiary);
			$valuesEstadosNegados    = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16, $subsidiary);
			$valuesEstadosDesistidos = $this->factoryRequestInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15, $subsidiary);
			$valuesEstadosPendientes = $this->factoryRequestInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20), $subsidiary);
		}

		if (request()->has('from')) {
			$estadosAssessors      = $this->factoryRequestInterface->countAssessorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $assessor);
			$webAssessorsCounts    = $this->factoryRequestInterface->countWebAssessorFactory(request()->input('from'), request()->input('to'), $assessor);
			$factoryAssessorsTotal = $this->factoryRequestInterface->getAssessorFactoryTotal(request()->input('from'), request()->input('to'), $assessor);
			$estadosAprobados      = $this->factoryRequestInterface->countFactoryRequestsStatusesAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20));
			$estadosNegados        = $this->factoryRequestInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16);
			$estadosDesistidos     = $this->factoryRequestInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15);
			$estadosPendientes     = $this->factoryRequestInterface->countFactoryRequestsStatusesPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20));
		}

		$valuesEstadosAprobados  = $this->toolsInterface->extractValuesToArray($valuesEstadosAprobados);
		$valuesEstadosNegados    = $this->toolsInterface->extractValuesToArray($valuesEstadosNegados);
		$valuesEstadosDesistidos = $this->toolsInterface->extractValuesToArray($valuesEstadosDesistidos);
		$valuesEstadosPendientes = $this->toolsInterface->extractValuesToArray($valuesEstadosPendientes);
		$estadosAprobados        = $this->toolsInterface->extractValuesToArray($estadosAprobados);
		$estadosNegados          = $this->toolsInterface->extractValuesToArray($estadosNegados);
		$estadosDesistidos       = $this->toolsInterface->extractValuesToArray($estadosDesistidos);
		$estadosPendientes       = $this->toolsInterface->extractValuesToArray($estadosPendientes);

		foreach ($estadosAssessors as $key => $status) {
			if ($estadosAssessors[$key]->factoryRequestStatus) {
				$estadosAssessors[$key]['ESTADO'] =  $estadosAssessors[$key]->factoryRequestStatus->name;
			}
		}

		foreach ($webAssessorsCounts as $key => $status) {
			if ($webAssessorsCounts[$key]->factoryRequestStatus) {
				$webAssessorsCounts[$key]['ESTADO'] =  $webAssessorsCounts[$key]->factoryRequestStatus->name;
			}
		}

		$estadosAssessors     = $estadosAssessors->toArray();
		$webAssessorsCounts   = $webAssessorsCounts->toArray();
		$estadosAssessors     = array_values($estadosAssessors);
		$webAssessorsCounts   = array_values($webAssessorsCounts);
		$statusesAssessors    = [];
		$statusesValues       = [];
		$statusesColors       = [];


		$valuesOfStatusesAprobado = [];
		foreach ($valuesEstadosAprobados as $valuesEstadosAprobado) {
			array_push($valuesOfStatusesAprobado, trim($valuesEstadosAprobado['total']));
		}
		$valuesOfStatusesAprobados = 0;
		foreach ($valuesOfStatusesAprobado as $key => $status) {
			$valuesOfStatusesAprobados +=  $valuesOfStatusesAprobado[$key];
		}

		$valuesOfStatusesNegado = [];
		foreach ($valuesEstadosNegados as $valuesEstadosNegado) {
			array_push($valuesOfStatusesNegado, trim($valuesEstadosNegado['total']));
		}
		$valuesOfStatusesNegados = 0;
		foreach ($valuesOfStatusesNegado as $key => $status) {
			$valuesOfStatusesNegados +=  $valuesOfStatusesNegado[$key];
		}

		$valuesOfStatusesDesistido = [];
		foreach ($valuesEstadosDesistidos as $valuesEstadosDesistido) {
			array_push($valuesOfStatusesDesistido, trim($valuesEstadosDesistido['total']));
		}
		$valuesOfStatusesDesistidos = 0;
		foreach ($valuesOfStatusesDesistido as $key => $status) {
			$valuesOfStatusesDesistidos +=  $valuesOfStatusesDesistido[$key];
		}

		$valuesOfStatusesPendiente = [];
		foreach ($valuesEstadosPendientes as $valuesEstadosPendiente) {
			array_push($valuesOfStatusesPendiente, trim($valuesEstadosPendiente['total']));
		}
		$valuesOfStatusesPendientes = 0;
		foreach ($valuesOfStatusesPendiente as $key => $status) {
			$valuesOfStatusesPendientes +=  $valuesOfStatusesPendiente[$key];
		}

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
			'statusesAssessors'          => $statusesAssessors,
			'statusesValues'             => $statusesValues,
			'statusesColors'             => $statusesColors,
			'webValues'                  => $webValues,
			'webAssessors'               => $webAssessors,
			'totalStatuses'              => array_sum($statusesValues),
			'totalWeb'                   => array_sum($webValues),
			'factoryAssessorsTotal'      => $factoryAssessorsTotal,
			'statusesAprobadosValues'    => $statusesAprobadosValues,
			'statusesNegadoValues'       => $statusesNegadoValues,
			'statusesPendientesValues'   => $statusesPendientesValues,
			'statusesDesistidosValues'   => $statusesDesistidosValues,
			'valuesOfStatusesAprobados'  => $valuesOfStatusesAprobados,
			'valuesOfStatusesNegados'    => $valuesOfStatusesNegados,
			'valuesOfStatusesDesistidos' => $valuesOfStatusesDesistidos,
			'valuesOfStatusesPendientes' => $valuesOfStatusesPendientes
		]);
	}
}
//1451