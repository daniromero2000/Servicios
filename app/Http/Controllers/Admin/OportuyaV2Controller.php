<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\DatosCliente;
use App\Intenciones;
use App\ResultadoPolitica;
use App\Entities\CreditCards\CreditCard;
use App\TurnosOportuya;
use App\Analisis;
use App\CodeUserVerification;
use App\Entities\CifinArrears\Repositories\Interfaces\CifinArrearRepositoryInterface;
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
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\UpToDateCifins\Repositories\Interfaces\UpToDateCifinRepositoryInterface;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class OportuyaV2Controller extends Controller
{
	private $confirmationMessageInterface, $subsidiaryInterface, $cityInterface;
	private $customerInterface, $customerCellPhoneInterface, $consultationValidityInterface;
	private $daysToIncrement, $fosygaInterface, $registraduriaInterface, $webServiceInterface;
	private $timeRejectedVigency, $factoryRequestInterface, $commercialConsultationInterface;
	private $creditCardInterface, $employeeInterface, $punishmentInterface, $customerVerificationCodeInterface;
	private $upToDateCifinInterface, $cifinArrearsInterface, $cifinRealArrearsInterface;
	private $cifinScoreInterface, $intentionInterface;

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
		UpToDateCifinRepositoryInterface $upToDateCifinRepositoryInterface,
		CifinArrearRepositoryInterface $cifinArrearRepositoryInterface,
		CifinRealArrearRepositoryInterface $cifinRealArrearRepositoryInterface,
		CifinScoreRepositoryInterface $cifinScoreRepositoryInterface,
		IntentionRepositoryInterface $intentionRepositoryInterface
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
		$this->upToDateCifinInterface            = $upToDateCifinRepositoryInterface;
		$this->cifinArrearsInterface             = $cifinArrearRepositoryInterface;
		$this->cifinRealArrearsInterface         = $cifinRealArrearRepositoryInterface;
		$this->cifinScoreInterface               = $cifinScoreRepositoryInterface;
		$this->intentionInterface               = $intentionRepositoryInterface;
	}

	public function index()
	{
		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();
		return view('oportuya.indexV2', ['images' => $images]);
	}


	public function getPageDeniedTr()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedTr();

		return view('advance.pageDeniedTradicional', ['mensaje' => $mensaje->MSJ]);
	}

	public function getPageDeniedAl()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedAl();

		return view('advance.pageDeniedAlmacen', ['mensaje' => $mensaje->MSJ]);
	}

	public function getPageDeniedSH()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDeniedSH();

		return view('advance.pageDeniedSinHistorial', ['mensaje' => $mensaje->MSJ]);
	}

	public function getPageDenied()
	{
		$mensaje = $this->confirmationMessageInterface->getPageDenied();

		return view('advance.pageDeniedAdvance', ['mensaje' => $mensaje->MSJ]);
	}

	public function validateEmail()
	{
		return response()->json(true);
		$emailsValidos = [];
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * it get data from step by step form  (one by step),
	 * so first through id the register is verified,
	 * if this exist, the information is  updated,
	 * otherwise it store a new register
	 *
	 * In the process, the data is stored in OPORTUDATA database
	 *
	 */
	public function store(Request $request)
	{
		//get step one request from data sent by form
		if (($request->get('step')) == 1) {
			$paso = "";
			switch ($request->get('typeService')) {
				case 'Avance':
					$paso = "A-PASO1";
					break;

				case 'Oportuya':
					$paso = "O-PASO1";
					break;
			}

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

			if (!empty($customer)) {
				$clienteWeb = $customer->CLIENTE_WEB;
				$usuarioCreacion = $customer->USUARIO_CREACION;
				$usuarioActualizacion = (string) $assessorCode;
			}

			$subsidiaryCityName = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('city'))->CIUDAD;
			$city               = $this->cityInterface->getCityByName($subsidiaryCityName);
			$estado             = "";
			$dataOportudata = [
				'TIPO_DOC' => $request->get('typeDocument'),
				'CEDULA' => $identificationNumber,
				'NOMBRES' => trim(strtoupper($request->get('name'))),
				'APELLIDOS' => trim(strtoupper($request->get('lastName'))),
				'EMAIL' => trim($request->get('email')),
				'CELULAR' => trim($request->get('telephone')),
				'PROFESION' => 'NO APLICA',
				'ACTIVIDAD' => strtoupper($request->get('occupation')),
				'CIUD_UBI' => trim($subsidiaryCityName),
				'DEPTO' =>  trim($city->DEPARTAMENTO),
				'FEC_EXP' => trim($request->get('dateDocumentExpedition')),
				'TIPOCLIENTE' => 'OPORTUYA',
				'SUBTIPO' => 'WEB',
				'STATE' => 'A',
				'SUC' => $request->get('city'),
				'ESTADO' => $estado,
				'PASO' => $paso,
				'ORIGEN' => $request->get('typeService'),
				'CLIENTE_WEB' => $clienteWeb,
				'TRAT_DATOS' => "SI",
				'USUARIO_CREACION' => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $usuarioActualizacion,
				'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'ID_CIUD_UBI' => trim($city->ID_DIAN),
				'MEDIO_PAGO' => 12,
			];

			$this->customerInterface->updateOrCreateCustomer($dataOportudata);

			if ($request->get('CEL_VAL') == 0 && empty($this->customerCellPhoneInterface->checkIfExists($identificationNumber, $request->get('telephone')))) {
				$clienteCelular = [];
				$clienteCelular['IDENTI'] = $identificationNumber;
				$clienteCelular['NUM'] = trim($request->get('telephone'));
				$clienteCelular['TIPO'] = 'CEL';
				$clienteCelular['CEL_VAL'] = 1;
				$clienteCelular['FECHA'] = date("Y-m-d H:i:s");
				$this->customerCellPhoneInterface->createCustomerCellPhone($clienteCelular);
			}

			$consultasFosyga = $this->execConsultaFosygaLead(
				$identificationNumber,
				$request->get('typeDocument'),
				$request->get('dateDocumentExpedition'),
				$request->get('name'),
				$request->get('lastName')
			);

			if ($consultasFosyga == "-1") {
				return "-1";
			}
			if ($consultasFosyga == "-3") {
				return "-3";
			}

			return "1";
		}

		if ($request->get('step') == 2) {
			$identificationNumber = trim($request->get('identificationNumber'));
			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
			$paso = "";
			switch ($oportudataLead->ORIGEN) {
				case 'Avance':
					$paso = "A-PASO2";
					break;

				case 'Oportuya':
					$paso = "O-PASO2";
					break;
			}

			$getIdcityExp = $this->cityInterface->getCityByName(trim($request->get('cityExpedition')));
			$dataLead = [
				'CEDULA' => 	$identificationNumber,
				'DIRECCION' => trim(strtoupper($request->get('addres'))),
				'FEC_NAC' => $request->get('birthdate'),
				'CIUD_EXP' => trim($request->get('cityExpedition')),
				'EDAD' => $this->calculateAge($request->get('birthdate')),
				'ID_CIUD_EXP' => trim($getIdcityExp->ID_DIAN),
				'ESTADOCIVIL' => strtoupper($request->get('civilStatus')),
				'PROPIETARIO' => ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')) : 'NA',
				'SEXO' => strtoupper($request->get('gender')),
				'TIPOV' => strtoupper($request->get('housingType')),
				'TIEMPO_VIV' => trim($request->get('housingTime')),
				'TELFIJO' => trim($request->get('housingTelephone')),
				'VRARRIENDO' => ($request->get('leaseValue') != '') ? trim($request->get('leaseValue')) : 0,
				'EPS_CONYU' => ($request->get('spouseEps') != '') ? trim(strtoupper($request->get('spouseEps'))) : 'NA',
				'CEDULA_C' => ($request->get('spouseIdentificationNumber') != '') ? trim($request->get('spouseIdentificationNumber')) : '0',
				'TRABAJO_CONYU' => ($request->get('spouseJob')) ? trim(strtoupper($request->get('spouseJob'))) : 'NA',
				'CARGO_CONYU' => ($request->get('spouseJobName') != '') ? trim(strtoupper($request->get('spouseJobName'))) : 'NA',
				'NOMBRE_CONYU' => ($request->get('spouseName') != '') ? trim(strtoupper($request->get('spouseName'))) : 'NA',
				'PROFESION_CONYU' => ($request->get('spouseProfession') != '') ? trim(strtoupper($request->get('spouseProfession'))) : 'NA',
				'SALARIO_CONYU' => ($request->get('spouseSalary') != '') ? trim($request->get('spouseSalary')) : '0',
				'CELULAR_CONYU' => ($request->get('spouseTelephone') != '') ? trim($request->get('spouseTelephone')) : '0',
				'ESTRATO' => $request->get('stratum'),
				'PASO' => $paso
			];

			$oportudataLead->update($dataLead);

			return response()->json([true]);
		}

		if ($request->get('step') == 3) {
			$identificationNumber = $request->get('identificationNumber');
			$identificationNumber = (string) $identificationNumber;
			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
			$paso = "";
			switch ($oportudataLead->ORIGEN) {
				case 'Avance':
					$paso = "A-PASO3";
					break;

				case 'Oportuya':
					$paso = "O-PASO3";
					break;
			}

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
				'DIR_EMP' => ($request->get('companyAddres') != '') ? trim(strtoupper($request->get('companyAddres'))) : 'NA',
				'TEL_EMP' => ($request->get('companyTelephone') != '') ? trim($request->get('companyTelephone')) : 0,
				'ACT_ECO' => ($request->get('eps') != '') ? trim(strtoupper($request->get('eps'))) : '-',
				'CARGO' => ($request->get('companyPosition') != '') ? trim(strtoupper($request->get('companyPosition'))) : 'NA',
				'FEC_ING' => ($request->get('admissionDate') != '') ? trim($request->get('admissionDate')) : '0000/1/1',
				'ANTIG' =>  $customerJobStart->diffInMonths(Carbon::now()),
				'SUELDO' => ($request->get('salary') != '') ? trim($request->get('salary')) : 0,
				'TIPO_CONT' => ($request->get('typeContract') != '') ? trim(strtoupper($request->get('typeContract'))) : 'NA',
				'OTROS_ING' => ($request->get('otherRevenue') != '') ? trim($request->get('otherRevenue')) : 0,
				'CAMARAC' => ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'NIT_IND' => ($request->get('nitInd') != '') ? trim($request->get('nitInd')) : 0,
				'RAZON_IND' => ($request->get('companyNameInd') != '') ? trim($request->get('companyNameInd')) : 'NA',
				'ACT_IND' => ($request->get('whatSell') != '') ? trim($request->get('whatSell')) : 'NA',
				'FEC_CONST' => ($request->get('dateCreationCompany') != '') ? trim($request->get('dateCreationCompany')) : '0000/1/1',
				'EDAD_INDP' =>  $customerIndependentStart->diffInMonths(Carbon::now()),
				'SUELDOIND' => ($request->get('salaryInd') != '') ? trim($request->get('salaryInd')) : 0,
				'BANCOP' => ($request->get('bankSavingsAccount') != '') ? trim($request->get('bankSavingsAccount')) : 'NA',
				'PASO' => $paso
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
			$oportudataLead = $this->customerInterface->findCustomerById($request->get('identificationNumber'));
			$oportudataLead->NOTA1 = $request->get('availability');
			$oportudataLead->NOTA2 = trim($request->get('comment'));
			$oportudataLead->update();

			return response()->json([true]);
		}
	}

	private function execConsultaFosygaLead($identificationNumber, $typeDocument, $dateDocument, $name, $lastName)
	{
		// Fosyga
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

		// Registraduria8
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
		$validateConsultaRegistraduria = 1;
		if ($validateConsultaRegistraduria == -1) {
			return -1;
		}

		if ($validateConsultaRegistraduria < 0 || $validateConsultaFosyga < 0) {
			return "-3";
		}

		return "true";
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
		$code = $this->customerVerificationCodeInterface->generateVerificationCode($identificationNumber);
		$codeUserVerificationOportudata = [];
		$codeUserVerificationOportudata['token'] = $code;
		$codeUserVerificationOportudata['identificationNumber'] = $identificationNumber;
		$codeUserVerificationOportudata['telephone'] = $celNumber;
		$codeUserVerificationOportudata['type'] = $type;
		$codeUserVerificationOportudata['created_at'] = date('Y-m-d H:i:s');

		$date = $this->customerVerificationCodeInterface->createCustomerVerificationCode($codeUserVerificationOportudata)->created_at;
		$dateNew = date('Y-m-d H:i:s', strtotime($date));

		return $this->webServiceInterface->sendMessageSms($code, $dateNew, $celNumber);
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
				$getCode->update();
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
				$ingresos = $value->SUELDOIND;
			} else {
				$ingresos = $value->SUELDO;
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
		// 3.2	Puntaje y 3.4 Calificacion Score
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customerScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)->score;
		$data = ['CEDULA' => $identificationNumber];
		$customerIntention =  $this->intentionInterface->createIntention($data);

		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			if ($customerScore <= -8) {
				$customer->ESTADO = 'NEGADO';
				$customer->update();
				$customerIntention->PERFIL_CREDITICIO =  'TIPO NE';
				$customerIntention->ID_DEF =  '3.9';
				$customerIntention->save();

				return ['resp' => "false"];
			}

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customer->ESTADO = 'NEGADO';
				$customer->update();
				$customerIntention->PERFIL_CREDITICIO =  'TIPO D';
				$customerIntention->ID_DEF =  '3.2';
				$customerIntention->save();

				return ['resp' => "false"];
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
		$respValorMoraFinanciero = $this->cifinArrearsInterface->checkCustomerHasCifinArrear($identificationNumber)->sum('finvrmora');
		$respValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');
		$totalValorMora          = $respValorMoraFinanciero + $respValorMoraReal;

		if ($totalValorMora > 100) {

			$customer->ESTADO = 'NEGADO';
			$customer->update();
			$customerIntention->ESTADO_OBLIGACIONES = 0;
			$customerIntention->ID_DEF =  '3.3';
			$customerIntention->save();
			return ['resp' => "false"];
		} else {
			$customerIntention->ESTADO_OBLIGACIONES = 1;
			$customerIntention->save();
		}

		//3.5 Historial de Crédito
		$historialCrediticio = 0;
		$totalVector = 0;
		$respQueryComporFin =  $this->upToDateCifinInterface->checkCustomerHasUpToDateCifin6($identificationNumber);

		foreach ($respQueryComporFin as $value) {
			$totalVector = 0;
			if ($value->fdapert == '') {
				break;
			}
			$fechaComporFin = $value->fdapert;
			$fechaComporFin = explode('/', $fechaComporFin);
			$fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
			$dateNow = date('Y-m-d');
			$dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
			if (strtotime($fechaComporFin) > $dateNew) {
				$paymentArray = explode('|', $value->fdcompor);
				$paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
				$popArray = array_pop($paymentArray);
				$paymentArray = array_reverse($paymentArray);
				foreach ($paymentArray as $habit) {
					if ($totalVector >= 6) { // Poner parametrizable
						$historialCrediticio = 1;
						break;
					}

					if ($habit == 'N') {
						$totalVector++;
					} else {
						$totalVector = 0;
					}
				}
			}
		}

		if ($historialCrediticio == 0) {
			$queryComporFinExt = sprintf("SELECT extcompor, exttermin, extapert
			FROM cifin_finext
			WHERE extcalid = 'PRIN' AND `extconsul` = (SELECT MAX(`extconsul`) FROM `cifin_finext` WHERE `extcedula` = %s ) AND extcedula = %s", $identificationNumber, $identificationNumber);

			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

			foreach ($respQueryComporFinExt as $value) {
				if ($value->exttermin == '' && $value->extapert == '') {
					break;
				}
				$fechaComporFin = ($value->exttermin != '') ? $value->exttermin : $value->extapert;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
				if (strtotime($fechaComporFin) > $dateNew) {
					$paymentArray = explode('|', $value->extcompor);
					$paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach ($paymentArray as $habit) {
						if ($totalVector >= 6) {
							$historialCrediticio = 1;
							break;
						}

						if ($habit == 'N') {
							$totalVector++;
						} else {
							$totalVector = 0;
						}
					}
				}
			}
		}

		if ($historialCrediticio == 0) {
			$queryComporFinExt = sprintf("SELECT rdcompor , rdapert
			FROM cifin_realdia
			WHERE rdcalid = 'PRIN' AND `rdconsul` = (SELECT MAX(`rdconsul`) FROM `cifin_realdia` WHERE `rdcedula` = %s ) AND rdcedula = %s", $identificationNumber, $identificationNumber);

			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

			foreach ($respQueryComporFinExt as $value) {
				$fechaComporFin = $value->rdapert;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
				if (strtotime($fechaComporFin) > $dateNew) {
					$paymentArray = explode('|', $value->rdcompor);
					$paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach ($paymentArray as $habit) {
						if ($totalVector >= 6) {
							$historialCrediticio = 1;
							break;
						}

						if ($habit == 'N') {
							$totalVector++;
						} else {
							$totalVector = 0;
						}
					}
				}
			}
		}

		if ($historialCrediticio == 0) {
			$queryComporFinExt = sprintf("SELECT rexcompor , rexcorte
			FROM cifin_realext
			WHERE rexcalid  = 'PRIN' AND `rexconsul` = (SELECT MAX(`rexconsul`) FROM `cifin_realext` WHERE `rexcedula` = %s ) AND rexcedula = %s", $identificationNumber, $identificationNumber);

			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

			foreach ($respQueryComporFinExt as $value) {
				$fechaComporFin = $value->rexcorte;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2] . "-" . $fechaComporFin[1] . "-" . $fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime("- 24 MONTH", strtotime($dateNow));
				if (strtotime($fechaComporFin) > $dateNew) {
					$paymentArray = explode('|', $value->rexcompor);
					$paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach ($paymentArray as $habit) {
						if ($totalVector >= 6) {
							$historialCrediticio = 1;
							break;
						}

						if ($habit == 'N') {
							$totalVector++;
						} else {
							$totalVector = 0;
						}
					}
				}
			}
		}

		$this->updateLastIntencionLead($identificationNumber, 'HISTORIAL_CREDITO', $historialCrediticio);

		//4.1 Zona de riesgo
		$queryGetZonaRiesgo = sprintf("SELECT `ZONA`
		FROM `SUCURSALES`
		WHERE `CODIGO` = '%s' ", $customer->SUC);
		$respZonaRiesgo = DB::connection('oportudata')->select($queryGetZonaRiesgo);
		$this->updateLastIntencionLead($identificationNumber, 'ZONA_RIESGO', $respZonaRiesgo[0]->ZONA);

		// 4.2 Tipo de cliente
		$tipoCliente = '';
		$queryGetClienteActivo = sprintf("SELECT COUNT(`CEDULA`) as tipoCliente
		FROM TB_CLIENTES_ACTIVOS
		WHERE `CEDULA` = %s AND FECHA >= date_add(NOW(), INTERVAL -24 MONTH)", $identificationNumber);
		$this->updateLastIntencionLead($identificationNumber, 'TIPO_CLIENTE', $tipoCliente);

		$respClienteActivo = DB::connection('oportudata')->select($queryGetClienteActivo);
		if ($respClienteActivo[0]->tipoCliente == 1) {
			$tipoCliente = 'OPORTUNIDADES';
		} else {
			$tipoCliente = 'NUEVO';
		}

		$this->updateLastIntencionLead($identificationNumber, 'TIPO_CLIENTE', $tipoCliente);
		// 4.3 Edad.
		$validateTipoCliente = TRUE;
		$queryEdad = DB::connection('oportudata')->select("SELECT `teredad` FROM `cifin_tercero` WHERE `tercedula` = :identificationNumber ORDER BY `terconsul` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if ($queryEdad == false || empty($queryEdad)) {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
			return ['resp' => "false"];
		}
		if ($queryEdad[0]->teredad == 'Mas 75') {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
			return ['resp' => "false"];
		}
		$edad = $queryEdad[0]->teredad;
		$edad = explode('-', $edad);
		$edadMin = $edad[0];
		$edadMax = $edad[1];
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$validateTipoCliente = FALSE;
			if ($edadMin >= 18 && $edadMax <= 70) {
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		if ($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 75) {
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		if ($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 70) {
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		// 4.5 Tiempo en Labor
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
		} else {
			if ($customer->ACTIVIDAD == 'RENTISTA' || $customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($customer->EDAD_INDP >= 4) {
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
				} else {
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 0, '4.5');
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					return ['resp' => "false"];
				}
			} else {
				if ($customer->ANTIG >= 4) {
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
				} else {
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 0, '4.5');
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					return ['resp' => "false"];
				}
			}
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = 0;
		if ($perfilCrediticio == 'TIPO 5') {
			$tipo5Especial = 1;
		}
		$this->updateLastIntencionLead($identificationNumber, 'TIPO_5_ESPECiAL', $tipo5Especial);
		// 4.7 Inspecciones Oculares
		if ($tipoCliente == 'NUEVO') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5') {
					$this->updateLastIntencionLead($identificationNumber, 'INSPECCION_OCULAR', 1);
				}
			}
		}

		// 3.6 Tarjeta Black
		$tarjeta = '';
		$aprobadoVectores = false;
		$aprobado = false;
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1) {
			$aprobado =  $this->upToDateCifinInterface->check12MonthsPaymentVector($identificationNumber);

			if ($customer->CIUD_UBI == 'BOGOTÁ' || $customer->CIUD_UBI == 'MEDELLÍN') {
				if ($customerScore >= 725) {
					if ($aprobadoVectores == true) {
						$aprobado = true;
					}
				}
			} else {
				if ($aprobadoVectores == true) {
					$aprobado = true;
				}
			}

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
				$quotaApprovedAdvance = 500000;
			}
		}

		if ($aprobado == true) {
			$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta);
		}

		if ($aprobado == false && $historialCrediticio == 0) {
			$tarjeta = "Crédito Tradicional";
			$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-2');
			return ['resp' => "-2"];
		}

		// 2. WS Fosyga
		$estadoCliente = "APROBADO";
		$getDataFosyga = DB::connection('oportudata')->select("SELECT `estado`, `regimen`, `tipoAfiliado` FROM `fosyga_bdua` WHERE `cedula` =  :identificationNumber AND `fuenteFallo` = 'NO'  ORDER BY `idBdua` DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		if (!empty($getDataFosyga)) {
			if (empty($getDataFosyga[0]->estado) || empty($getDataFosyga[0]->regimen) || empty($getDataFosyga[0]->tipoAfiliado)) {
				return ['resp' => "false"];
			} else {
				if ($getDataFosyga[0]->estado != 'ACTIVO' || $getDataFosyga[0]->regimen != 'CONTRIBUTIVO' || $getDataFosyga[0]->tipoAfiliado != 'COTIZANTE') {
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio, '2.1');
					return ['resp' => "false"];
				}
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		//3.1 Estado de documento
		$getDataRegistraduria = DB::connection('oportudata')->select("SELECT  `estado` FROM `fosyga_estadoCedula` WHERE `cedula` =  :identificationNumber AND `fuenteFallo` = 'NO' ORDER BY `idEstadoCedula` DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		if (!empty($getDataRegistraduria)) {
			if (!empty($getDataRegistraduria[0]->estado)) {
				if ($getDataRegistraduria[0]->estado != 'VIGENTE') {
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio, '3.1');
					return ['resp' => "false"];
				}
			} else {
				return ['resp' => "false"];
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 5 Definiciones cliente
		if ($perfilCrediticio == 'TIPO A') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-1');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
			}

			if ($customer->ACTIVIDAD == 'EMPLEADO') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-2');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
			}

			if ($customer->ACTIVIDAD == 'PENSIONADO') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-3');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
			}

			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($historialCrediticio == 1) {
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-4');
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				} else {
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'A-5');
					return ['resp' => "-2"];
				}
			}
		}

		if ($perfilCrediticio == 'TIPO B') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'B-1');
				return ['resp' => "-2"];
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'B-2');
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO C') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'C-1');
				return ['resp' => "-2"];
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'C-2');
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $customerScore >= 275) {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'D-1');
				return ['resp' => "-2"];
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', '', 'D-2');
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if ($tipo5Especial == 1) {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-2');
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-1');
				return ['resp' =>  "-2"];
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-3');
				return ['resp' =>  "-2"];
			}
		}

		return ['resp' => "true"];
	}

	public function deniedLeadForFecExp($identificationNumber, $typeDenied)
	{
		$identificationNumber = (string) $identificationNumber;
		$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', '=', $identificationNumber)->get();
		$intencion = new Intenciones;
		$intencion->CEDULA = $identificationNumber;
		$intencion->ID_DEF = $typeDenied;
		$intencion->save();

		$dataLead = [
			'ESTADO' => 'NEGADO'
		];

		$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', '=', $identificationNumber)->update($dataLead);

		return "true";
	}

	private function updateLastIntencionLead($identificationNumber, $campo, $value, $idDef = false)
	{
		$queryUpdate = sprintf("UPDATE `TB_INTENCIONES` SET `%s` = '%s' ", $campo, $value);

		if ($idDef != false) {
			$queryUpdate .= sprintf(", `ID_DEF` = '%s' ", $idDef);
		}

		$queryUpdate .= sprintf(" WHERE `CEDULA` = '%s' ORDER BY FECHA_INTENCION DESC LIMIT 1", $identificationNumber);

		$resp = DB::connection('oportudata')->select($queryUpdate);

		return $resp;
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

	private function execConsultaUbica($identificationNumber, $typeDocument, $lastName)
	{
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->identificationNumber = trim($identificationNumber);
		$obj->lastName = trim($lastName);
		try {
			// 2040 Ubica Pruebas
			$port = config('portsWs.ubica');
			$ws = new \SoapClient("http://10.238.14.181:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
			$result = $ws->ConsultaUbicaPlus($obj);  // correcta
			return 1;
		} catch (\Throwable $th) {
			return 0;
		}
	}

	private function execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName)
	{
		$dateConsultaUbica = $this->validateDateConsultaUbica($identificationNumber);
		if ($dateConsultaUbica == 'true') {
			$consultaUbica = $this->execConsultaUbica($identificationNumber, $tipoDoc, $lastName);
		} else {
			$consultaUbica = 1;
		}

		return $consultaUbica;
	}

	private function execConsultaConfronta($typeDocument, $identificationNumber, $dateExpIdentification, $lastName)
	{
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->expeditionDate = trim($dateExpIdentification);
		$obj->identificationNumber = trim($identificationNumber);
		$obj->lastName = trim($lastName);
		$obj->phone = "3333333";
		try {
			// 2040 Ubica Pruebas
			$port = config('portsWs.confronta');
			$ws = new \SoapClient("http://10.238.14.181:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
			$result = $ws->obtenerCuestionario($obj);  // correcta
			return 1;
		} catch (\Throwable $th) {
			return 0;
		}
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
		$policyCredit = $this->validatePolicyCredit_new($leadInfo['identificationNumber']);

		$solicCredit = $this->addSolicCredit($leadInfo['identificationNumber'], $policyCredit, $estadoSolic, "PASOAPASO", $dataDatosCliente);

		$estado = ($estadoSolic == "APROBADO") ? "APROBADO" : "PREAPROBADO";
		$quotaApprovedProduct = $solicCredit['quotaApprovedProduct'];
		$quotaApprovedAdvance = $solicCredit['quotaApprovedAdvance'];
		return response()->json(['data' => true, 'quota' => $quotaApprovedProduct, 'numSolic' => $solicCredit['infoLead']->numSolic, 'textPreaprobado' => 2, 'quotaAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
	}

	public function validateConsultaUbica($identificationNumber)
	{
		$consecConsultaUbica = DB::connection('oportudata')->select("SELECT `consec` FROM `consulta_ubica` WHERE `cedula` = :identificationNumber ORDER BY consec DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		$getDataCliente = DB::connection('oportudata')->select("SELECT `TEL_EMP`, `TEL2_EMP`, `EMAIL` FROM `CLIENTE_FAB` WHERE  `CEDULA` = :identificationNumber", ['identificationNumber' => $identificationNumber]);
		$consec = $consecConsultaUbica[0]->consec;
		$aprobo = 0;
		// Validacion Celular
		$numLead = $this->getNumLead($identificationNumber, 'normal');
		$celLead = $numLead->NUM;
		$telConsultaUbica = DB::connection('oportudata')->select("SELECT `ubicelular`, `ubiprimerrep` FROM `ubica_celular` WHERE `ubicelular` = :celular AND `ubiconsul` = :consec ", ['celular' => $celLead, 'consec' => $consec]);
		if (!empty($telConsultaUbica)) {
			$aprobo = $this->validateDateUbica($telConsultaUbica[0]->ubiprimerrep);
		} else {
			$aprobo = 0;
		}

		if ($aprobo == 0) {
			// Validacion Telefono empresarial
			if ($getDataCliente[0]->TEL_EMP != '' && $getDataCliente[0]->TEL_EMP != '0') {
				$telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_telefono` WHERE `ubitipoubi` LIKE '%LAB%' AND `ubiconsul` = :consec AND (`ubitelefono` = :tel_emp OR `ubitelefono` = :tel2_emp ) ", ['consec' => $consec, 'tel_emp' => $getDataCliente[0]->TEL_EMP, 'tel2_emp' => $getDataCliente[0]->TEL2_EMP]);
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
			if ($getDataCliente[0]->EMAIL != '') {
				$emailConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_mail` WHERE `ubiconsul` = :consec AND `ubicorreo` = :correo ", ['consec' => $consec, 'correo' => $getDataCliente[0]->EMAIL]);
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

	public function execConsultasleadAsesores($identificationNumber, $nomRefPer, $telRefPer, $nomRefFam, $telRefFam)
	{
		$oportudataLead = DB::connection('oportudata')->select("SELECT `CEDULA`, `TIPO_DOC`, `NOMBRES`, `APELLIDOS`, `FEC_EXP`
		FROM `CLIENTE_FAB`
		WHERE `CEDULA` = :cedula", ['cedula' => $identificationNumber]);

		$lastName = explode(" ", $oportudataLead[0]->APELLIDOS);

		$fechaExpIdentification = explode("-", $oportudataLead[0]->FEC_EXP);
		$fechaExpIdentification = $fechaExpIdentification[2] . "/" . $fechaExpIdentification[1] . "/" . $fechaExpIdentification[0];

		$data = [
			'NOM_REFPER' => $nomRefPer,
			'TEL_REFPER' => $telRefPer,
			'NOM_REFFAM' => $nomRefFam,
			'TEL_REFFAM' => $telRefFam
		];

		$consultasFosyga = $this->execConsultaFosygaLead(
			$identificationNumber,
			$oportudataLead[0]->TIPO_DOC,
			$oportudataLead[0]->FEC_EXP,
			$oportudataLead[0]->NOMBRES,
			$oportudataLead[0]->APELLIDOS
		);

		if ($consultasFosyga == "-1") {
			return "-1";
		}
		if ($consultasFosyga == "-3") {
			return "-3";
		}
		$consultasLead = $this->execConsultasLead($oportudataLead[0]->CEDULA, $oportudataLead[0]->TIPO_DOC, 'PASOAPASO', $lastName[0], $fechaExpIdentification, $data);

		return $consultasLead;
	}

	public function execConsultasLead($identificationNumber, $tipoDoc, $tipoCreacion, $lastName, $dateExpIdentification, $data = [])
	{
		$consultaComercial = $this->execConsultaComercialLead($identificationNumber, $tipoDoc);

		if ($consultaComercial == 0) {
			$customer = $this->customerInterface->findCustomerById($identificationNumber);
			$customer->ESTADO = "SIN COMERCIAL";
			$customer->update();
		} else {
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0
			];

			$policyCredit = $this->validatePolicyCredit_new($identificationNumber);
			$infoLead     = [];
			$infoLead     = $this->getInfoLeadCreate($identificationNumber);

			if ($tipoCreacion == 'PASOAPASO') {
				if ($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2') {
					return [
						'resp'     => $policyCredit,
						'infoLead' => $infoLead
					];
				}
			}
			if ($tipoCreacion == 'CREDITO') {
				if ($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2') {
					return [
						'resp'     => $policyCredit,
						'infoLead' => $infoLead
					];
				}
			}

			$estadoSolic       = 'ANALISIS';
			$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
			$resultUbica = $this->validateConsultaUbica($identificationNumber);
			if ($resultUbica == 0) {
				$confronta = $this->execConsultaConfronta($tipoDoc, $identificationNumber, $dateExpIdentification, $lastName);
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

			if ($policyCredit['estadoCliente'] == 'PREAPROBADO') {
				$estadoSolic = 'ANALISIS';
			}
		}
		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data);
	}

	private function addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data)
	{
		$numSolic = $this->addSolicFab($identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic);
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

		$addDatosCliente = $this->addDatosCliente($dataDatosCliente);
		$addAnalisis = $this->addAnalisis($numSolic, $identificationNumber);
		$infoLead = [];
		$infoLead = $this->getInfoLeadCreate($identificationNumber);
		$infoLead->numSolic = $numSolic->SOLICITUD;
		if ($estadoSolic == "APROBADO") {
			$estadoResult = "APROBADO";
			$tarjeta = $this->addTarjeta($numSolic->SOLICITUD, $identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $infoLead->SUC, $infoLead->TARJETA);
		} else {
			$estadoResult = "PREAPROBADO";
			$turnos = $this->addTurnos($identificationNumber, $numSolic);
		}
		$dataLead = [
			'ESTADO' => $estadoResult,
		];
		$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA', '=', $identificationNumber)->update($dataLead);
		$infoLead = [];
		$infoLead = $this->getInfoLeadCreate($identificationNumber);
		$infoLead->numSolic = $numSolic->SOLICITUD;

		return [
			'estadoCliente'        => $estadoResult,
			'resp'                 => $policyCredit['resp'],
			'infoLead'             => $infoLead,
			'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'],
			'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']
		];
	}

	private function validateDateConsultaUbica($identificationNumber)
	{
		$dateNow = date('Y-m-d');
		$dateNew = strtotime("- $this->daysToIncrement day", strtotime($dateNow));
		$dateNew = date('Y-m-d', $dateNew);
		$dateLastConsultaUbica = DB::connection('oportudata')->select("SELECT fecha FROM consulta_ubica WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if (empty($dateLastConsultaUbica)) {
			return 'true';
		} else {
			$dateLastConsulta = $dateLastConsultaUbica[0]->fecha;

			if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
				return 'true';
			} else {
				return 'false';
			}
		}
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

		$solic_fab = new FactoryRequest;
		$solic_fab->AVANCE_W = $quotaApprovedAdvance;
		$solic_fab->PRODUC_W = $quotaApprovedProduct;
		$solic_fab->CLIENTE = $identificationNumber;
		$solic_fab->CODASESOR = $assessorCode;
		$solic_fab->id_asesor = $assessorCode;
		$solic_fab->ID_EMPRESA = $IdEmpresa[0]->ID_EMPRESA;
		$solic_fab->FECHASOL = date("Y-m-d H:i:s");
		$solic_fab->SUCURSAL = $sucursal;
		$solic_fab->ESTADO = $estado;
		$solic_fab->FTP = 0;
		$solic_fab->STATE = $estado;
		$solic_fab->GRAN_TOTAL = 0;
		$solic_fab->SOLICITUD_WEB = 1;
		$solic_fab->save();
		$numSolic = $this->factoryRequestInterface->getCustomerFactoryRequest($identificationNumber);

		return $numSolic;
	}

	private function addDatosCliente($data = [])
	{
		$datosCliente = new DatosCliente;

		$datosCliente->CEDULA = $data['identificationNumber'];
		$datosCliente->SOLICITUD = $data['numSolic']->SOLICITUD;
		$datosCliente->NOM_REFPER = trim($data['NOM_REFPER']);
		$datosCliente->DIR_REFPER = 'NA';
		$datosCliente->BAR_REFPER = 'NA';
		$datosCliente->TEL_REFPER = trim($data['TEL_REFPER']);
		$datosCliente->CIU_REFPER = 'NA';
		$datosCliente->NOM_REFPE2 = 'NA';
		$datosCliente->DIR_REFPE2 = 'NA';
		$datosCliente->BAR_REFPE2 = 'NA';
		$datosCliente->TEL_REFPE2 = 0;
		$datosCliente->CIU_REFPE2 = " ";
		$datosCliente->NOM_REFFAM = trim($data['NOM_REFFAM']);
		$datosCliente->DIR_REFFAM = 'NA';
		$datosCliente->BAR_REFFAM = 'NA';
		$datosCliente->TEL_REFFAM = trim($data['TEL_REFFAM']);
		$datosCliente->PARENTESCO = " ";
		$datosCliente->NOM_REFFA2 = 'NA';
		$datosCliente->DIR_REFFA2 = 'NA';
		$datosCliente->BAR_REFFA2 = 'NA';
		$datosCliente->TEL_REFFA2 = 0;
		$datosCliente->PARENTESC2 = " ";
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
		$datosCliente->CON_CLI1 = " ";
		$datosCliente->CON_CLI2 = " ";
		$datosCliente->CON_CLI3 = " ";
		$datosCliente->CON_CLI4 = " ";
		$datosCliente->EDIT_RFCLI = " ";
		$datosCliente->EDIT_RFCL2 = " ";
		$datosCliente->EDIT_RFCL3 = " ";
		$datosCliente->INFORMA1 = 'NA';
		$datosCliente->CARGO_INF1 = 'NA';
		$datosCliente->FEC_COM1 = 'NA';
		$datosCliente->FEC_COM2 = 'NA';
		$datosCliente->ART_COM1 = 'NA';
		$datosCliente->ART_COM2 = 'NA';
		$datosCliente->CUOT_COM1 = 'NA';
		$datosCliente->CUOT_COM2 = "Al Dia";
		$datosCliente->HABITO1 = "Al Dia";
		$datosCliente->HABITO2 = "Al Dia";
		$datosCliente->STATE = "A";
		$createData = $datosCliente->save();

		return "true";
	}

	private function addAnalisis($numSolic, $identificationNumber)
	{
		$queryTemp = sprintf("SELECT `paz_cli`, `fos_cliente` FROM `temp_consultaFosyga` WHERE `cedula` = '%s' ORDER BY `id` DESC LIMIT 1 ", $identificationNumber);
		$respQueryTemp = DB::connection('oportudata')->select($queryTemp);

		$analisis = new Analisis;
		$analisis->solicitud = $numSolic->SOLICITUD;
		$analisis->ini_analis = date("Y-m-d H:i:s");
		$analisis->fec_datacli = "1900-01-01 00:00:00";
		$analisis->fec_datacod1 = "1900-01-01 00:00:00";
		$analisis->fec_datacod2 = "1900-01-01 00:00:00";
		$analisis->ini_ref = "1900-01-01 00:00:00";
		$analisis->valor = "0";
		$analisis->rf_fpago = "1900-01-01 00:00:00";
		$analisis->fin_analis = "1900-01-01 00:00:00";
		$analisis->fin_analis = "1900-01-01 00:00:00";
		$analisis->Fin_ref = "1900-01-01 00:00:00";
		$analisis->autoriz = "0";
		$analisis->fact_aur = "0";
		$analisis->ini_def = "1900-01-01 00:00:00";
		$analisis->fin_def = "1900-01-01 00:00:00";
		$analisis->fec_aur = "1900-01-01 00:00:00";
		$analisis->aurfe_cli1 = "1900-01-01 00:00:00";
		$analisis->aurfe_cli3 = "1900-01-01 00:00:00";
		$analisis->aurfe_cli3 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod1 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod12 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod13 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod2 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod21 = "1900-01-01 00:00:00";
		$analisis->aurfe_cod22 = "1900-01-01 00:00:00";
		$analisis->aurcu_cli1 = "0";
		$analisis->aurcu_cli2 = "0";
		$analisis->aurcu_cli3 = "0";
		$analisis->aurcu_cod1 = "0";
		$analisis->aurcu_cod12 = "0";
		$analisis->aurcu_cod13 = "0";
		$analisis->aurcu_cod2 = "0";
		$analisis->scor_cli = "0";
		$analisis->scor_cod1 = "0";
		$analisis->scor_cod2 = "0";
		$analisis->data_cli = "0";
		$analisis->data_cod1 = "0";
		$analisis->data_cod2 = "0";
		$analisis->rec_cod1 = "0";
		$analisis->rec_cod2 = "0";
		$analisis->io_cod1 = "0";
		$analisis->io_cod2 = "0";
		$analisis->aurcu_cod21 = "0";
		$analisis->aurcu_cod22 = "0";
		$analisis->vcu_cli1 = "0";
		$analisis->vcu_cli2 = "0";
		$analisis->vcu_cli3 = "0";
		$analisis->vcu_cod1 = "0";
		$analisis->vcu_cod12 = "0";
		$analisis->vcu_cod13 = "0";
		$analisis->vcu_cod2 = "0";
		$analisis->vcu_cod21 = "0";
		$analisis->vcu_cod22 = "0";
		$analisis->aurcre_cli1 = "0";
		$analisis->aurcre_cli2 = "0";
		$analisis->aurcre_cli3 = "0";
		$analisis->aurcre_cod1 = "0";
		$analisis->aurcre_cod12 = "0";
		$analisis->aurcre_cod13 = "0";
		$analisis->aurcre_cod2 = "0";
		$analisis->aurcre_cod21 = "0";
		$analisis->aurcre_cod22 = "0";
		if (count($respQueryTemp) > 0) {
			$analisis->paz_cli = $respQueryTemp[0]->paz_cli;
			$analisis->fos_cliente = $respQueryTemp[0]->fos_cliente;
		}
		$analisis->save();
	}

	private function addTurnos($identificationNumber, $numSolic)
	{
		$queryScoreLead = sprintf("SELECT `score` FROM `cifin_score` WHERE `scocedula` = %s ORDER BY `scoconsul` DESC LIMIT 1 ", $identificationNumber);
		$respScoreLead = DB::connection('oportudata')->select($queryScoreLead);
		$scoreLead = $respScoreLead[0]->score;

		$turnosOportuya = new TurnosOportuya;
		$turnosOportuya->SOLICITUD = $numSolic->SOLICITUD;
		$turnosOportuya->CEDULA = $identificationNumber;
		$turnosOportuya->FECHA = date("Y-m-d H:i:s");
		$turnosOportuya->SUC = 9999;
		$turnosOportuya->USUARIO = '';
		$turnosOportuya->PRIORIDAD = '2';
		$turnosOportuya->ESTADO = 'ANALISIS';
		$turnosOportuya->TIPO = 'OPORTUYA';
		$turnosOportuya->SUB_TIPO = 'WEB';
		$turnosOportuya->FEC_RET = '1994-09-30 00:00:00';
		$turnosOportuya->FEC_FIN = '1994-09-30 00:00:00';
		$turnosOportuya->VALOR = '0';
		$turnosOportuya->FEC_ASIG = '1994-09-30 00:00:00';
		$turnosOportuya->SCORE = $scoreLead;
		$turnosOportuya->TIPO_CLI = '';
		$turnosOportuya->CED_COD1 = '';
		$turnosOportuya->SCO_COD1 = '0';
		$turnosOportuya->TIPO_COD1 = '';
		$turnosOportuya->CED_COD2 = '';
		$turnosOportuya->SCO_COD2 = '0';
		$turnosOportuya->TIPO_COD2 = '';
		$turnosOportuya->STATE = 'A';
		$turnosOportuya->save();

		return "true";
	}

	private function addTarjeta($numSolic, $identificationNumber, $cupoCompra, $cupoAvance, $sucursal, $tipoTarjetaAprobada)
	{
		$tipoTarjeta = "";
		if ($tipoTarjetaAprobada == 'Tarjeta Black') {
			$tipoTarjeta = 'Black';
		} elseif ($tipoTarjetaAprobada == 'Tarjeta Gray') {
			$tipoTarjeta = 'Gray';
		}
		$tarjeta = new CreditCard;
		$tarjeta->NUMERO = "8712769999999";
		$tarjeta->SOLICITUD = $numSolic;
		$tarjeta->CLIENTE = $identificationNumber;
		$tarjeta->APROBACION = "0";
		$tarjeta->DESPACHO = "0000-00-00";
		$tarjeta->LOTE = "0";
		$tarjeta->FEC_APROB = "0000-00-00";
		$tarjeta->CUOTA_MAN = "9900";
		$tarjeta->CARGO = "9300";
		$tarjeta->CUP_INICIA = $cupoCompra;
		$tarjeta->CUP_COMPRA = $cupoCompra;
		$tarjeta->COMPRA_ACT = $cupoCompra;
		$tarjeta->COMPRA_EFE = "0";
		$tarjeta->CUPO_EFEC = $cupoAvance;
		$tarjeta->CUP_ACTUAL = $cupoAvance;
		$tarjeta->CUPOMAX = 480000;
		$tarjeta->SUC = $sucursal;
		$tarjeta->ESTADO = "I";
		$tarjeta->FEC_ACTIV = "0000-00-00";
		$tarjeta->CONS = "0";
		$tarjeta->OPORTUNID = "0";
		$tarjeta->EXTRACUPO = "0";
		$tarjeta->EXTRA_ACT = "0";
		$tarjeta->RECEPC1 = "";
		$tarjeta->RECEPC2 = "";
		$tarjeta->RECEPC3 = "";
		$tarjeta->FEC_REC = "0000-00-00";
		$tarjeta->OBSTAR1 = "";
		$tarjeta->OBSTAR2 = "";
		$tarjeta->OBSTAR3 = "";
		$tarjeta->TIPO_TAR = $tipoTarjeta;
		$tarjeta->RESPUEST = "";
		$tarjeta->RECEPCOFI = "";
		$tarjeta->OBSTAROFI = "";
		$tarjeta->FEC_RECOFI = "0000-00-00";
		$tarjeta->RECEPCSUC = "";
		$tarjeta->OBSTARSUC = "";
		$tarjeta->FEC_RECSUC = "0000-00-00";
		$tarjeta->RECEPCCLI = "";
		$tarjeta->OBSTARCLI = "";
		$tarjeta->FEC_RECCLI = "0000-00-00";
		$tarjeta->FTP = 0;
		$tarjeta->TOKEN_CE = "";
		$tarjeta->CELULAR_CE = "";
		$tarjeta->STATE = "A";

		$tarjeta->save();

		return true;
	}

	private function getInfoLeadCreate($identificationNumber)
	{
		$queryDataLead = DB::connection('oportudata')->select('SELECT cf.`TIPO_DOC`, cf.`CEDULA`, inten.`TIPO_CLIENTE`, cf.`FEC_NAC`, cf.`TIPOV`, cf.`ACTIVIDAD`, cf.`ACT_IND`, inten.`TIEMPO_LABOR`, cf.`SUELDO`, cf.`OTROS_ING`, cf.`SUELDOIND`, cf.`SUC`, cf.`DIRECCION`, cf.`CELULAR`, cf.`CREACION`, cfs.`score`, inten.`TARJETA`, cf.`ESTADO`, inten.`ID_DEF`, def.`DESCRIPCION`, def.`CARACTERISTICA`
		FROM `CLIENTE_FAB` as cf
		LEFT JOIN `TB_INTENCIONES` as inten ON inten.`CEDULA` = cf.`CEDULA`
		LEFT JOIN `TB_DEFINICIONES` as def ON def.ID_DEF = inten.`ID_DEF`
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
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string $identificationNumber
	 * @return array
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
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string $fecha
	 * @return string age
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
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  none
	 * @return view
	 */
	public function step1()
	{
		$digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		return view('oportuya.step1', ['digitalAnalyst' => $digitalAnalyst[0]]);
	}

	/**
	 * Return step2 view with identificationNumber decrypt
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string
	 * @return view
	 */
	public function step2($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step2', ['identificactionNumber' => $identificactionNumber]);
	}


	/**
	 * Return step3 view with identificationNumber decrypt
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string
	 * @return view
	 */
	public function step3($string)
	{
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step3', ['identificactionNumber' => $identificactionNumber]);
	}

	/**
	 * Encrypt the identificationNumber
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string
	 * @return string
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
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string
	 * @return string
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
