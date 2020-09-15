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
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use App\Entities\CreditCards\Black;
use App\Entities\CreditCards\Gray;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;

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
	private $assessorInterface, $policyInterface, $OportuyaTurnInterface,  $turnInterface, $listProductInterface, $confrontaSelectinterface;
	private $confrontaResultInterface, $toolInterface, $ubicaMailInterface, $ubicaCellPhoneInterfac;
	private $userInterface, $analisisInterface;

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
		AnalisisRepositoryInterface $analisisRepositoryInterface,
		ProductListRepositoryInterface $productListRepositoryInterface,
		ListProductRepositoryInterface $listProductRepositoryInterface,
		ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
		FactorRepositoryInterface $factorRepositoryInterface,
		ConfrontaSelectRepositoryInterface $confrontaSelectRepositoryInterface,
		ConfrontaResultRepositoryInterface $confrontaResultRepositoryInterface,
		ToolRepositoryInterface $toolRepositoryInterface,
		UbicaEmailRepositoryInterface $ubicaEmailRepositoryInterface,
		UbicaCellPhoneRepositoryInterface $ubicaCellPhoneRepositoryInterface,
		UserRepositoryInterface $userRepositoryInterface
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
		$this->listProductInterface				       = $listProductRepositoryInterface;
		$this->productListInterface 		         = $productListRepositoryInterface;
		$this->giveAwayInterface   				       = $listGiveAwayRepositoryInterface;
		$this->factorInterface      			       = $factorRepositoryInterface;
		$this->confrontaSelectinterface          = $confrontaSelectRepositoryInterface;
		$this->confrontaResultInterface          = $confrontaResultRepositoryInterface;
		$this->toolInterface                     = $toolRepositoryInterface;
		$this->ubicaMailInterface                = $ubicaEmailRepositoryInterface;
		$this->ubicaCellPhoneInterfac            = $ubicaCellPhoneRepositoryInterface;
		$this->userInterface                     = $userRepositoryInterface;
	}

	public function index()
	{
		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();
		return view('oportuya.indexV2', ['images' => $images]);
	}

	public function getSubsidiaryCustomer(Request $request)
	{
		if (request()->has('city')) {
			return redirect()->route('catalogo.zona', request()->input('city'));
		}

		$cities = $this->subsidiaryInterface->getSubsidiaryForCities();
		return view('oportuya.getSubsidiary', compact('cities'));
	}
	public function catalog($zone)
	{
		$list = $this->productRepo->listFrontProducts('id');

		$products = $list->map(function (Product $item) {
			return $this->transformProduct($item);
		})->all();

		foreach ($products as $key => $value) {
			$dataProduct[$key] = $this->productRepo->findProductBySlug($products[$key]->slug);
			$productCatalog[$key] = $dataProduct[$key];
			$productListSku[$key] = $this->listProductInterface->findListProductBySku($products[$key]->sku);
			if (!empty($productListSku[$key]->toArray())) {
				$dataProduct[$key] = $this->listProductInterface->getPriceProductForZone($productListSku[$key][0]->id, $zone);
				foreach ($dataProduct[$key] as $key2 => $value2) {
					$productList = $value2;
				}
				$products[$key]['price_old'] =  $productList['normal_public_price'];
				$products[$key]['price_new'] =  $productList['black_public_price'];
				$products[$key]['discount'] =  round($productList['percentage_black_public_price'], 0, PHP_ROUND_HALF_UP);
				$products[$key]['pays'] = round($products[$key]['price_new'] / ($productCatalog[$key]->months * 4), 2, PHP_ROUND_HALF_UP);
			}
		}
		return view('oportuya.catalog', [
			'products' => $products,
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
			'zone'     => $zone
		]);
	}

	public function product($slug, $zone)
	{
		$dataProduct 	= $this->productRepo->findProductBySlug($slug);
		$productCatalog = $dataProduct;
		$productListSku = $this->listProductInterface->findListProductBySku($dataProduct->sku);

		if (!empty($productListSku->toArray())) {
			$dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, $zone);
			foreach ($dataProduct as $key2 => $value2) {
				$productList = $value2;
			}
			$productCatalog['price_old'] =  $productList['normal_public_price'];
			$productCatalog['price_new'] =  $productList['black_public_price'];
			$productCatalog['discount'] =  round($productList['percentage_black_public_price'], 0, PHP_ROUND_HALF_UP);
			$productCatalog['pays'] = round($productCatalog['price_new'] / ($productCatalog->months * 4), 2, PHP_ROUND_HALF_UP);
		}
		$images 		= $productCatalog->images()->get(['src']);
		$imagenes 		= [];
		$productImages 	= [];

		array_push($productImages, $productCatalog->cover);
		foreach ($images as $key => $value) {
			array_push($productImages, $images[$key]->src);
		}
		foreach ($productImages as $key => $value) {
			array_push($imagenes, [$productImages[$key], $key]);
		}

		return view('oportuya.product.show', [
			'product'   => $productCatalog,
			'imagenes'  => $imagenes,
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
			$identificationNumber = trim($request->get('identificationNumber'));
			$customer             = $this->customerInterface->checkIfExists($identificationNumber);
			$assessorCode         = $this->userInterface->getAssessorCode();
			$usuarioCreacion      = (string) $assessorCode;
			$clienteWeb           = 1;
			$clienteWeb = (isset($customer->CLIENTE_WEB)) ? $customer->CLIENTE_WEB : 1;
			$usuarioCreacion = (isset($customer->USUARIO_CREACION)) ? $customer->USUARIO_CREACION : (string) $assessorCode;
			$subsidiaryCityName = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('city'))->CIUDAD;
			$city               = $this->cityInterface->getCityByName($subsidiaryCityName);

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
				'ESTADO'                => "",
				'PASO'                  => "PASO1",
				'ORIGEN'                => $request->get('typeService'),
				'CLIENTE_WEB'           => $clienteWeb,
				'TRAT_DATOS'            => "SI",
				'USUARIO_CREACION'      => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $assessorCode,
				'FECHA_ACTUALIZACION'   => date('Y-m-d H: i: s'),
				'ID_CIUD_UBI'           => trim($city->ID_DIAN),
				'MEDIO_PAGO'            => 12,
			];

			$oportudataLead =	$this->customerInterface->updateOrCreateCustomer($dataOportudata);
			$this->customerCellPhoneInterface->validateCellPhoneCreditFront($request);
			$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;

			// Registraduria
			$consultasRegistraduria = $this->registraduriaInterface->doFosygaRegistraduriaConsult($oportudataLead, $this->daysToIncrement);

			if ($consultasRegistraduria == "-1") {
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

			$lastIntention = $this->intentionInterface->validateDateIntention($identificationNumber,  $this->daysToIncrement);

			if ($lastIntention == "true") {
				$this->intentionInterface->createIntention($data);
			}

			return "1";
		}

		if ($request->get('step') == 2) {
			$identificationNumber = trim($request->get('identificationNumber'));
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
				'PASO' 				=> "PASO2"
			];

			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
			$oportudataLead->update($dataLead);
			$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
			$this->fosygaInterface->doFosygaConsult($oportudataLead, $this->daysToIncrement);

			return response()->json([true]);
		}

		if ($request->get('step') == 3) {
			$identificationNumber = (string) $request->get('identificationNumber');
			$this->timeRejectedVigency = $this->consultationValidityInterface->getRejectedValidity()->rechazado_vigencia;

			if ($this->factoryRequestInterface->checkCustomerHasFactoryRequest($identificationNumber, $this->timeRejectedVigency) == true) {
				return -3; // Tiene solicitud
			}

			$oportudataLead = $this->customerInterface->findCustomerById($identificationNumber);
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
				'PASO' 		=> "PASO3"
			];

			$oportudataLead->update($dataLead);
			$dataDatosCliente = [
				'NOM_REFPER' => $request->get('NOM_REFPER'),
				'TEL_REFPER' => $request->get('TEL_REFPER'),
				'NOM_REFFAM' => $request->get('NOM_REFFAM'),
				'TEL_REFFAM' => $request->get('TEL_REFFAM')
			];

			$consultasLead = $this->execConsultasLead($oportudataLead, 'PASOAPASO', $dataDatosCliente);

			if ($consultasLead['resp'] == 'confronta') {
				return $consultasLead;
			}

			if ($consultasLead['resp'] == '-5') {
				return -5;
			}

			if ($consultasLead['resp'] == '-6') {
				return -5;
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
			if ($estado == '17' || $estado == 'SIN COMERCIAL' || $estado == '19' || $estado == '3') {
				$quotaApprovedProduct = $consultasLead['quotaApprovedProduct'];
				$quotaApprovedAdvance = $consultasLead['quotaApprovedAdvance'];
				return response()->json([
					'data'                 => true,
					'quota'                => $quotaApprovedProduct,
					'numSolic'             => $consultasLead['infoLead']->numSolic,
					'quotaApprovedAdvance' => $quotaApprovedAdvance,
					'estado'               => $estado
				]);
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
		$data = $this->webServiceInterface->sendMessageSms($code, $dateNew, $celNumber);
		$data = json_decode($data, true);
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
		$query = sprintf("SELECT `NOMBRES` as name, `APELLIDOS` as lastName, `EMAIL` as email, `TELFIJO` as telephone, `CIUD_UBI` as city, `TIPO_DOC` as typeDocument, `CEDULA` as identificationNumber, `ACTIVIDAD` as occupation
		FROM `CLIENTE_FAB`
		WHERE `CEDULA` = %s
		LIMIT 1 ", trim($identificationNumber));
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

		return response()->json([
			'leads'       => $result,
			'noExist'     => $noExists,
			'idResultado' => $resultadoPolitica->ID
		]);
	}

	public function downloadResultadoPolitica($id)
	{
		$queryResultado = DB::connection('oportudata')->select("SELECT `RESULTADO`
		FROM `TB_RESULTADO_POLITICA`
		WHERE `ID` = :id ", ['id' => $id]);
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
				$printExcel[] = [
					'FECHA Y HORA DEL PROCESO',
					'TIPO DE DOCUMENTO',
					'CEDULA',
					'NOMBRE TERCERO',
					'RESULTADO',
					'MOTIVO RECHAZO',
					'FECHA DE EXPEDICIÓN DOCUMENTO',
					'SUCURSAL',
					'ZONA RIESGO',
					'SCORE',
					'CALIFICACION',
					'FECHA DE NACIMIENTO',
					'EDAD',
					'ACTIVIDAD ECONOMICA',
					'TIEMPO EN LABOR',
					'INGRESOS',
					'INGRESOS ADICIONALES',
					'TIPO DE CLIENTE',
					'DEFINICION CLIENTE',
					'CLIENTE TIPO AAA',
					'CLIENTE TIPO 5 ESPECIAL',
					'HISTORIAL DE CREDITO',
					'TARJETA APLICABLE',
					'VISITA OCULAR',
					'DIRECCION',
					'CELULAR',
					'TIPO DE VIVIENDA'
				];
			}
			$printExcel[] = [
				$value->FECHA_INTENCION,
				$tipoDoc,
				$value->CEDULA,
				$value->NOMBRES,
				$value->ESTADO,
				$motivoRechazo,
				$value->FEC_EXP,
				$value->SUC,
				$value->ZONA_RIESGO,
				$value->score,
				$value->PERFIL_CREDITICIO,
				$value->FEC_NAC,
				$value->EDAD,
				$value->ACTIVIDAD,
				$tiempoLabor,
				$ingresos,
				$value->OTROS_ING,
				$value->TIPO_CLIENTE,
				$value->DESCRIPCION . "/" . $value->ID_DEF,
				($value->TARJETA == 'Tarjeta Black') ? 'Aplica' : 'No Aplica',
				($value->TIPO_5_ESPECIAL == '1') ? 'Aplica' : 'No Aplica',
				($value->HISTORIAL_CREDITO == '1') ? 'Aplica' : 'No Aplica',
				$value->TARJETA,
				($value->INSPECCION_OCULAR == '1') ? 'Aplica' : 'No Aplica',
				$value->DIRECCION,
				$value->CELULAR,
				$value->TIPOV
			];
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

		$customer = $intencion->customer;
		$this->validatePolicyCredit_new($customer);

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

	private function validatePolicyCredit_new($customer)
	{
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastIntention         = $this->intentionInterface->validateDateIntention($customer->CEDULA,  $this->daysToIncrement);
		$assessorCode          = $this->userInterface->getAssessorCode();

		if ($lastIntention == "true") {
			$intentionData     = ['CEDULA' => $customer->CEDULA, 'ASESOR' => $assessorCode];
			$customerIntention = $this->intentionInterface->createIntention($intentionData);
		} else {
			$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($customer->CEDULA);
			$customerIntention->ASESOR = $assessorCode;
			$customerIntention->save();
		}

		$estadoCliente = "PREAPROBADO";
		//3.1 Estado de documento
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultation($customer->CEDULA);
		if (!empty($getDataRegistraduria)) {
			if ($getDataRegistraduria->fuenteFallo == 'SI') {
				return ['resp' => -6];
			} elseif (!empty($getDataRegistraduria->estado)) {
				if ($getDataRegistraduria->estado != 'VIGENTE') {
					$customer->ESTADO = 'NEGADO';
					$customer->save();
					$customerIntention->ID_DEF            =  '4';
					$customerIntention->ESTADO_INTENCION  = '1';
					$customerIntention->save();
					return ['resp' => "false"];
				}
			} else {
				return ['resp' => "false"];
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		if ($customer->latestCifinScore) {
			$lastCifinScore = $customer->latestCifinScore;
			$customerScore  = $lastCifinScore->score;
		} else {
			$this->commercialConsultationInterface->ConsultarInformacionComercial($customer->CEDULA);
			$lastCifinScore = $customer->latestCifinScore;
			$customerScore  = $lastCifinScore->score;
		}

		$customerStatusDenied  = false;
		$idDef                 = "";
		// 5	Puntaje y 3.4 Calificacion Score
		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			$perfilCrediticio                     = $this->policyInterface->CheckScorePolicy($customerScore);
			$customerStatusDenied                 = $perfilCrediticio['customerStatusDenied'];
			$idDef                                = $perfilCrediticio['idDef'];
			$perfilCrediticio                     = $perfilCrediticio['perfilCrediticio'];
			$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;

			if ($perfilCrediticio == 'TIPO 7') {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerIntention->ID_DEF            = $idDef;
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->CREDIT_DECISION   = 'Negado';
				$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		// 3.3 Estado de obligaciones
		$ValorMoraFinanciero = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($customer->CEDULA, $lastCifinScore->scoconsul)->sum('finvrmora');
		$ValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($customer->CEDULA, $lastCifinScore->scoconsul)->sum('rmvrmora');
		$obligaciones        = $this->policyInterface->validateCustomerArreas($ValorMoraFinanciero, $ValorMoraReal, $customerStatusDenied, $idDef);
		$customerStatusDenied                   = $obligaciones['customerStatusDenied'];
		$idDef                                  = $obligaciones['idDef'];
		$mora = $obligaciones['arreas'];
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
		$historialCrediticio = 0;
		$historialCrediticio = $this->UpToDateFinancialCifinInterface->check6MonthsPaymentVector($customer->CEDULA);

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extintFinancialCifinInterface->check6MonthsPaymentVector($customer->CEDULA);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->UpToDateRealCifinInterface->check6MonthsPaymentVector($customer->CEDULA);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extinctRealCifinInterface->check6MonthsPaymentVector($customer->CEDULA);
		}

		$customerIntention->HISTORIAL_CREDITO = $historialCrediticio;

		$tipoCliente                     = 'NUEVO';
		$customerIntention->TIPO_CLIENTE = $tipoCliente;

		$edad                    = $this->policyInterface->validateCustomerAge($customer, $customerStatusDenied, $tipoCliente, $idDef);
		$customerStatusDenied    = $edad['customerStatusDenied'];
		$idDef                   = $edad['idDef'];
		$customerIntention->EDAD = $edad['edad'];

		$labor                           = $this->policyInterface->validateLabourTime($customer, $customerStatusDenied, $idDef);
		$customerStatusDenied            = $labor['customerStatusDenied'];
		$idDef                           = $labor['idDef'];
		$customerIntention->TIEMPO_LABOR = $labor['labor'];

		$ocular  = $this->policyInterface->validaOccularInspection($customer, $tipoCliente, $perfilCrediticio);
		$customerIntention->INSPECCION_OCULAR = $ocular;
		$customerIntention->ZONA_RIESGO       = $this->subsidiaryInterface->getSubsidiaryRiskZone($customer->SUC)->ZONA;
		$customerIntention->save();

		// 3.6 Tarjeta Black
		$aprobado = false;
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

		if ($aprobado) {
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->save();
		}

		if ($aprobado == false && $customerIntention->PERFIL_CREDITICIO == 'TIPO A') {
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

		// 2. WS Fosyga
		$fuenteFallo = "false";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultation($customer->CEDULA);
		if (!empty($getDataFosyga)) {
			if ($getDataFosyga->fuenteFallo == 'SI') {
				$fuenteFallo = "true";
			} elseif (empty($getDataFosyga->estado) || empty($getDataFosyga->regimen) || empty($getDataFosyga->tipoAfiliado)) {
				$fuenteFallo = "true";
			} else {
				if ($getDataFosyga->estado != 'ACTIVO' || $getDataFosyga->regimen != 'CONTRIBUTIVO' || $getDataFosyga->tipoAfiliado != 'COTIZANTE') {
					$statusAfiliationCustomer = false;
					$fuenteFallo = "false";
				}
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = $this->policyInterface->validateTipoEspecial($perfilCrediticio, $customer->ACTIVIDAD, $statusAfiliationCustomer);
		$customerIntention->TIPO_5_ESPECiAL = $tipo5Especial;
		$customerIntention->save();

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
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente
					];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO                    = 'PREAPROBADO';
					$customerIntention->TARJETA          = $tarjeta;
					$customerIntention->ID_DEF           = '15';
					$customerIntention->ESTADO_INTENCION = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente
					];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO                    = 'PREAPROBADO';
					$customerIntention->TARJETA          = $tarjeta;
					$customerIntention->ID_DEF           = '16';
					$customerIntention->ESTADO_INTENCION = '2';
					$customer->save();
					$customerIntention->save();
					return [
						'resp'                 => "true",
						'quotaApprovedProduct' => $quotaApprovedProduct,
						'quotaApprovedAdvance' => $quotaApprovedAdvance,
						'estadoCliente'        => $estadoCliente
					];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO                    = 'PREAPROBADO';
						$customerIntention->TARJETA          = $tarjeta;
						$customerIntention->ID_DEF           = '17';
						$customerIntention->ESTADO_INTENCION = '2';
						$customer->save();
						$customerIntention->save();
						return [
							'resp'                 => "true",
							'quotaApprovedProduct' => $quotaApprovedProduct,
							'quotaApprovedAdvance' => $quotaApprovedAdvance,
							'estadoCliente'        => $estadoCliente
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

	public function validateConsultaUbica($customer)
	{
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
				$telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep`
				FROM `ubica_telefono`
				WHERE `ubitipoubi` LIKE '%LAB%'
				AND `ubiconsul` = :consec
				AND (`ubitelefono` = :tel_emp
				OR `ubitelefono` = :tel2_emp ) ", ['consec' => $consec, 'tel_emp' => $customer->TEL_EMP, 'tel2_emp' => $customer->TEL2_EMP]);
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
		$solicCredit = $this->addSolicCredit($leadInfo['identificationNumber'], $policyCredit, $estadoSolic, "PASOAPASO", $dataDatosCliente);

		return response()->json([
			'data'            => true,
			'quota'           => $solicCredit['quotaApprovedProduct'],
			'numSolic'        => $solicCredit['infoLead']->numSolic,
			'textPreaprobado' => 2,
			'quotaAdvance'    => $solicCredit['quotaApprovedAdvance'],
			'estado'          => ($estadoSolic == 19) ? "APROBADO" : "PREAPROBADO"
		]);
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

			$policyCredit = $this->validatePolicyCredit_new($oportudataLead);
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

	public function execConsultasLead($customer, $tipoCreacion, $data = [])
	{
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$consultaComercial     = $this->commercialConsultationInterface->doConsultaComercial($customer, $this->daysToIncrement);
		$lastIntention         = $this->intentionInterface->validateDateIntention($customer->CEDULA,  $this->daysToIncrement);
		$estadoSolic           = 3;

		if ($consultaComercial == 0) {
			$customer->ESTADO = "SIN COMERCIAL";
			$customer->save();

			$dataIntention = [
				'CEDULA' => $customer->CEDULA,
				'ESTADO_INTENCION' => 3
			];

			if ($lastIntention == "true") {
				$this->intentionInterface->createIntention($dataIntention);
			}

			return $policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0,
				'resp'                 => -5
			];
		} else {
			$policyCredit = [
				'quotaApprovedProduct' => 0,
				'quotaApprovedAdvance' => 0
			];

			$policyCredit = $this->validatePolicyCredit_new($customer);
			$infoLead     = [];
			$infoLead     = $this->getInfoLeadCreate($customer->CEDULA);

			if ($policyCredit['resp'] == '-6') {
				return ['resp' => -6];
			}

			if ($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2') {
				return [
					'resp'     => $policyCredit,
					'infoLead' => $infoLead
				];
			}

			$lastName = $this->customerInterface->getcustomerFirstLastName($customer->APELLIDOS);
			$this->ubicaInterface->doConsultaUbica($customer, $lastName, $this->daysToIncrement);
			$resultUbica = $this->validateConsultaUbica($customer);

			if ($resultUbica == 0) {
				$fechaExpIdentification = $this->toolInterface->getConfrontaDateFormat($customer->FEC_EXP);
				$confronta = $this->webServiceInterface->execConsultaConfronta($customer->TIPO_DOC, $customer->CEDULA, $fechaExpIdentification, $lastName);
				if ($confronta == 1) {
					$form = $this->toolInterface->getFormConfronta($customer->CEDULA);
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
		return $this->addSolicCredit($customer, $policyCredit, $estadoSolic, $tipoCreacion, $data);
	}

	public function decisionCreditCard($lastName, $identificationNumber, $quotaApprovedProduct, $quotaApprovedAdvance, $dateExpIdentification, $nom_refper, $tel_refper, $nom_reffam, $tel_reffam)
	{
		$customer  = $this->customerInterface->findCustomerById($identificationNumber);
		$intention = $customer->latestIntention;
		$intention->CREDIT_DECISION = 'Tarjeta Oportuya';
		$intention->save();
		$estadoSolic = 3;
		$this->daysToIncrement = $this->consultationValidityInterface->getConsultationValidity()->pub_vigencia;
		$lastName = $this->customerInterface->getcustomerFirstLastName($customer->APELLIDOS);
		$this->ubicaInterface->doConsultaUbica($customer, $lastName, $this->daysToIncrement);
		$resultUbica = $this->validateConsultaUbica($customer);

		if ($resultUbica == 0) {
			$fechaExpIdentification = $this->toolInterface->getConfrontaDateFormat($customer->FEC_EXP);
			$confronta = $this->webServiceInterface->execConsultaConfronta($customer->TIPO_DOC, $identificationNumber, $fechaExpIdentification, $lastName);
			if ($confronta == 1) {
				$form = $this->toolInterface->getFormConfronta($identificationNumber);
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
		$intention = $customer->latestIntention;
		$intention->CREDIT_DECISION = 'Tradicional';
		$intention->save();

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

		return $this->addSolicCredit($identificationNumber, $policyCredit, 1, "", $data);
	}

	private function addSolicCredit($customer, $policyCredit, $estadoSolic, $tipoCreacion, $data)
	{
		$factoryRequest = $this->addSolicFab($customer, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic);
		$numSolic = $factoryRequest->SOLICITUD;

		if (!empty($data)) {
			$dataDatosCliente = [
				'identificationNumber' => $customer->CEDULA,
				'numSolic'             => $numSolic,
				'NOM_REFPER'           => $data['NOM_REFPER'],
				'TEL_REFPER'           => $data['TEL_REFPER'],
				'NOM_REFFAM'           => $data['NOM_REFFAM'],
				'TEL_REFFAM'           => $data['TEL_REFFAM']
			];
		} else {
			$dataDatosCliente = [
				'identificationNumber' => $customer->CEDULA,
				'numSolic'             => $numSolic,
				'NOM_REFPER'           => 'NA',
				'TEL_REFPER'           => 'NA',
				'NOM_REFFAM'           => 'NA',
				'TEL_REFFAM'           => 'NA'
			];
		}

		$this->datosClienteInterface->addDatosCliente($dataDatosCliente);
		$fosygaTemp = $customer->customerFosygaTemps->first();

		$analisisData = [
			'solicitud'      => $numSolic,
		];

		if ($fosygaTemp) {
			$analisisData['paz_cli']  = $fosygaTemp->paz_cli;
			$analisisData['fos_cliente']     = $fosygaTemp->fos_cliente;
		}

		$this->analisisInterface->addAnalisis($analisisData);

		$infoLead           = (object) [];
		if ($estadoSolic != 3) {
			$infoLead = $this->getInfoLeadCreate($customer->CEDULA);
		}

		$infoLead->numSolic = $numSolic;

		if ($estadoSolic == 19) {
			$customer->ESTADO = "APROBADO";
			$customer->save();
			$customerIntention = $customer->latestIntention;
			$customerIntention->ESTADO_INTENCION = 4;
			$customerIntention->save();
			$estadoResult = "APROBADO";
			$this->creditCardInterface->createCreditCard($numSolic, $customer->CEDULA, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $infoLead->SUC, $infoLead->TARJETA);
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
			$infoLead = $this->getInfoLeadCreate($customer->CEDULA);
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
		$assessorCode      = $this->userInterface->getAssessorCode();
		$customerIntention = $this->intentionInterface->findLatestCustomerIntentionByCedula($customer->CEDULA);
		$sucursal          = $this->subsidiaryInterface->getSubsidiaryCodeByCity($customer->CIUD_UBI)->CODIGO;
		$assessorData      = $this->assessorInterface->findAssessorById($assessorCode);

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
			'SOLICITUD_WEB' => $customerIntention->id

		];

		$customerFactoryRequest = $this->factoryRequestInterface->addFactoryRequest($requestData);
		$factoryRequest = $this->factoryRequestInterface->findFactoryRequestById($customerFactoryRequest->SOLICITUD);
		$factoryRequest->states()->attach($estado, ['usuario' => $assessorCode]);
		return $customerFactoryRequest;
	}

	private function addTurnos($identificationNumber, $numSolic)
	{
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$respScoreLead  = $customer->latestCifinScore->score;
		$scoreLead      = 0;

		if (!empty($respScoreLead)) {
			$scoreLead = $respScoreLead->score;
		}

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

		$this->turnInterface->addTurn($turnData);

		return "true";
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
		$query = "SELECT CODIGO as value, CIUDAD as label
		FROM SUCURSALES
		WHERE PRINCIPAL = 1
		AND STATE='A'
		ORDER BY CIUDAD ASC";
		$resp = DB::connection('oportudata')->select($query);

		return $resp;
	}

	public function getDataStep2($identificationNumber)
	{
		$data = [];
		$query2 = "SELECT `CODIGO` as value, `NOMBRE` as label FROM `CIUDADES` WHERE `STATE` = 'A' ORDER BY NOMBRE ";
		$queryOportudataLead = sprintf("SELECT NOMBRES as name, APELLIDOS as lastName, SUC as branchOffice, CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, TELFIJO as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum
		FROM CLIENTE_FAB
		WHERE CEDULA = %s ", $identificationNumber);
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
