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
use App\Entities\DebtorInsurances\DebtorInsurance;
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
use App\Entities\CliCels\Repositories\Interfaces\CliCelRepositoryInterface;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;

class assessorsController extends Controller
{
	private $kinshipInterface, $subsidiaryInterface, $ubicaInterface;
	private $customerInterface, $toolsInterface, $factoryInterface, $temporaryCustomerInterface;
	private $daysToIncrement, $consultationValidityInterface, $AnalisisInterface;
	private $fosygaInterface, $registraduriaInterface, $webServiceInterface;
	private $commercialConsultationInterface, $customerProfessionInterface;
	private $creditCardInterface, $cifinRealArrearsInterface;
	private $UpToDateFinancialCifinInterface, $CifinFinancialArrearsInterface;
	private $cifinScoreInterface, $intentionInterface, $extintFinancialCifinInterface;
	private $UpToDateRealCifinInterface, $extinctRealCifinInterface, $datosClienteInterface;
	private $codebtorInterface, $secondCodebtorInterface, $assessorInterface;
	private $cityInterface, $cliCelInterface, $policyInterface, $OportuyaTurnInterface;
	private $confrontaSelectinterface, $ubicaMailInterface, $ubicaCellPhoneInterfac, $confrontaResultInterface;
	private $userInterface;

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
		CliCelRepositoryInterface $cliCelRepositoryInterface,
		PolicyRepositoryInterface $policyRepositoryInterface,
		OportuyaTurnRepositoryInterface $oportuyaTurnRepositoryInterface,
		DatosClienteRepositoryInterface $datosClienteRepositoryInterface,
		FosygaTempRepositoryInterface $fosygaTempRepositoryInterface,
		AnalisisRepositoryInterface $analisisRepositoryInterface,
		ConfrontaSelectRepositoryInterface $confrontaSelectRepositoryInterface,
		UbicaEmailRepositoryInterface $ubicaEmailRepositoryInterface,
		UbicaCellPhoneRepositoryInterface $ubicaCellPhoneRepositoryInterface,
		ConfrontaResultRepositoryInterface $confrontaResultRepositoryInterface,
		UserRepositoryInterface $userRepositoryInterface
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
		$this->ubicaInterface                  = $ubicaRepositoryInterface;
		$this->ruafInterface                   = $ruafRepositoryInterface;
		$this->cityInterface                   = $cityRepositoryInterface;
		$this->cliCelInterface                 = $cliCelRepositoryInterface;
		$this->policyInterface                 = $policyRepositoryInterface;
		$this->OportuyaTurnInterface           = $oportuyaTurnRepositoryInterface;
		$this->datosClienteInterface           = $datosClienteRepositoryInterface;
		$this->fosygaTempInterface             = $fosygaTempRepositoryInterface;
		$this->AnalisisInterface               = $analisisRepositoryInterface;
		$this->confrontaSelectinterface        = $confrontaSelectRepositoryInterface;
		$this->ubicaMailInterface              = $ubicaEmailRepositoryInterface;
		$this->ubicaCellPhoneInterfac          = $ubicaCellPhoneRepositoryInterface;
		$this->confrontaResultInterface        = $confrontaResultRepositoryInterface;
		$this->userInterface                   = $userRepositoryInterface;
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$to = Carbon::now();
		$from = Carbon::now()->startOfMonth();
		$assessor = auth()->user()->email;
		$subsidiary = '';
		$skip         = $this->toolsInterface->getSkip($request->input('skip'));
		$list         = $this->factoryInterface->listFactoryAssessors($skip * 30, $assessor);
		$listCount = $this->factoryInterface->listFactoryAssessorsTotal($from, $to, $assessor);
		$estadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
		$estadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
		$estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
		$estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20), $subsidiary);

		if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
			$estadosAprobados = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20), $subsidiary);
			$estadosNegados = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16, $subsidiary);
			$estadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15, $subsidiary);
			$estadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20), $subsidiary);
		}
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
		$statuses = FactoryRequestStatus::select('id', 'name')->orderBy('name', 'ASC')->get();

		return view('assessors.assessors.list', [
			'factoryRequests'                => $list,
			'optionsRoutes'                  => (request()->segment(2)),
			'headers'                        => ['Cliente', 'Solicitud', 'Asesor', 'Sucursal', 'Fecha', 'Estado', 'Total'],
			'listCount'                      => $listCount,
			'skip'                           => $skip,
			'factoryRequestsTotal'           => $factoryRequestsTotal,
			'statusesAprobadosValues'         => $statusesAprobadosValues,
			'statusesNegadosValues'        => $statusesNegadosValues,
			'statusesDesistidosValues'        => $statusesDesistidosValues,
			'statusesPendientesValues'     => $statusesPendientesValues,
			'statuses'                     => $statuses

		]);
	}

	public function store(Request $request)
	{
		$assessorCode = $this->userInterface->getAssessorCode();
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
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

		if ($this->cliCelInterface->checkIfPhoneNumExists(trim($request->get('CEDULA')), trim($request->get('TELFIJO'))) == 0) {
			$data = [
				'IDENTI'  => trim($request->get('CEDULA')),
				'NUM'     => trim($request->get('TELFIJO')),
				'TIPO'    => 'FIJO',
				'CEL_VAL' => 0,
				'FECHA'   => date("Y-m-d H:i:s")
			];
			$this->cliCelInterface->createCliCel($data);
		}

		$search = ['ñ', 'á', 'é', 'í', 'ó', 'ú'];
		$replace = ['Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'];
		if ($request->tipoCliente == 'CONTADO') {
			$dataOportudata = [
				'TIPO_DOC'    			       => trim($request->get('TIPO_DOC')),
				'CEDULA'      			       => trim($request->get('CEDULA')),
				'FEC_EXP'     			       => '1980-01-01',
				'NOMBRES'   			         => ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'APELLIDOS'   			       => ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'EMAIL'       			       => trim($request->get('EMAIL')),
				'TELFIJO'     			       => ($request->get('TELFIJO') != '') ? trim($request->get('TELFIJO'))  : '0',
				'CELULAR'     			       => trim($request->get('CELULAR')),
				'PROFESION'   			       => 'NO APLICA',
				'PERSONAS'  			         => 0,
				'TIPOV'       			       => '',
				'TIEMPO_VIV'  			       => '',
				'PROPIETARIO' 			       => '',
				'VRARRIENDO'  			       => 0,
				'ESTUDIOS'  			         => '',
				'ESTRATO'     			       => '',
				'SEXO'        			       => trim($request->get('SEXO')),
				'DIRECCION'   			       => ($request->get('DIRECCION') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('DIRECCION')))) : 'NA',
				'VCON_NOM1'   			       => ($request->get('VCON_NOM1') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM1')))) : 'NA',
				'VCON_CED1'   			       => ($request->get('VCON_CED1') != '') ? trim($request->get('VCON_CED1')) : 'NA',
				'VCON_TEL1'   			       => ($request->get('VCON_TEL1') != '') ? trim($request->get('VCON_TEL1')) : 'NA',
				'VCON_NOM2'   			       => ($request->get('VCON_NOM2') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_NOM2')))) : 'NA',
				'VCON_CED2'   			       => ($request->get('VCON_CED2') != '') ? trim($request->get('VCON_CED2')) : 'NA',
				'VCON_TEL2'   			       => ($request->get('VCON_TEL2') != '') ? trim($request->get('VCON_TEL2')) : 'NA',
				'VCON_DIR'   			        => ($request->get('VCON_DIR') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('VCON_DIR')))) : 'NA',
				'TRAT_DATOS'  			       => trim($request->get('TRAT_DATOS')),
				'TIPOCLIENTE' 			       => 'NUEVO',
				'SUBTIPO'     			       => 'NUEVO',
				'FEC_NAC'	  			         => '1900-01-01',
				'EDAD'        			       => 0,
				'CIUD_UBI'    			       => trim($subsidiaryCityName),
				'DEPTO'       			       => trim($city->DEPARTAMENTO),
				'ID_CIUD_UBI' 			       => trim($city->ID_DIAN),
				'ID_CIUD_EXP' 			       => '',
				'MEDIO_PAGO'  			       => 00,
				'CIUD_EXP'    			       => '',
				'ORIGEN'      			       => 'ASESORES-CONTADO',
				'CLIENTE_WEB' 			       => $clienteWeb,
				'SUC'         			       => $sucursal,
				'PASO'        			       => '',
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
				'PLACA' 				            => 'NA',
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
				'EPS_CONYU' 			         => '',
				'CEDULA_C' 				         => '',
				'DIRECCION4'			         => 'NA',
				'TRABAJO_CONYU' 		      => '',
				'CARGO_CONYU' 			       => '',
				'NOMBRE_CONYU' 			      => '',
				'PROFESION_CONYU'		     => '',
				'SALARIO_CONYU' 		      => '',
				'CELULAR_CONYU' 		      => '',
				'STATE' 				            => 'A'
			];

			unset($dataOportudata['tipoCliente']);
			$leadOportudata->updateOrCreate(['CEDULA' => trim($request->get('CEDULA'))], $dataOportudata)->save();
			if ($this->cliCelInterface->checkIfPhoneNumExists(trim($request->get('CEDULA')), trim($request->get('CELULAR'))) == 0) {
				$data = [
					'IDENTI'  => trim($request->get('CEDULA')),
					'NUM'     => trim($request->get('CELULAR')),
					'TIPO'    => 'CEL',
					'CEL_VAL' => 0,
					'FECHA'   => date("Y-m-d H:i:s")
				];
				$this->cliCelInterface->createCliCel($data);
			}
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
				'TIPO_DOC' => trim($request->get('TIPO_DOC')),
				'CEDULA'   => trim($request->get('CEDULA')),
				'APELLIDOS'   			=> ($request->get('APELLIDOS') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('APELLIDOS')))) : 'NA',
				'NOMBRES'   			=> ($request->get('NOMBRES') != '') ? strtoupper(trim(str_replace($search, $replace, $request->get('NOMBRES')))) : 'NA',
				'TIPOCLIENTE' => 'OPORTUYA',
				'SUBTIPO'     => 'WEB',
				'EDAD'        => $age,
				'FEC_EXP'     			=> ($request->get('FEC_EXP') != '') ?  trim($request->get('FEC_EXP')) : '1900-01-01',
				'CIUD_EXP'              => ($request->get('CIUD_EXP') != '') ? trim($getNameCiudadExp->NOMBRE) : '',
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
				'ORIGEN'                => 'ASESORES-CREDITO',
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

			if ($request->get('CEL_VAL') == 0  && $this->cliCelInterface->checkIfPhoneNumExists(trim($request->get('CEDULA')), trim($request->get('CELULAR'))) == 0) {
				$data = [
					'IDENTI'  => trim($request->get('CEDULA')),
					'NUM'     => trim($request->get('CELULAR')),
					'TIPO'    => 'CEL',
					'CEL_VAL' => 1,
					'FECHA'   => date("Y-m-d H:i:s")
				];
				$this->cliCelInterface->createCliCel($data);
			}

			$lastName = explode(" ", trim($request->get('APELLIDOS')));
			$fechaExpIdentification = strtotime(trim($request->get('FEC_EXP')));
			$fechaExpIdentification = date("d/m/Y", $fechaExpIdentification);
			return ['identificationNumber' => trim($request->get('CEDULA')), 'tipoDoc' => trim($request->get('TIPO_DOC')), 'tipoCreacion' => $request->tipoCliente, 'lastName' => $lastName[0], 'dateExpIdentification' => $fechaExpIdentification];
		}
	}

	public function execConsultasleadAsesores($identificationNumber)
	{
		$oportudataLead         = $this->customerInterface->findCustomerByIdForFosyga($identificationNumber);
		$dateExpIdentification  = explode("-", $oportudataLead->FEC_EXP);
		$dateExpIdentification  = $dateExpIdentification[2] . "/" . $dateExpIdentification[1] . "/" . $dateExpIdentification[0];
		$this->daysToIncrement  = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention          = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);
		$assessorCode           = $this->userInterface->getAssessorCode();
		$consultasRegistraduria = $this->registraduriaInterface->doFosygaRegistraduriaConsult($oportudataLead, $this->daysToIncrement);

		if ($consultasRegistraduria == "-1") {
			$oportudataLead->ESTADO = "NEGADO";
			$oportudataLead->save();

			$dataIntention = [
				'CEDULA'           => $identificationNumber,
				'ESTADO_INTENCION' => 1,
				'ID_DEF'           => 2
			];

			if ($lastIntention == "true") {
				$dataIntention =	$this->intentionInterface->createIntention($dataIntention);
			} else {
				$dataIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
				$dataIntention->ASESOR = $assessorCode;
				$dataIntention->ESTADO_INTENCION = 1;
				$dataIntention->ID_DEF = 2;
				$dataIntention->CREDIT_DECISION = 'Negado';
				$dataIntention->save();
			}

			return ['resp' => $consultasRegistraduria, 'infoLead' => $dataIntention->definition];
		}

		if ($consultasRegistraduria == "-3") {
			return ['resp' => $consultasRegistraduria];
		}

		$consultaComercial = $this->commercialConsultationInterface->doConsultaComercial($oportudataLead, $this->daysToIncrement);

		if ($consultaComercial == 0) {
			$oportudataLead->ESTADO = "SIN COMERCIAL";
			$oportudataLead->save();

			$dataIntention = [
				'CEDULA' => $identificationNumber,
				'ESTADO_INTENCION' => 3
			];

			if ($lastIntention == "true") {
				$dataIntention =	$this->intentionInterface->createIntention($dataIntention);
			} else {
				$dataIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
				$dataIntention->ASESOR = $assessorCode;
				$dataIntention->ESTADO_INTENCION = 3;
				$dataIntention->save();
			}

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

	private function validatePolicyCredit_new($identificationNumber)
	{
		if ($this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)) {
			$lastCifinScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber);
			$customerScore = $lastCifinScore->score;
		} else {
			$this->commercialConsultationInterface->ConsultarInformacionComercial($identificationNumber);
			$lastCifinScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber);
			$customerScore = $lastCifinScore->score;
		}

		$customerStatusDenied = false;
		$idDef                = "";
		$customer             = $this->customerInterface->findCustomerById($identificationNumber);
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);
		$assessorCode = $this->userInterface->getAssessorCode();
		$data = ['CEDULA' => $identificationNumber];
		$data['ASESOR'] = $assessorCode;

		if ($lastIntention == "true") {
			$customerIntention =	$this->intentionInterface->createIntention($data);
		} else {
			$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
			$customerIntention->ASESOR = $assessorCode;
			$customerIntention->save();
		}

		// 5	Puntaje y 3.4 Calificacion Score
		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			$perfilCrediticio = $this->policyInterface->CheckScorePolicy($customerScore);

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customerStatusDenied = true;
				$idDef                = '5';
				$perfilCrediticio     = 'TIPO D';
			}

			if ($perfilCrediticio == 'TIPO 7') {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$idDef = '8';
				$customerIntention->ID_DEF            = '8';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->CREDIT_DECISION = 'Negado';
				$customerIntention->save();
				return ['resp' => "false"];
			}

			$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
			$customerIntention->save();
		}

		// 3.3 Estado de obligaciones
		$respValorMoraFinanciero = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($identificationNumber, $lastCifinScore->scoconsul)->sum('finvrmora');
		$respValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber, $lastCifinScore->scoconsul)->sum('rmvrmora');
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

		$customerRealDoubtful = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealDoubtful($identificationNumber, $lastCifinScore->scoconsul);
		$customerFinDoubtful  = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialDoubtful($identificationNumber, $lastCifinScore->scoconsul);
		if ($customerRealDoubtful->isNotEmpty()) {
			if ($customerRealDoubtful[0]->rmsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef                = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		if ($customerFinDoubtful->isNotEmpty()) {
			if ($customerFinDoubtful[0]->finsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef                = "6";
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
		$queryEdad = $customer->EDAD;
		if ($queryEdad == false || empty($queryEdad)) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		if ($queryEdad > 80) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		} else {
			$validateTipoCliente = TRUE;
			if ($customer->ACTIVIDAD == 'PENSIONADO') {
				$validateTipoCliente = FALSE;
				if ($queryEdad >= 18 && $queryEdad <= 80) {
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
				if ($queryEdad >= 18 && $queryEdad <= 75) {
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
				if ($queryEdad >= 18 && $queryEdad <= 70) {
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
		$tarjeta              = '';
		$aprobado             = false;
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1) {
			$aprobado =  $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($identificationNumber);
			if ($aprobado == true) {
				$tarjeta              = "Tarjeta Black";
				$quotaApprovedProduct = 1900000;
				$quotaApprovedAdvance = 500000;
			}
		}

		// 3.7 Tarjeta Gray
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1 && $aprobado == false) {
			if ($customer->ACTIVIDAD == 'PENSIONADO' || $customer->ACTIVIDAD == 'EMPLEADO') {
				$aprobado             = true;
				$tarjeta              = "Tarjeta Gray";
				$quotaApprovedProduct = 1600000;
				$quotaApprovedAdvance = 200000;
			}
		}

		if ($aprobado == true) {
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->save();
		}

		if ($aprobado == false && $perfilCrediticio == 'TIPO A' && $customerStatusDenied == false && $customer->ACTIVIDAD != 'SOLDADO-MILITAR-POLICÍA') {
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
					$customerIntention->CREDIT_DECISION = 'Negado';
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
			$customerIntention->CREDIT_DECISION = 'Negado';
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
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo
					];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '15';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo
					];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '16';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente,
						'fuenteFallo'          => $fuenteFallo
					];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO           = 'PREAPROBADO';
						$customerIntention->TARJETA = $tarjeta;
						$customerIntention->ID_DEF  = '17';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customer->save();
						$customerIntention->save();
						return [
							'resp'                 => "true",
							'quotaApprovedProduct' => $quotaApprovedProduct,
							'quotaApprovedAdvance' => $quotaApprovedAdvance,
							'estadoCliente'        => $estadoCliente,
							'fuenteFallo'          => $fuenteFallo
						];
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
				$customerIntention->CREDIT_DECISION = 'Negado';
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

	public function decisionCreditCard(Request $request, $identificationNumber)
	{
		$dataLead = $request['lead'];
		$dataPolicy = $request['policyResult'];
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tarjeta Oportuya';
		$intention->save();
		$tipoDoc = 1;
		$lastName = explode(" ", $dataLead['APELLIDOS']);
		$lastName = $lastName[0];
		$fechaExpIdentification = explode("-", $dataLead['FEC_EXP']);
		$fechaExpIdentification = $fechaExpIdentification[2] . "/" . $fechaExpIdentification[1] . "/" . $fechaExpIdentification[0];
		$estadoSolic = 3;
		$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
		$resultUbica = $this->validateConsultaUbica($identificationNumber);
		if ($resultUbica == 0) {
			$confronta = $this->webServiceInterface->execConsultaConfronta($tipoDoc, $identificationNumber, $fechaExpIdentification, $lastName);
			if ($confronta == 1) {
				$form = $this->toolsInterface->getFormConfronta($identificationNumber);
				if (empty($form)) {
					$estadoSolic = 3;
				} else {
					return [
						'form' => $form,
						'resp' => 'confronta'
					];
				}
			} else {
				$estadoSolic = 3;
			}
		} else {
			$estadoSolic = 19;
		}

		$policyCredit = [
			'quotaApprovedProduct' => $dataPolicy['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $dataPolicy['quotaApprovedAdvance'],
			'resp' => 'true'
		];

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
			'CON_CLI1' => '',
			'CON_CLI2' => '',
			'CON_CLI3' => '',
			'CON_CLI4' => '',
			'EDIT_RFCLI' => '',
			'EDIT_RFCL2' => ''
		];

		$estadoSolic = (isset($dataPolicy['policy']['fuenteFallo']) && $dataPolicy['policy']['fuenteFallo'] == 'true') ? 3 : $estadoSolic;
		$debtor = new DebtorInsuranceOportuya;
		$debtor->CEDULA = $identificationNumber;
		$debtor->save();
		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data, $intention->id);
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
		$customer      = $this->customerInterface->findCustomerById($identificationNumber);
		$customerPhone = $customer->checkedPhone;
		$celLead       = 0;

		if (!empty($customerPhone)) {
			$celLead =	$customerPhone =  $customer->checkedPhone->NUM;
		}

		$aprobo = 0;
		$consec = $customer->lastUbicaConsultation->consec;
		$telConsultaUbica = $this->ubicaCellPhoneInterfac->getUbicaCellPhoneByConsec($celLead, $consec);

		if ($telConsultaUbica->isNotEmpty()) {
			$aprobo = $this->ubicaInterface->validateDateUbica($telConsultaUbica[0]->ubiprimerrep);
		} else {
			$aprobo = 0;
		}

		if ($aprobo == 0) {
			// Validacion Telefono empresarial
			if ($customer->TEL_EMP != '' && $customer->TEL_EMP != '0') {
				$telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_telefono` WHERE `ubitipoubi` LIKE '%LAB%' AND `ubiconsul` = :consec AND (`ubitelefono` = :tel_emp OR `ubitelefono` = :tel2_emp ) ", ['consec' => $consec, 'tel_emp' => $customer->TEL_EMP, 'tel2_emp' => $customer->TEL2_EMP]);
				if (!empty($telEmpConsultaUbica)) {
					$aprobo = $this->ubicaInterface->validateDateUbica($telEmpConsultaUbica[0]->ubiprimerrep);
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
				$emailConsultaUbica = $this->ubicaMailInterface->getUbicaEmailByConsec($customer->EMAIL, $consec);
				if ($emailConsultaUbica->isNotEmpty()) {
					$aprobo = $this->ubicaInterface->validateDateUbica($emailConsultaUbica[0]->ubiprimerrep);
				}
			} else {
				$aprobo = 0;
			}
		}
		return $aprobo;
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
		$dataDatosCliente = ['NOM_REFPER' => $leadInfo['NOM_REFPER'], 'TEL_REFPER' => $leadInfo['TEL_REFPER'], 'NOM_REFFAM' => $leadInfo['NOM_REFFAM'], 'TEL_REFFAM' => $leadInfo['TEL_REFFAM']];
		$solicCredit = $this->addSolicCredit($leadInfo['identificationNumber'], $policyCredit, $estadoSolic, "PASOAPASO", $dataDatosCliente, $customerIntention->id);

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
		$customer->TIPOCLIENTE = "NUEVO";
		$customer->SUBTIPO     = "NUEVO";
		$customer->save();
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tradicional';
		$intention->save();
		$estadoSolic = 1;
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

		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data, $intention->id);
	}

	private function addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data, $intentionId)
	{
		$this->webServiceInterface->execMigrateCustomer($identificationNumber);
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$numSolic = $this->addSolicFab($customer, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic, $intentionId);

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

		$this->datosClienteInterface->addDatosCliente($data);
		$this->addAnalisis($numSolic, $customer->customerFosygaTemps->first());
		$infoLead        = (object) [];
		if ($estadoSolic != 3) {
			$infoLead = $this->getInfoLeadCreate($identificationNumber);
		}
		$infoLead->numSolic = $numSolic;
		if ($estadoSolic == 19) {
			$customer->ESTADO = "APROBADO";
			$customer->save();
			$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
			$customerIntention->ESTADO_INTENCION = 4;
			$customerIntention->save();
			$estadoResult = "APROBADO";
			$existCard = $this->creditCardInterface->checkCustomerHasCreditCard($identificationNumber);
			if ($existCard == true) {
			} else {
				$this->creditCardInterface->createCreditCard(
					$numSolic,
					$identificationNumber,
					$policyCredit['quotaApprovedProduct'],
					$policyCredit['quotaApprovedAdvance'],
					$infoLead->SUC,
					$infoLead->TARJETA
				);
			}
		} elseif ($estadoSolic == 1) {
			$debtor         = new DebtorInsurance();
			$debtor->CEDULA = $identificationNumber;
			$debtor->SOLIC  = $numSolic;
			$debtor->save();
			$estadoResult = "PREAPROBADO";
		} else {
			$estadoResult  = "PREAPROBADO";
			$respScoreLead = $customer->latestCifinScore;
			$scoreLead     = 0;
			if (!empty($respScoreLead)) {
				$scoreLead = $respScoreLead->score;
			}

			$this->addTurnosOportuya($customer, $scoreLead, $numSolic);
		}
		$customer->ESTADO = $estadoResult;
		$customer->save();
		$infoLead = (object) [];
		if ($estadoSolic != 3) {
			$infoLead = $this->getInfoLeadCreate($identificationNumber);
		}
		$infoLead->numSolic = $numSolic;

		return [
			'estadoCliente'        => $estadoResult,
			'resp'                 => $policyCredit['resp'],
			'infoLead'             => $infoLead,
			'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']
		];
	}

	private function addSolicFab($customer, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado, $intentionId)
	{
		$assessorCode = $this->userInterface->getAssessorCode();
		$sucursal     = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$requestData = [
			'AVANCE_W'      => $quotaApprovedAdvance,
			'PRODUC_W'      => $quotaApprovedProduct,
			'CLIENTE'       => $customer->CEDULA,
			'CODASESOR'     => $assessorCode,
			'id_asesor'     => $assessorCode,
			'ID_EMPRESA'    => $assessorData->ID_EMPRESA,
			'SUCURSAL'      => $sucursal,
			'ESTADO'        => $estado,
			'SOLICITUD_WEB' => $intentionId
		];

		$customerFactoryRequest = $this->factoryInterface->addFactoryRequest($requestData)->SOLICITUD;
		$this->codebtorInterface->createCodebtor($customerFactoryRequest);
		$this->secondCodebtorInterface->createSecondCodebtor($customerFactoryRequest);
		$factoryRequest = $this->factoryInterface->findFactoryRequestById($customerFactoryRequest);
		$factoryRequest->states()->attach($estado, ['usuario' => $assessorData->NOMBRE]);
		return $customerFactoryRequest;
	}

	private function addAnalisis($numSolic, $fosygaTemp)
	{
		$analisisData = [
			'solicitud'      => $numSolic,
		];

		if ($fosygaTemp) {
			$analisisData['paz_cli']  = $fosygaTemp->paz_cli;
			$analisisData['fos_cliente']     = $fosygaTemp->fos_cliente;
		}

		$this->AnalisisInterface->addAnalisis($analisisData);
	}

	private function addTurnosOportuya($customer, $scoreLead, $numSolic)
	{
		$sucursal     = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
		$assessorCode = $this->userInterface->getAssessorCode();
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$turnData = [
			'SOLICITUD' => $numSolic,
			'CEDULA'    => $customer->CEDULA,
			'SUC'       => $sucursal,
			'SCORE'     => $scoreLead,
		];

		$this->OportuyaTurnInterface->addOportuyaTurn($turnData);

		return "true";
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
		$estadosAssessors        = $this->factoryInterface->countAssessorFactoryRequestStatuses($from, $to, $assessor);
		$webAssessorsCounts      = $this->factoryInterface->countWebAssessorFactory($from, $to, $assessor);
		$factoryAssessorsTotal   = $this->factoryInterface->getAssessorFactoryTotal($from, $to, $assessor);
		$estadosAprobados        = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors($from, $to, $assessor, array(19, 20));
		$estadosNegados          = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, 16);
		$estadosDesistidos       = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors($from, $to, $assessor, 15);
		$estadosPendientes       = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20));
		$valuesEstadosAprobados  = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors($from, $to, $assessor, array(19, 20), $subsidiary);
		$valuesEstadosNegados    = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 16, $subsidiary);
		$valuesEstadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors($from, $to, $assessor, 15, $subsidiary);
		$valuesEstadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors($from, $to, $assessor, array(16, 15, 19, 20), $subsidiary);

		if (request()->has('from') && request()->input('from') != '' && request()->input('to') != '') {
			$valuesEstadosAprobados  = $this->factoryInterface->countFactoryRequestsTotalAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20), $subsidiary);
			$valuesEstadosNegados    = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16, $subsidiary);
			$valuesEstadosDesistidos = $this->factoryInterface->countFactoryRequestsTotalGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15, $subsidiary);
			$valuesEstadosPendientes = $this->factoryInterface->countFactoryRequestsTotalPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20), $subsidiary);
		}

		if (request()->has('from')) {
			$estadosAssessors      = $this->factoryInterface->countAssessorFactoryRequestStatuses(request()->input('from'), request()->input('to'), $assessor);
			$webAssessorsCounts    = $this->factoryInterface->countWebAssessorFactory(request()->input('from'), request()->input('to'), $assessor);
			$factoryAssessorsTotal = $this->factoryInterface->getAssessorFactoryTotal(request()->input('from'), request()->input('to'), $assessor);
			$estadosAprobados      = $this->factoryInterface->countFactoryRequestsStatusesAprobadosAssessors(request()->input('from'), request()->input('to'), $assessor, array(19, 20));
			$estadosNegados        = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 16);
			$estadosDesistidos     = $this->factoryInterface->countFactoryRequestsStatusesGeneralsAssessors(request()->input('from'), request()->input('to'), $assessor, 15);
			$estadosPendientes     = $this->factoryInterface->countFactoryRequestsStatusesPendientesAssessors(request()->input('from'), request()->input('to'), $assessor, array(16, 15, 19, 20));
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
