<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Intenciones;
use App\ResultadoPolitica;
use App\CodeUserVerification;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Exports\ExportToExcel;
use App\Http\Controllers\Controller;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use App\Entities\ConfirmationMessages\Repositories\Interfaces\ConfirmationMessageRepositoryInterface;
use App\Entities\ConsultationValidities\Repositories\Interfaces\ConsultationValidityRepositoryInterface;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use App\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;

class OportuyaV2Controller extends Controller
{
	use ProductTransformable;
	private $confirmationMessageInterface, $subsidiaryInterface, $cityInterface;
	private $customerInterface, $customerCellPhoneInterface, $consultationValidityInterface;
	private $daysToIncrement, $fosygaInterface, $registraduriaInterface, $webServiceInterface;
	private $timeRejectedVigency, $factoryRequestInterface, $commercialConsultationInterface;
	private $creditCardInterface, $employeeInterface, $punishmentInterface, $customerVerificationCodeInterface;
	private $UpToDateFinancialCifinInterface, $CifinFinancialArrearsInterface, $cifinRealArrearsInterface;
	private $cifinScoreInterface, $intentionInterface, $extintFinancialCifinInterface;
	private $UpToDateRealCifinInterface, $extinctRealCifinInterface, $cifinBasicDataInterface;
	private $ubicaInterface, $productRepo, $brandRepo, $datosClienteInterface;
	private $assessorInterface, $policyInterface, $OportuyaTurnInterface,  $turnInterface;

	public function __construct(
		ConfirmationMessageRepositoryInterface $confirmationMessageRepositoryInterface,
		SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
		CityRepositoryInterface $cityRepositoryInterface,
		CustomerRepositoryInterface $customerRepositoryInterface,
		CustomerCellPhoneRepositoryInterface $customerCellPhoneRepositoryInterface,
		ConsultationValidityRepositoryInterface $consultationValidityRepositoryInterface,
		FosygaRepositoryInterface $fosygaRepositoryInterface,
		WebServiceRepositoryInterface $WebServiceRepositoryInterface,
		RegistraduriaRepositoryInterface $registraduriaRepositoryInterface,
		FactoryRequestRepositoryInterface $factoryRequestRepositoryInterface,
		CommercialConsultationRepositoryInterface $commercialConsultationRepositoryInterface,
		CreditCardRepositoryInterface $creditCardRepositoryInterface,
		EmployeeRepositoryInterface $employeeRepositoryInterface,
		PunishmentRepositoryInterface $punishmentRepositoryInterface,
		CustomerVerificationCodeRepositoryInterface $customerVerificationCodeRepositoryInterface,
		UpToDateFinancialCifinRepositoryInterface $UpToDateFinancialCifinRepositoryInterface,
		CifinFinancialArrearRepositoryInterface $CifinFinancialArrearRepositoryInterface,
		CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface,
		CifinScoreRepositoryInterface $cifinScoreRepositoryInterface,
		IntentionRepositoryInterface $intentionRepositoryInterface,
		ExtintFinancialCifinRepositoryInterface $extintFinancialCifinRepositoryInterface,
		UpToDateRealCifinRepositoryInterface $upToDateRealCifinsRepositoryInterface,
		ExtintRealCifinRepositoryInterface $extintRealCifinRepositoryInterface,
		CifinBasicDataRepositoryInterface $cifinBasicDataRepositoryInterface,
		UbicaRepositoryInterface $ubicaRepositoryInterface,
		AssessorRepositoryInterface $AssessorRepositoryInterface,
		ProductRepositoryInterface $productRepository,
		BrandRepositoryInterface $brandRepository,
		PolicyRepositoryInterface $policyRepositoryInterface,
		OportuyaTurnRepositoryInterface $oportuyaTurnRepositoryInterface,
		DatosClienteRepositoryInterface $datosClienteRepositoryInterface,
		TurnRepositoryInterface $turnRepositoryInterface,
		AnalisisRepositoryInterface $analisisRepositoryInterface

	) {
		$this->confirmationMessageInterface      = $confirmationMessageRepositoryInterface;
		$this->subsidiaryInterface               = $subsidiaryRepositoryInterface;
		$this->cityInterface                     = $cityRepositoryInterface;
		$this->customerInterface                 = $customerRepositoryInterface;
		$this->customerCellPhoneInterface        = $customerCellPhoneRepositoryInterface;
		$this->consultationValidityInterface     = $consultationValidityRepositoryInterface;
		$this->fosygaInterface                   = $fosygaRepositoryInterface;
		$this->webServiceInterface               = $WebServiceRepositoryInterface;
		$this->registraduriaInterface            = $registraduriaRepositoryInterface;
		$this->factoryRequestInterface           = $factoryRequestRepositoryInterface;
		$this->commercialConsultationInterface   = $commercialConsultationRepositoryInterface;
		$this->creditCardInterface               = $creditCardRepositoryInterface;
		$this->employeeInterface                 = $employeeRepositoryInterface;
		$this->punishmentInterface               = $punishmentRepositoryInterface;
		$this->customerVerificationCodeInterface = $customerVerificationCodeRepositoryInterface;
		$this->UpToDateFinancialCifinInterface   = $UpToDateFinancialCifinRepositoryInterface;
		$this->CifinFinancialArrearsInterface    = $CifinFinancialArrearRepositoryInterface;
		$this->cifinRealArrearsInterface         = $cifinRealArrearRepositoryInterface;
		$this->cifinScoreInterface               = $cifinScoreRepositoryInterface;
		$this->intentionInterface                = $intentionRepositoryInterface;
		$this->extintFinancialCifinInterface     = $extintFinancialCifinRepositoryInterface;
		$this->UpToDateRealCifinInterface        = $upToDateRealCifinsRepositoryInterface;
		$this->extinctRealCifinInterface         = $extintRealCifinRepositoryInterface;
		$this->cifinBasicDataInterface           = $cifinBasicDataRepositoryInterface;
		$this->ubicaInterface                    = $ubicaRepositoryInterface;
		$this->assessorInterface                 = $AssessorRepositoryInterface;
		$this->productRepo                       = $productRepository;
		$this->brandRepo                         = $brandRepository;
		$this->policyInterface                   = $policyRepositoryInterface;
		$this->datosClienteInterface             = $datosClienteRepositoryInterface;
		$this->OportuyaTurnInterface             = $oportuyaTurnRepositoryInterface;
		$this->turnInterface                     = $turnRepositoryInterface;
		$this->analisisInterface                 = $analisisRepositoryInterface;
	}

	public function index()
	{
		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();
		return view('oportuya.indexV2', ['images' => $images]);
	}

	public function catalog()
	{
		$list = $this->productRepo->listFrontProducts('id');

		$products = $list->map(function (Product $item) {
			return $this->transformProduct($item);
		})->all();

		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();

		return view('oportuya.catalog', [
			'images'   => $images,
			'products' => $products,
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')
		]);
	}

	public function product($slug)
	{
		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();
		return view('oportuya.product.show', [
			'images'  => $images,
			'product' => $this->productRepo->findProductBySlug($slug)
		]);
	}

	public function getPageDeniedTr()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedTr();

		return view('advance.pageDeniedTradicional', [
			'mensaje' => $mensaje->MSJ
		]);
	}

	public function getPageDeniedAl()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedAl();

		return view('advance.pageDeniedAlmacen', [
			'mensaje' => $mensaje->MSJ
		]);
	}

	public function getPageDeniedSH()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedSH();

		return view('advance.pageDeniedSinHistorial', [
			'mensaje' => $mensaje->MSJ
		]);
	}

	public function getPageDenied()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDenied();

		return view('advance.pageDeniedAdvance', [
			'mensaje' => $mensaje->MSJ
		]);
	}

	public function validateEmail()
	{
		return response()->json(true);
		$emailsValidos = [];
		$listaCorreos = [];
		foreach ($listaCorreos as $value) {

			$re = '/^[a-z0-9!#$%&\'*+\=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/m';
			$str = strtolower($value);
			if (preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0)) {
				if ($str != '00000@0000.com' && $str != 'no@hotmail.com' && $str != 'ninguno@hotmail.com' && $str != 'no@hotmail.co' && $str != 'na@hotmail.com' && $str != 'na@na.com' && $str != 'na@gmail.com' && $str != 'notiene@hotmail.com') {
					$pos = strpos($str, 'xxx');
					if ($pos === false) {
						if (!in_array($str, $emailsValidos)) {
							$emailsValidos[] = $str;
						}
					}
				}
			}
		}
		return $emailsValidos;
	}

	public function store(Request $request)
	{
		//get step one request from data sent by form
		if (($request->get('step')) == 1) {
			$paso = "PASO1";

			$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
			if (Auth::user()) {
				$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
			}

			$identificationNumber = trim($request->get('identificationNumber'));
			$customer             = $this->customerInterface->checkIfExists($identificationNumber);
			$clienteWeb           = 1;
			$usuarioActualizacion = "";
			$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
			$usuarioCreacion      = (string) $assessorCode;

			$clienteWeb = (isset($customer->CLIENTE_WEB)) ? $customer->CLIENTE_WEB : 1;
			$usuarioCreacion = (isset($customer->USUARIO_CREACION)) ? $customer->USUARIO_CREACION : (string) $assessorCode;
			$usuarioActualizacion = (string) $assessorCode;

			$subsidiaryCityName = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('city'))->CIUDAD;
			$city               = $this->cityInterface->getCityByName($subsidiaryCityName);
			$estado             = "";
			$dataOportudata = [
				'TIPO_DOC'              => $request->get('typeDocument'),
				'CEDULA'                => $identificationNumber,
				'NOMBRES'               => trim(strtoupper($request->get('name'))),
				'APELLIDOS'             => trim(strtoupper($request->get('lastName'))),
				'EMAIL'                 => trim($request->get('email')),
				'CELULAR'               => trim($request->get('telephone')),
				'PROFESION'             => 'NO APLICA',
				'ACTIVIDAD'             => strtoupper($request->get('occupation')),
				'CIUD_UBI'              => trim($subsidiaryCityName),
				'DEPTO'                 => trim($city->DEPARTAMENTO),
				'FEC_EXP'               => trim($request->get('dateDocumentExpedition')),
				'TIPOCLIENTE'           => 'OPORTUYA',
				'SUBTIPO'               => 'WEB',
				'STATE'                 => 'A',
				'SUC'                   => $request->get('city'),
				'ESTADO'                => $estado,
				'PASO'                  => $paso,
				'ORIGEN'                => $request->get('typeService'),
				'CLIENTE_WEB'           => $clienteWeb,
				'TRAT_DATOS'            => "SI",
				'USUARIO_CREACION'      => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $usuarioActualizacion,
				'FECHA_ACTUALIZACION'   => date('Y-m-d H: i: s'),
				'ID_CIUD_UBI'           => trim($city->ID_DIAN),
				'MEDIO_PAGO'            => 12,
			];

			$this->customerInterface->updateOrCreateCustomer($dataOportudata);

			if ($request->get('CEL_VAL') == 0 && empty($this->customerCellPhoneInterface->checkIfExists($identificationNumber, $request->get('telephone')))) {
				$clienteCelular            = [];
				$clienteCelular['IDENTI']  = $identificationNumber;
				$clienteCelular['NUM']     = trim($request->get('telephone'));
				$clienteCelular['TIPO']    = 'CEL';
				$clienteCelular['CEL_VAL'] = 1;
				$clienteCelular['FECHA']   = date("Y-m-d H:i:s");
				$this->customerCellPhoneInterface->createCustomerCellPhone($clienteCelular);
			}

			$consultasRegistraduria = $this->execConsultaRegistraduriaLead(
				$identificationNumber,
				$request->get('typeDocument'),
				$request->get('dateDocumentExpedition'),
				$request->get('name'),
				$request->get('lastName')
			);

			if ($consultasRegistraduria == "-3") {
				return "-3";
			}

			if ($request->get('productId') == 0) {
				$data = [
					'CEDULA' => $identificationNumber,
				];
			} else {
				$data = [
					'CEDULA' => $identificationNumber,
					'product_id' => $request->get('productId')
				];
			}

			$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
			$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);

			if ($lastIntention == "true") {
				$customerIntention =  $this->intentionInterface->createIntention($data);
			}

			return "1";
		}

		if ($request->get('step') == 2) {
			$identificationNumber = trim($request->get('identificationNumber'));
			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
			$paso = "PASO2";

			$getIdcityExp = $this->cityInterface->getCityByName(trim($request->get('cityExpedition')));
			$dataLead = [
				'CEDULA' 			=> $identificationNumber,
				'DIRECCION' 		=> trim(strtoupper($request->get('addres'))),
				'FEC_NAC' 			=> $request->get('birthdate'),
				'CIUD_EXP' 			=> trim($request->get('cityExpedition')),
				'EDAD' 				=> $this->calculateAge($request->get('birthdate')),
				'ID_CIUD_EXP' 		=> trim($getIdcityExp->ID_DIAN),
				'ESTADOCIVIL' 		=> strtoupper($request->get('civilStatus')),
				'PROPIETARIO' 		=> ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')) : 'NA',
				'SEXO' 				=> strtoupper($request->get('gender')),
				'TIPOV' 			=> strtoupper($request->get('housingType')),
				'TIEMPO_VIV' 		=> trim($request->get('housingTime')),
				'TELFIJO'			=> trim($request->get('housingTelephone')),
				'VRARRIENDO' 		=> ($request->get('leaseValue') != '') ? trim($request->get('leaseValue')) : 0,
				'EPS_CONYU'		 	=> ($request->get('spouseEps') != '') ? trim(strtoupper($request->get('spouseEps'))) : 'NA',
				'CEDULA_C'		 	=> ($request->get('spouseIdentificationNumber') != '') ? trim($request->get('spouseIdentificationNumber')) : '0',
				'TRABAJO_CONYU' 	=> ($request->get('spouseJob')) ? trim(strtoupper($request->get('spouseJob'))) : 'NA',
				'CARGO_CONYU' 		=> ($request->get('spouseJobName') != '') ? trim(strtoupper($request->get('spouseJobName'))) : 'NA',
				'NOMBRE_CONYU' 		=> ($request->get('spouseName') != '') ? trim(strtoupper($request->get('spouseName'))) : 'NA',
				'PROFESION_CONYU' 	=> ($request->get('spouseProfession') != '') ? trim(strtoupper($request->get('spouseProfession'))) : 'NA',
				'SALARIO_CONYU' 	=> ($request->get('spouseSalary') != '') ? trim($request->get('spouseSalary')) : '0',
				'CELULAR_CONYU' 	=> ($request->get('spouseTelephone') != '') ? trim($request->get('spouseTelephone')) : '0',
				'ESTRATO' 			=> $request->get('stratum'),
				'PASO' 				=> $paso
			];

			$oportudataLead->update($dataLead);

			$this->execConsultaFosygaLead(
				$identificationNumber,
				$request->get('typeDocument'),
				$request->get('dateDocumentExpedition')
			);

			return response()->json([true]);
		}

		if ($request->get('step') == 3) {
			$identificationNumber = $request->get('identificationNumber');
			$identificationNumber = (string) $identificationNumber;
			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
			$paso = "PASO3";

			$this->timeRejectedVigency = $this->consultationValidityInterface->getRejectedValidity()->rechazado_vigencia;
			$existSolicFab = $this->factoryRequestInterface->checkCustomerHasFactoryRequest($identificationNumber, $this->timeRejectedVigency);

			if ($existSolicFab == true) {
				return -3; // Tiene solicitud
			}

			if (trim($oportudataLead->ACTIVIDAD) == 'SOLDADO-MILITAR-POLICÍA' || trim($oportudataLead->ACTIVIDAD) == 6) return -2;

			$customerJobStart = new Carbon($request->get('admissionDate'));
			$customerIndependentStart = new Carbon($request->get('dateCreationCompany'));

			$dataLead = [
				'RAZON_SOC' => ($request->get('companyName') != '') ? trim(strtoupper($request->get('companyName'))) : 'NA',
				'DIR_EMP' 	=> ($request->get('companyAddres') != '') ? trim(strtoupper($request->get('companyAddres'))) : 'NA',
				'TEL_EMP'	=> ($request->get('companyTelephone') != '') ? trim($request->get('companyTelephone')) : 0,
				'ACT_ECO' 	=> ($request->get('eps') != '') ? trim(strtoupper($request->get('eps'))) : '-',
				'CARGO' 	=> ($request->get('companyPosition') != '') ? trim(strtoupper($request->get('companyPosition'))) : 'NA',
				'FEC_ING' 	=> ($request->get('admissionDate') != '') ? trim($request->get('admissionDate')) : '0000/1/1',
				'ANTIG' 	=>  $customerJobStart->diffInMonths(Carbon::now()),
				'SUELDO' 	=> ($request->get('salary') != '') ? trim($request->get('salary')) : 0,
				'TIPO_CONT' => ($request->get('typeContract') != '') ? trim(strtoupper($request->get('typeContract'))) : 'NA',
				'OTROS_ING' => ($request->get('otherRevenue') != '') ? trim($request->get('otherRevenue')) : 0,
				'CAMARAC' 	=> ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'NIT_IND'	=> ($request->get('nitInd') != '') ? trim($request->get('nitInd')) : 0,
				'RAZON_IND' => ($request->get('companyNameInd') != '') ? trim($request->get('companyNameInd')) : 'NA',
				'ACT_IND' 	=> ($request->get('whatSell') != '') ? trim($request->get('whatSell')) : 'NA',
				'FEC_CONST' => ($request->get('dateCreationCompany') != '') ? trim($request->get('dateCreationCompany')) : '0000/1/1',
				'EDAD_INDP' =>  $customerIndependentStart->diffInMonths(Carbon::now()),
				'SUELDOIND' => ($request->get('salaryInd') != '') ? trim($request->get('salaryInd')) : 0,
				'BANCOP' 	=> ($request->get('bankSavingsAccount') != '') ? trim($request->get('bankSavingsAccount')) : 'NA',
				'PASO' 		=> $paso
			];

			// Update/save information in CLIENTE_FAB table
			$oportudataLead->update($dataLead);
			$fechaExpIdentification = explode("-", $oportudataLead->FEC_EXP);
			$fechaExpIdentification = $fechaExpIdentification[2] . "/" . $fechaExpIdentification[1] . "/" . $fechaExpIdentification[0];
			$dataDatosCliente = [
				'NOM_REFPER' => $request->get('NOM_REFPER'),
				'TEL_REFPER' => $request->get('TEL_REFPER'),
				'NOM_REFFAM' => $request->get('NOM_REFFAM'),
				'TEL_REFFAM' => $request->get('TEL_REFFAM')
			];

			$lastName = explode(" ", $oportudataLead->APELLIDOS);
			$consultasLead = $this->execConsultasLead($oportudataLead->CEDULA, $oportudataLead->TIPO_DOC, 'PASOAPASO', $lastName[0], $fechaExpIdentification, $dataDatosCliente);

			if ($consultasLead['resp'] == 'confronta') {
				return $consultasLead;
			}

			if (isset($consultasLead['resp']['resp'])) {
				if ($consultasLead['resp']['resp'] == 'false') {
					return -2;
				}

				if ($consultasLead['resp']['resp'] == '-2') {
					return -1;
				}
			}

			$estado = $consultasLead['infoLead']->ESTADO;
			if ($estado == 'PREAPROBADO' || $estado == 'SIN COMERCIAL' || $estado == 'APROBADO') {
				$quotaApprovedProduct = $consultasLead['quotaApprovedProduct'];
				$quotaApprovedAdvance = $consultasLead['quotaApprovedAdvance'];
				return response()->json(['data' => true, 'quota' => $quotaApprovedProduct, 'numSolic' => $consultasLead['infoLead']->numSolic, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
			}
		}

		if ($request->get('step') == 'comment') {
			$oportudataLead        = $this->customerInterface->findCustomerById($request->get('identificationNumber'));
			$oportudataLead->NOTA1 = $request->get('availability');
			$oportudataLead->NOTA2 = trim($request->get('comment'));
			$oportudataLead->save();

			return response()->json([true]);
		}
	}

	public function checkIfExistNum($cellPhone, $identificationNumber)
	{
		return $this->customerCellPhoneInterface->checkIfExistNum($cellPhone, $identificationNumber);
	}

	public function getNumLead($identificationNumber, $typeResp = 'json')
	{
		$getNumVal = $this->customerCellPhoneInterface->getCustomerCellPhoneVal($identificationNumber);
		if (!empty($getNumVal)) {
			if ($typeResp == 'json') {
				return response()->json(['resp' => $getNumVal]);
			} else {
				return $getNumVal;
			}
		}

		$getNum = $this->customerCellPhoneInterface->getCustomerCellPhone($identificationNumber);
		if (!empty($getNum)) {
			if ($typeResp == 'json') {
				return response()->json(['resp' => $getNum]);
			} else {
				return $getNum;
			}
		}

		return response()->json(['resp' => -1]);
	}

	public function validationLead($identificationNumber)
	{
		$existCard = $this->creditCardInterface->checkCustomerHasCreditCard($identificationNumber);
		if ($existCard == true) {
			return -1; // Tiene tarjeta
		}

		$empleado = $this->employeeInterface->checkCustomerIsEmployee($identificationNumber);
		if ($empleado == true) {
			return -2; // Es empleado
		}

		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$this->timeRejectedVigency = $this->consultationValidityInterface->getRejectedValidity()->rechazado_vigencia;
		$existSolicFab = $this->factoryRequestInterface->checkCustomerHasFactoryRequest(
			$identificationNumber,
			$this->timeRejectedVigency
		);

		if ($existSolicFab == true) {
			return -3; // Es empleado
		}

		$existDefault = $this->punishmentInterface->checkCustomerIsPunished($identificationNumber);
		if ($existDefault == true) {
			return -4; // Esta Castigado
		}

		return response()->json(true);
	}

	public function getCodeVerification($identificationNumber, $celNumber)
	{
		$code = $this->customerVerificationCodeInterface->generateVerificationCode($identificationNumber);
		$codeUserVerification = new CodeUserVerification;
		$codeUserVerification->code = $code;
		$codeUserVerification->identificationNumber = $identificationNumber;
		$codeUserVerification->save();

		$date = $this->customerVerificationCodeInterface->createCustomerVerificationCode($codeUserVerification)->created_at;
		$dateNew = date('Y-m-d H:i:s', strtotime($date));

		return $this->webServiceInterface->sendMessageSms($code, $identificationNumber, $dateNew, $celNumber);
	}

	
	public function getCodeVerificationOportudata($identificationNumber, $celNumber, $type = "ORIGEN")
	{
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$checkCustomerCodeVerified = $this->customerVerificationCodeInterface->checkCustomerVerificationCode($identificationNumber, $this->daysToIncrement);
		$getCode = $this->customerVerificationCodeInterface->checkCustomerHasCustomerVerificationCode($identificationNumber);
		if ($getCode) {
			$dateNow = Carbon::now();
			$diffeDates = $getCode->created_at->diffInMinutes($dateNow);
			if ($diffeDates < 15) {
				return 'true';
			}
		}

		if ($checkCustomerCodeVerified == 'false') {
			return -1;
		}

		$code                                                   = $this->customerVerificationCodeInterface->generateVerificationCode($identificationNumber);
		$codeUserVerificationOportudata                         = [];
		$codeUserVerificationOportudata['token']                = $code;
		$codeUserVerificationOportudata['identificationNumber'] = $identificationNumber;
		$codeUserVerificationOportudata['telephone']            = $celNumber;
		$codeUserVerificationOportudata['type']                 = $type;

		$codeVerification = $this->customerVerificationCodeInterface->createCustomerVerificationCode($codeUserVerificationOportudata);
		$date = $codeVerification->created_at;
		$dateNew = date('Y-m-d H:i:s', strtotime($date));

		$dataCode = $this->webServiceInterface->sendMessageSmsInfobip($code, $dateNew, $celNumber);
		$this->webServiceInterface->sendMessageSms($code, $dateNew, $celNumber);
		$dataCode = json_decode($dataCode, true);
		$codeVerification['sms_status'] = $dataCode['messages'][0]['status']['groupName']; // groupName
		$codeVerification['sms_response'] = $dataCode['messages'][0]['status']['name']; // name
		$codeVerification['sms_send_description'] = $dataCode['messages'][0]['status']['description']; // description
		$codeVerification['sms_id'] = $dataCode['messages'][0]['messageId']; // messageId
		$codeVerification = $codeVerification->toArray();
		$this->customerVerificationCodeInterface->updateCustomerVerificationCode($codeVerification);
		return "true";
	}

	public function verificationCode($code, $identificationNumber)
	{
		$getCode = $this->customerVerificationCodeInterface->checkCustomerHasCustomerVerificationCode($identificationNumber);
		$smsVigency = $this->consultationValidityInterface->getSmsValidity()->sms_vigencia;
		$dateCode = date('Y-m-d H:i:s', strtotime($getCode->created_at));
		$dateCodeNew = strtotime("+ $smsVigency minute", strtotime($dateCode));
		$dateNow = strtotime(date('Y-m-d H:i:s'));
		if ($dateNow <= $dateCodeNew) {
			if ($code === $getCode->token) {
				$getCode->state = 1;
				$getCode->save();
				return response()->json(true);
			} else {
				return response()->json(-1);
			}
		} else {
			return response()->json(-2);
		}
	}

	public function getContactData($identificationNumber)
	{
		$query = sprintf("SELECT `NOMBRES` as name, `APELLIDOS` as lastName, `EMAIL` as email, `TELFIJO` as telephone, `CIUD_UBI` as city, `TIPO_DOC` as typeDocument, `CEDULA` as identificationNumber, `ACTIVIDAD` as occupation FROM `CLIENTE_FAB` WHERE `CEDULA` = %s LIMIT 1 ", trim($identificationNumber));
		$resp = DB::connection('oportudata')->select($query);

		return response()->json($resp[0]);
	}

	public function simulatePolicyGroup()
	{
		$archivoName = "";
		foreach ($_FILES as $archivo) {
			$archivoName = $archivo["tmp_name"];
		}
		$fp = fopen($archivoName, "r");
		$noExists = [];
		$result = [];
		while (!feof($fp)) {
			$linea = fgets($fp);
			$buscar = array(chr(13) . chr(10), "\r\n", "\n", "\r");
			$reemplazar = array("", "", "", "");
			$lineaCed = str_ireplace($buscar, $reemplazar, $linea);
			if ($lineaCed != '') {
				$resultPolicy = $this->simulatePolicy($lineaCed);
				if ($resultPolicy == "-1" || $resultPolicy == "-2") {
					$noExists[] = $lineaCed;
				} else {
					$result[$lineaCed] = $resultPolicy[0];
				}
			}
		}
		fclose($fp);
		$resultadoPolitica = new ResultadoPolitica;
		$resultadoPolitica->RESULTADO = json_encode($result);
		$resultadoPolitica->save();

		return response()->json(['leads' => $result, 'noExist' => $noExists, 'idResultado' => $resultadoPolitica->ID]);
	}

	public function downloadResultadoPolitica($id)
	{
		$queryResultado = DB::connection('oportudata')->select("SELECT `RESULTADO` FROM `TB_RESULTADO_POLITICA` WHERE `ID` = :id ", ['id' => $id]);
		$resultado = json_decode($queryResultado[0]->RESULTADO);
		$resultado = (array) $resultado;
		$printExcel = [];
		$cont = 0;
		$tipoDoc = "";
		foreach ($resultado as $key => $value) {
			$tipoDoc = "";
			switch ($value->TIPO_DOC) {
				case '1':
					$tipoDoc = 'Cédula de ciudadanía';
					break;

				case '2':
					$tipoDoc = "NIT";
					break;

				case '3':
					$tipoDoc = "Cédula de extranjería";
					break;

				case '4':
					$tipoDoc = "Tarjeta de identidad";
					break;

				case '5':
					$tipoDoc = "Pasaporte";
					break;

				case '6':
					$tipoDoc = "Tarjeta seguro social extranjero";
					break;

				case '7':
					$tipoDoc = "Sociedad extranjera sin NIT en Colombia";
					break;

				case '8':
					$tipoDoc = "Fidecomiso";
					break;
			}

			$motivoRechazo = "";
			if ($value->ESTADO == 'NEGADO') {
				$motivoRechazo = $value->DESCRIPCION . "/" . $value->ID_DEF;
			}

			$tiempoLabor = "";
			$ingresos = "";
			if ($value->ACTIVIDAD == 'RENTISTA' || $value->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $value->ACTIVIDAD == 'NO CERTIFICADO') {
				$tiempoLabor = $value->EDAD_INDP;
				$ingresos    = $value->SUELDOIND;
			} else {
				$ingresos    = $value->SUELDO;
				$tiempoLabor = $value->ANTIG;
			}

			$cont++;
			if ($cont == 1) {
				$printExcel[] = ['FECHA Y HORA DEL PROCESO', 'TIPO DE DOCUMENTO', 'CEDULA', 'NOMBRE TERCERO', 'RESULTADO', 'MOTIVO RECHAZO', 'FECHA DE EXPEDICIÓN DOCUMENTO', 'SUCURSAL', 'ZONA RIESGO', 'SCORE', 'CALIFICACION', 'FECHA DE NACIMIENTO', 'EDAD', 'ACTIVIDAD ECONOMICA', 'TIEMPO EN LABOR', 'INGRESOS', 'INGRESOS ADICIONALES', 'TIPO DE CLIENTE', 'DEFINICION CLIENTE', 'CLIENTE TIPO AAA', 'CLIENTE TIPO 5 ESPECIAL', 'HISTORIAL DE CREDITO', 'TARJETA APLICABLE', 'VISITA OCULAR', 'DIRECCION', 'CELULAR', 'TIPO DE VIVIENDA'];
			}
			$printExcel[] = [$value->FECHA_INTENCION, $tipoDoc, $value->CEDULA, $value->NOMBRES, $value->ESTADO, $motivoRechazo, $value->FEC_EXP, $value->SUC, $value->ZONA_RIESGO, $value->score, $value->PERFIL_CREDITICIO, $value->FEC_NAC, $value->EDAD, $value->ACTIVIDAD, $tiempoLabor, $ingresos, $value->OTROS_ING, $value->TIPO_CLIENTE, $value->DESCRIPCION . "/" . $value->ID_DEF, ($value->TARJETA == 'Tarjeta Black') ? 'Aplica' : 'No Aplica', ($value->TIPO_5_ESPECIAL == '1') ? 'Aplica' : 'No Aplica', ($value->HISTORIAL_CREDITO == '1') ? 'Aplica' : 'No Aplica', $value->TARJETA, ($value->INSPECCION_OCULAR == '1') ? 'Aplica' : 'No Aplica', $value->DIRECCION, $value->CELULAR, $value->TIPOV];
		}
		$export = new ExportToExcel($printExcel);

		return Excel::download($export, 'resultadoPolitica.xlsx');
	}

	public function simulatePolicy($cedula)
	{
		$intencion = new Intenciones;
		$intencion->CEDULA = $cedula;
		$intencion->save();

		if (empty($this->customerInterface->checkIfExists($cedula))) {
			return "-1";
		}

		$queryLeadExistConsultaWs = DB::connection('oportudata')->select("SELECT COUNT(`cedula`) as total
		from `consulta_ws`
		WHERE `cedula` = :cedula ", ['cedula' => $cedula]);

		$queryLeadExistTercero = DB::connection('oportudata')->select("SELECT COUNT(`tercedula`) as total
		from `cifin_tercero`
		WHERE `tercedula` = :cedula ", ['cedula' => $cedula]);

		if ($queryLeadExistConsultaWs[0]->total < 1 || $queryLeadExistTercero[0]->total < 1) {
			return "-2";
		}

		$this->validatePolicyCredit_new($cedula);

		$queryDataLead = DB::connection('oportudata')->select('SELECT inten.`FECHA_INTENCION`, inten.`TIEMPO_LABOR`, cf.`TIPO_DOC`, cf.`CEDULA`, CONCAT(cf.NOMBRES," " ,cf.APELLIDOS) as NOMBRES, cf.`ESTADO`, inten.`ID_DEF`, def.`DESCRIPCION`, def.`CARACTERISTICA`, cf.`FEC_EXP`, cf.`SUC`, inten.`ZONA_RIESGO`, cfs.`score`, inten.`PERFIL_CREDITICIO`, cf.`FEC_NAC`, cf.`EDAD`, cf.`ACTIVIDAD`, cf.`EDAD_INDP`, cf.`ANTIG`, cf.`SUELDO`, cf.`SUELDOIND`, cf.`OTROS_ING`, cf.`SUELDOIND`, inten.`TIPO_CLIENTE`, inten.`TARJETA`, inten.`TIPO_5_ESPECIAL`, inten.`HISTORIAL_CREDITO`, inten.`INSPECCION_OCULAR`, cf.`TIPOV`, cf.`DIRECCION`, cf.`CELULAR`
		FROM `CLIENTE_FAB` as cf
		LEFT JOIN `TB_INTENCIONES` as inten ON inten.`CEDULA` = cf.`CEDULA`
		LEFT JOIN `TB_DEFINICIONES` as def ON def.ID_DEF = inten.`ID_DEF`
		LEFT JOIN `cifin_score` as cfs ON cf.`CEDULA` = cfs.`scocedula`
		WHERE inten.`CEDULA` = :cedula AND cfs.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = :cedulaScore )
		ORDER BY FECHA_INTENCION DESC
		LIMIT 1', ['cedula' => $cedula, 'cedulaScore' => $cedula]);

		return $queryDataLead;
	}

	private function validatePolicyCredit_new($identificationNumber)
	{
		// 5	Puntaje y 3.4 Calificacion Score
		$customerStatusDenied = false;
		$idDef = "";
		$customer          = $this->customerInterface->findCustomerById($identificationNumber);
		$customerScore     = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)->score;
		$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);

		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			if ($customerScore <= -8) {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerStatusDenied = true;
				$idDef = '8';
				$customerIntention->ID_DEF            = '8';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->PERFIL_CREDITICIO = 'TIPO 7';
				$customerIntention->save();
				return ['resp' => "false"];
			}

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customerStatusDenied = true;
				$idDef = '5';
				$perfilCrediticio = 'TIPO D';
			}

			$perfilCrediticio = $this->policyInterface->CheckScorePolicy($customerScore);
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
			$customer->ESTADO                    = 'PREAPROBADO';
			$tarjeta                             = "Crédito Tradicional";
			$customerIntention->TARJETA          = $tarjeta;
			$customerIntention->ESTADO_INTENCION = '2';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "-2"];
		}

		// 2. WS Fosyga
		$estadoCliente = "PREAPROBADO";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultation($identificationNumber);
		if (!empty($getDataFosyga)) {
			if (empty($getDataFosyga->estado) || empty($getDataFosyga->regimen) || empty($getDataFosyga->tipoAfiliado)) {
				return ['resp' => "false"];
			} else {
				if ($getDataFosyga->estado != 'ACTIVO' || $getDataFosyga->regimen != 'CONTRIBUTIVO' || $getDataFosyga->tipoAfiliado != 'COTIZANTE') {
					$statusAfiliationCustomer = false;
				}
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
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultation($identificationNumber);
		if (!empty($getDataRegistraduria)) {
			if (!empty($getDataRegistraduria->estado)) {
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
				return ['resp' => "false"];
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		if ($customerStatusDenied == true) {
			$customer->ESTADO          = 'NEGADO';
			$customerIntention->ID_DEF = $idDef;
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
					$customerIntention->TARJETA          = $tarjeta;
					$customerIntention->ID_DEF           = '14';
					$customerIntention->ESTADO_INTENCION = '2';
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO                    = 'PREAPROBADO';
					$customerIntention->TARJETA          = $tarjeta;
					$customerIntention->ID_DEF           = '15';
					$customerIntention->ESTADO_INTENCION = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO                    = 'PREAPROBADO';
					$customerIntention->TARJETA          = $tarjeta;
					$customerIntention->ID_DEF           = '16';
					$customerIntention->ESTADO_INTENCION = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO                    = 'PREAPROBADO';
						$customerIntention->TARJETA          = $tarjeta;
						$customerIntention->ID_DEF           = '17';
						$customerIntention->ESTADO_INTENCION = '2';
						$customer->save();
						$customerIntention->save();
						return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
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

		if ($perfilCrediticio == 'TIPO B') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '19';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '20';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO C') {
			if ($tipoCliente == 'OPORTUNIDADES') {
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

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $customerScore >= 275) {
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
				$customerIntention->TARJETA = '';
				$customerIntention->ID_DEF  = '24';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if ($tipo5Especial == 1) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA          = 'Crédito Tradicional';
				$customerIntention->ID_DEF           = '12';
				$customerIntention->ESTADO_INTENCION = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
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

		return ['resp' => "true"];
	}

	public function deniedLeadForFecExp($identificationNumber, $typeDenied)
	{

		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);
		$identificationNumber = (string) $identificationNumber;
		$data = [
			'CEDULA'           => $identificationNumber,
			'ID_DEF'           => $typeDenied,
			'ESTADO_INTENCION' => 1
		];

		if ($lastIntention == "true") {
			$this->intentionInterface->createIntention($data);
		} else {
			$dataIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
			$dataIntention->ESTADO_INTENCION = 1;
			$dataIntention->ID_DEF           = $typeDenied;
			$dataIntention->save();
		}

		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customer->ESTADO = 'NEGADO';
		$customer->save();
		return "true";
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

	public function getFormConfronta($identificationNumber)
	{
		$queryForm = DB::connection('oportudata')->select("SELECT cws.consec, preg.secuencia_cuest, preg.secuencia_preg, preg.texto_preg, opcion.secuencia_resp, opcion.texto_resp
		FROM confronta_ws as cws, confronta_preg as preg, confronta_opcion as opcion
		WHERE cws.cedula = :cedula AND cws.consec = (SELECT MAX(consec) FROM confronta_ws WHERE cedula = :cedula2 )
		AND preg.consec = cws.consec AND opcion.consec=cws.consec
		AND preg.secuencia_preg = opcion.secuencia_preg", ['cedula' => $identificationNumber, 'cedula2' => $identificationNumber]);
		$form = [];
		foreach ($queryForm as $value) {
			$form[$value->secuencia_preg]['secuencia']    = $value->secuencia_preg;
			$form[$value->secuencia_preg]['pregunta']     = $value->texto_preg;
			$form[$value->secuencia_preg]['cuestionario'] = $value->secuencia_cuest;
			$form[$value->secuencia_preg]['cedula']       = $identificationNumber;
			$form[$value->secuencia_preg]['consec']       = $value->consec;
			$form[$value->secuencia_preg]['opciones'][]   = ['secuencia_resp' => $value->secuencia_resp, 'opcion' => $value->texto_resp];
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
			$estadoSolic = 19;
		} else {
			$estadoSolic = 3;
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

		$estado = ($estadoSolic == 19) ? "APROBADO" : "PREAPROBADO";
		$quotaApprovedProduct = $solicCredit['quotaApprovedProduct'];
		$quotaApprovedAdvance = $solicCredit['quotaApprovedAdvance'];
		return response()->json(['data' => true, 'quota' => $quotaApprovedProduct, 'numSolic' => $solicCredit['infoLead']->numSolic, 'textPreaprobado' => 2, 'quotaAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
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

	public function execConsultasleadAsesores($identificationNumber)
	{
		$oportudataLead = $this->customerInterface->findCustomerByIdForFosyga($identificationNumber);
		$dateExpIdentification = explode("-", $oportudataLead->FEC_EXP);
		$dateExpIdentification = $dateExpIdentification[2] . "/" . $dateExpIdentification[1] . "/" . $dateExpIdentification[0];

		$consultasRegistraduria = $this->execConsultaRegistraduriaLead(
			$identificationNumber,
			$oportudataLead->TIPO_DOC,
			$oportudataLead->FEC_EXP,
			$oportudataLead->NOMBRES,
			$oportudataLead->APELLIDOS
		);

		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);

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
				$dataIntention->ESTADO_INTENCION = 1;
				$dataIntention->ID_DEF = 2;
				$dataIntention->save();
			}

			return ['resp' => $consultasRegistraduria, 'infoLead' => $dataIntention->definition];
		}

		if ($consultasRegistraduria == "-3") {
			return ['resp' => $consultasRegistraduria];
		}

		$consultaComercial = $this->execConsultaComercialLead($identificationNumber, $oportudataLead->TIPO_DOC);
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
				$dataIntention->ESTADO_INTENCION = 3;
				$dataIntention->save();
			}

			return $policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0,
				'resp'                 => -5
			];
		} else {

			$this->execConsultaFosygaLead(
				$identificationNumber,
				$oportudataLead->TIPO_DOC,
				$oportudataLead->FEC_EXP
			);

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

	private function execConsultaRegistraduriaLead($identificationNumber, $typeDocument, $dateDocument, $name, $lastName)
	{
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
			$validateConsultaRegistraduria = $this->registraduriaInterface->validateConsultaRegistraduria($identificationNumber, $name, $lastName, $dateDocument);
		} else {
			$validateConsultaRegistraduria = 1;
		}

		if ($validateConsultaRegistraduria == -1) {
			return -1;
		}

		if ($validateConsultaRegistraduria < 0) {
			return "-3";
		}

		return "true";
	}

	private function execConsultaFosygaLead($identificationNumber, $typeDocument, $dateDocument)
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

		if ($consultaFosyga > 0) {
			$this->fosygaInterface->validateConsultaFosyga($identificationNumber, $dateDocument);
		}

		return "true";
	}

	public function execConsultasLead($identificationNumber, $tipoDoc, $tipoCreacion, $lastName, $dateExpIdentification, $data = [])
	{
		$consultaComercial = $this->execConsultaComercialLead($identificationNumber, $tipoDoc);

		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);
		if ($consultaComercial == 0) {
			$customer = $this->customerInterface->findCustomerById($identificationNumber);
			$customer->ESTADO = "SIN COMERCIAL";
			$customer->save();

			$dataIntention = [
				'CEDULA' => $identificationNumber,
				'ESTADO_INTENCION' => 3
			];

			if ($lastIntention == "true") {
				$this->intentionInterface->createIntention($dataIntention);
			}

			$estadoSolic = 3;
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0,
				'resp' => 'true'
			];
		} else {
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0
			];

			$policyCredit = $this->validatePolicyCredit_new($identificationNumber);
			$infoLead     = [];
			$infoLead     = $this->getInfoLeadCreate($identificationNumber);

			if ($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2') {
				return [
					'resp'     => $policyCredit,
					'infoLead' => $infoLead
				];
			}

			$estadoSolic = 3;
			$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
			$resultUbica = $this->validateConsultaUbica($identificationNumber);
			if ($resultUbica == 0) {
				$confronta = $this->webServiceInterface->execConsultaConfronta($tipoDoc, $identificationNumber, $dateExpIdentification, $lastName);
				if ($confronta == 1) {
					$form = $this->getFormConfronta($identificationNumber);
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
		}
		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data);
	}

	public function decisionCreditCard($lastName, $identificationNumber, $quotaApprovedProduct, $quotaApprovedAdvance, $dateExpIdentification, $nom_refper, $tel_refper, $nom_reffam, $tel_reffam)
	{
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tarjeta Oportuya';
		$intention->save();
		$tipoDoc = 1;
		$lastName = explode(" ", $lastName);
		$lastName = $lastName[0];
		$fechaExpIdentification = explode("-", $dateExpIdentification);
		$fechaExpIdentification = $fechaExpIdentification[2] . "/" . $fechaExpIdentification[1] . "/" . $fechaExpIdentification[0];
		$estadoSolic = 3;
		$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
		$resultUbica = $this->validateConsultaUbica($identificationNumber);
		if ($resultUbica == 0) {
			$confronta = $this->webServiceInterface->execConsultaConfronta($tipoDoc, $identificationNumber, $fechaExpIdentification, $lastName);
			if ($confronta == 1) {
				$form = $this->getFormConfronta($identificationNumber);
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
			'quotaApprovedProduct' => $quotaApprovedProduct,
			'quotaApprovedAdvance' => $quotaApprovedAdvance,
			'resp' => 'true'
		];
		$data = [
			'NOM_REFPER' => $nom_refper,
			'TEL_REFPER' => $tel_refper,
			'NOM_REFFAM' => $nom_reffam,
			'TEL_REFFAM' => $tel_reffam
		];
		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data);
	}

	public function decisionTraditionalCredit($identificationNumber, $nom_refper, $tel_refper, $nom_reffam, $tel_reffam)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customer->TIPOCLIENTE = "NUEVO";
		$customer->SUBTIPO = "NUEVO";
		$customer->save();
		$intention = $this->intentionInterface->findLatestCustomerIntentionByCedula($identificationNumber);
		$intention->CREDIT_DECISION = 'Tradicional';
		$intention->save();
		$estadoSolic = 1;
		$policyCredit = [
			'quotaApprovedProduct' => 0,
			'quotaApprovedAdvance' => 0,
			'resp' => 'true'
		];
		$data = [
			'NOM_REFPER' => $nom_refper,
			'TEL_REFPER' => $tel_refper,
			'NOM_REFFAM' => $nom_reffam,
			'TEL_REFFAM' => $tel_reffam
		];

		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, "", $data);
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

	private function addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$factoryRequest = $this->addSolicFab($customer, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic);
		$numSolic = $factoryRequest->SOLICITUD;
		if (!empty($data)) {
			$dataDatosCliente = [
				'identificationNumber' => $identificationNumber,
				'numSolic'             => $numSolic,
				'NOM_REFPER'           => $data['NOM_REFPER'],
				'TEL_REFPER'           => $data['TEL_REFPER'],
				'NOM_REFFAM'           => $data['NOM_REFFAM'],
				'TEL_REFFAM'           => $data['TEL_REFFAM']
			];
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

		$this->datosClienteInterface->addDatosCliente($dataDatosCliente);
		$this->addAnalisis($numSolic, $customer->customerFosygaTemps->first());
		$infoLead           = (object) [];
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
			$tarjeta = $this->creditCardInterface->createCreditCard($numSolic, $identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $infoLead->SUC, $infoLead->TARJETA);
		} elseif ($estadoSolic == 1) {
			$estadoResult = "PREAPROBADO";
		} else {
			$estadoResult = "PREAPROBADO";
			$respScoreLead = $customer->latestCifinScore;
			$scoreLead = 0;
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
		$infoLead->ESTADO = $factoryRequest->ESTADO;

		return [
			'estadoCliente'        => $estadoResult,
			'resp'                 => $policyCredit['resp'],
			'infoLead'             => $infoLead,
			'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']
		];
	}

	private function addSolicFab($customer, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado)
	{
		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
		$sucursal = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
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
		];

		$customerFactoryRequest = $this->factoryRequestInterface->addFactoryRequest($requestData);
		$factoryRequest = $this->factoryInterface->findFactoryRequestById($customerFactoryRequest->SOLICITUD);
		$factoryRequest->states()->attach($estado, ['usuario' => $assessorCode]);
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

		$this->analisisInterface->addAnalisis($analisisData);
	}

	private function addTurnos($identificationNumber, $numSolic)
	{
		$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
		$respScoreLead = $oportudataLead->latestCifinScore->score;
		$scoreLead = 0;
		if (!empty($respScoreLead)) {
			$scoreLead = $respScoreLead->score;
		}

		$sucursal = $this->subsidiaryInterface->getSubsidiaryCodeByCity($oportudataLead->CIUD_UBI)->CODIGO;
		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
		$assessorData = $this->assessorInterface->findAssessorById($assessorCode);
		if ($assessorData->SUCURSAL != 1) {
			$sucursal = trim($assessorData->SUCURSAL);
		}

		$turnData = [
			'SOLICITUD' => $numSolic,
			'CEDULA'    => $oportudataLead->CEDULA,
			'SUC'       => $sucursal,
			'SCORE'     => $scoreLead,
		];

		$this->turnInterface->addTurn($turnData);

		return "true";
	}

	private function addTurnosOportuya($customer, $scoreLead, $numSolic)
	{
		$sucursal = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
		$authAssessor = (Auth::guard('assessor')->check()) ? Auth::guard('assessor')->user()->CODIGO : NULL;
		if (Auth::user()) {
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode = ($authAssessor !== NULL) ? $authAssessor : 998877;
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

	public function advanceStep1()
	{
		$digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		return view('advance.step1', ['digitalAnalyst' => $digitalAnalyst[0]]);
	}

	public function advanceStep2($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('advance.step2', ['identificactionNumber' => $identificactionNumber]);
	}

	public function advanceStep3($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('advance.step3', ['identificactionNumber' => $identificactionNumber]);
	}

	public function getDataStep1()
	{
		$query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 AND STATE='A' ORDER BY CIUDAD ASC";
		$resp = DB::connection('oportudata')->select($query);

		return $resp;
	}

	public function getDataStep2($identificationNumber)
	{
		$data = [];
		$query2 = "SELECT `CODIGO` as value, `NOMBRE` as label FROM `CIUDADES` WHERE `STATE` = 'A' ORDER BY NOMBRE ";
		$queryOportudataLead = sprintf("SELECT NOMBRES as name, APELLIDOS as lastName, SUC as branchOffice, CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, TELFIJO as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);
		$respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
		$resp2 = DB::connection('oportudata')->select($query2);
		$digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];
		$data['digitalAnalyst'] = $digitalAnalysts[0];
		$data['cities'] = $resp2;
		$data['oportudataLead'] = $respOportudataLead[0];

		return $data;
	}

	/**
	 * Get data from step two form
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function getDataStep3($identificationNumber)
	{
		$data = [];

		$query2 = "SELECT `CODIGO` as value, `BANCO` as label FROM BANCO ";
		$queryOportudataLead = sprintf("SELECT NOMBRES as name, APELLIDOS as lastName, ACTIVIDAD as occupation, CEDULA as identificationNumber, NIT_EMP as nit, RAZON_SOC as companyName, DIR_EMP as companyAddres, TEL_EMP as companyTelephone, TEL2_EMP as companyTelephone2, ACT_ECO as eps, CARGO as companyPosition, FEC_ING as admissionDate, ANTIG as antiquity, SUELDO as salary, TIPO_CONT as typeContract, OTROS_ING as otherRevenue, `CAMARAC` as camaraComercio, `NIT_IND` as nitInd, `RAZON_IND` as companyNameInd, `FEC_CONST` as dateCreationCompany, `EDAD_INDP` as antiquityInd, `SUELDOIND` as salaryInd, `BANCOP` as bankSavingsAccount, `ACT_IND` as whatSell
	      	FROM CLIENTE_FAB
	      	WHERE CEDULA = %s ", $identificationNumber);

		$resp2 = DB::connection('oportudata')->select($query2);
		$respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
		$digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];
		$data['digitalAnalyst'] = $digitalAnalysts[0];
		$data['banks'] = $resp2;
		$data['oportudataLead'] = $respOportudataLead[0];

		return $data;
	}

	/**
	 * calculate the age through birth day
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 */
	private function calculateAge($fecha)
	{
		$time = strtotime($fecha);
		$now = time();
		$age = ($now - $time) / (60 * 60 * 24 * 365.25);
		$age = floor($age);

		return $age;
	}

	/**
	 * Send a city array,digital analist image and name to step1 view
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function step1()
	{
		$digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		return view('oportuya.step1', ['digitalAnalyst' => $digitalAnalyst[0]]);
	}

	/**
	 * Return step2 view with identificationNumber decrypt
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function step2($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step2', ['identificactionNumber' => $identificactionNumber]);
	}


	/**
	 * Return step3 view with identificationNumber decrypt
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function step3($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step3', ['identificactionNumber' => $identificactionNumber]);
	}

	/**
	 * Encrypt the identificationNumber
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function encrypt($string)
	{
		$string = utf8_encode($string);
		$control1 = "*]wy";
		$control2 = "3/~";
		$string = $control1 . $string . $control2;
		$string = base64_encode($string);

		return response()->json($string);
	}

	/**
	 * Decrypt the identificationNumber
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 */
	public function decrypt($string)
	{
		$string = $string;
		$string = base64_decode($string);
		$controls = ['*]wy', '3/~'];
		$replaces = ['', ''];
		$string = str_replace($controls, $replaces, $string);

		return $string;
	}

	private function applyTrim($charItem)
	{
		$charTrim = trim($charItem);
		return $charTrim;
	}
}
