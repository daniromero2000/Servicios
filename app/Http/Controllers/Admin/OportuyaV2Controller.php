<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Application;
use App\Lead;
use App\LeadInfo;
use App\OportuyaV2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OportuyaV2Controller extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$images=Imagenes::selectRaw('*')
						->where('category','=','1')
						->where('isSlide','=','1')
						->get();
		return view('oportuya.indexV2',['images'=>$images]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{	
		//get step 1 request from sended by form

		if(($request->get('step'))==1){
			$this->validate($request, [
            	'g-recaptcha-response' => 'required|captcha',
        	]);
			$identificationNumber = $request->get('identificationNumber');
			$dateConsultaComercial = $this->validateDateConsultaComercial($identificationNumber);
			if($dateConsultaComercial == 'true'){
				$consultaComercial = $this->execConsultaComercial($identificationNumber, $request->get('typeDocument'));
			}

			$validatePolicyCredit = $this->validatePolicyCredit($identificationNumber);
			//catch data from request and values assigning to leads table columns
			$departament = $this->getCodeAndDepartmentCity($request->get('city'));
			$flag=0;
			$lead= new Lead;
			$leadInfo= new LeadInfo;
			$response = false;
			$assessorCode=($request->get('assessor') !== NULL)?$request->get('assessor'):NULL;
			$dataLead=[
				'typeDocument'=> $request->get('typeDocument'),
				'identificationNumber'=> $identificationNumber,
				'assessor' => $assessorCode,
				'name'=> $request->get('name'),
				'lastName'=> $request->get('lastName'),
				'email'=> $request->get('email'),
				'channel'=>  1,
				'telephone'=> $request->get('telephone'),
				'occupation' =>  $request->get('occupation'),
				'termsAndConditions'=> $request->get('termsAndConditions'),
				'city' =>  $request->get('city'),
				'typeProduct' =>  '',
				'typeService' =>  $request->get('typeService')
			];

			
			//verify if a customer exist before save a lead , then save data into leads table.
			$createLead = $lead->updateOrCreate(['identificationNumber'=>$identificationNumber],$dataLead)->save();
			//get id throught identification number from leads table 
			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead= $idLead[0]->id;

			$lead=Lead::findOrFail($idLead);
			$lead->occupation = $request->get('occupation');
			$lead->save();

			//if updateOrCreate method fails save data without verify its existent, then save data into leads table
			if($createLead != true){

				$identificationNumber = $request->get('identificationNumber');
				$lead->typeDocument=$request->get('typeDocument');
				$lead->identificationNumber=$identificationNumber;	
				$lead->name=$request->get('name');
				$lead->lastName=$request->get('lastName');
				$lead->email=$request->get('email');
				$lead->channel= 1;
				$lead->telephone=$request->get('telephone');
				$lead->occupation = $request->get('occupation');
				$lead->termsAndConditions=$request->get('termsAndConditions');
				$lead->city= $request->get('city');
				$lead->typeProduct = $request->get('typeProduct');
				$lead->typeService = $request->get('typeService');
				$response = $lead->save();

			}


			//if data was saving into leads table successfully, data is stored into Oportudata CLIENTES_FAB table 

			if(($response == true) || ($createLead == true)){

				// $flag =1 means  data into leads table was saved correctly
				$flag=1;
				
				$oportudataLead= new OportuyaV2;
				$oportudataLead->setConnection('oportudata');
				$dataoportudata=[
					'TIPO_DOC' => $request->get('typeDocument'),
					'CEDULA' => $identificationNumber,
					'NOMBRES' => strtoupper($request->get('name')),
					'APELLIDOS' => strtoupper($request->get('lastName')),
					'EMAIL' => $request->get('email'),
					'CELULAR' =>$request->get('telephone'),
					'PROFESION' => 'NO APLICA',
					'ACTIVIDAD' => strtoupper($request->get('occupation')),
					'CIUD_UBI' => $request->get('city'),
					'DEPTO' => $departament->departament,
					'TIPOCLIENTE' => 'OPORTUYA',
					'SUBTIPO' => 'WEB',
					'STATE' => 'A',
					'SUC' => ($request->get('branchOffice') != '') ? $request->get('branchOffice') : 9999,
					'CREACION' => date("Y-m-d H:i:s")
				];

				//verify if a customer exist before save a lead , then save data into CLIENTES_FAB table.
				$createOportudaLead = $oportudataLead->updateOrCreate(['CEDULA'=>$identificationNumber],$dataoportudata)->save();

				//if updateOrCreate method fails save data without verify its existent, then save data into CLIENTES_FAB table
				if($createOportudaLead != true){

					$oportudataLead->TIPO_DOC = $request->get('typeDocument');
					$oportudataLead->CEDULA = $identificationNumber;
					$oportudataLead->NOMBRES = $request->get('name');
					$oportudataLead->APELLIDOS = $request->get('lastName');
					$oportudataLead->EMAIL = $request->get('email');
					$oportudataLead->CELULAR = $request->get('telephone');
					$oportudataLead->PROFESION = $request->get('occupation');

					$response = $oportudataLead->save();

				}

				if(($response == true) || ($createOportudaLead== true)){
					// $flag =2 means  data into leads and CLIENTES_FAB table was saved correctly
					$flag=2;
				}

			}

			
			if($validatePolicyCredit == false){
				return redirect()->route('thankYouPageOportuyaDenied');
			}
			if($flag==2){
				
				$identificationNumberEncrypt = $this->encrypt($identificationNumber);
				if($assessorCode != NULL){
					return redirect()->route('step2Assessor', ['numIdentification' => $identificationNumberEncrypt]);
				}
				return redirect()->route('step2Oportuya', ['numIdentification' => $identificationNumberEncrypt]);
			}elseif ($flag==1) {
				return response()->json(['servicios'=>$response]);
			}else{
				return response()->json([true]);
			}		
		}


		//get step 2 from request form

		if($request->get('step')==2){
			$flag= 0;
			$identificationNumber = $request->get('identificationNumber');

			$flag=1;
			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
			$dataLead=[
				'DIRECCION' => strtoupper($request->get('addres')),
				'FEC_NAC' => $request->get('birthdate'),
				'EDAD' => $this->calculateAge($request->get('birthdate')),
				'CIUD_EXP' => $request->get('cityExpedition'),
				'ESTADOCIVIL' => strtoupper($request->get('civilStatus')),
				'FEC_EXP' => $request->get('dateDocumentExpedition'),
				'PROPIETARIO' => ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')) : 'NA' ,
				'SEXO' => strtoupper($request->get('gender')),
				'TIPOV' => strtoupper($request->get('housingType')),
				'TIEMPO_VIV' => $request->get('housingTime'),
				'TELFIJO' => $request->get('housingTelephone'),
				'VRARRIENDO' => ($request->get('leaseValue') != '') ? $request->get('leaseValue') : 0,
				'EPS_CONYU' => ($request->get('spouseEps') != '') ? strtoupper($request->get('spouseEps')) : 'NA',
				'CEDULA_C' => ($request->get('spouseIdentificationNumber') != '') ? $request->get('spouseIdentificationNumber') : '0',
				'TRABAJO_CONYU' => ($request->get('spouseJob')) ? strtoupper($request->get('spouseJob')) : 'NA' ,
				'CARGO_CONYU' => ($request->get('spouseJobName') != '') ? strtoupper($request->get('spouseJobName')) : 'NA',
				'NOMBRE_CONYU' => ($request->get('spouseName') != '') ? strtoupper($request->get('spouseName')) : 'NA',
				'PROFESION_CONYU' => ($request->get('spouseProfession') != '') ? strtoupper($request->get('spouseProfession')) : 'NA' ,
				'SALARIO_CONYU' => ($request->get('spouseSalary') != '') ? $request->get('spouseSalary') : '0',
				'CELULAR_CONYU' => ($request->get('spouseTelephone') != '') ? $request->get('spouseTelephone') : '0',
				'ESTRATO' => $request->get('stratum'),
				'PERSONAS' => 0,
				'ESTUDIOS' => 'NA',
				'POSEEVEH' => 'N',
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

			$identificationNumber = (string)$identificationNumber;

			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

			return response()->json([true]);
		}


		if($request->get('step')==3){

			$flag=0;

			$identificationNumber = $request->get('identificationNumber');
			$selectAssessor=DB::table('leads')->selectRaw('assessor, created_at as dateLead')
					->whereRaw('identificationNumber = ?',$identificationNumber)->get();

			$codeAssessor=$selectAssessor[0]->assessor;
			$dateLead=$selectAssessor[0]->dateLead;
			$sucursal=9999;
			$estado='CANAL_DIGITAL';
			$ftp=0;
			$state='X';
			$granTotal=0;
				
			$flag = 1;

			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();

			$dataLead=[
				'NIT_EMP' => ($request->get('nit') != '') ? $request->get('nit') : 0,
				'RAZON_SOC' => ($request->get('companyName') != '') ? strtoupper($request->get('companyName')) : 'NA',
				'DIR_EMP' => ($request->get('companyAddres') != '') ? strtoupper($request->get('companyAddres')) : 'NA',
				'TEL_EMP' => ($request->get('companyTelephone') != '') ? $request->get('companyTelephone') : 0,
				'TEL2_EMP'	=> ($request->get('companyTelephone2') != '') ? $request->get('companyTelephone2') : 0,
				'ACT_ECO' => ($request->get('eps') != '') ? strtoupper($request->get('eps')) : '-',
				'CARGO' => ($request->get('companyPosition') != '') ? strtoupper($request->get('companyPosition')) : 'NA',
				'FEC_ING' => ($request->get('admissionDate') != '') ? $request->get('admissionDate') : '0000/1/1',
				'ANTIG' => ($request->get('antiquity') != '') ? $request->get('antiquity') : 1,
				'SUELDO' => ($request->get('salary') != '') ? $request->get('salary') : 0,
				'TIPO_CONT' => ($request->get('typeContract') != '') ? strtoupper($request->get('typeContract')) : 'NA',
				'OTROS_ING' => ($request->get('otherRevenue') != '') ? $request->get('otherRevenue') : 0,
				'CAMARAC' => ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'NIT_IND' => ($request->get('nitInd') != '') ? $request->get('nitInd') : 0,
				'RAZON_IND' => ($request->get('companyNameInd') != '') ? $request->get('companyNameInd') : 'NA',
				'ACT_IND' => ($request->get('whatSell') != '') ? $request->get('whatSell') : 'NA',
				'FEC_CONST' => ($request->get('dateCreationCompany') != '') ? $request->get('dateCreationCompany') : '0000/1/1',
				'EDAD_INDP' => ($request->get('antiquityInd') != '') ? $request->get('antiquityInd') : 1,
				'SUELDOIND' => ($request->get('salaryInd') != '') ? $request->get('salaryInd') : 0,
				'BANCOP' => ($request->get('bankSavingsAccount') != '') ? $request->get('bankSavingsAccount') : 'NA'
			];

			

			$identificationNumber = (string)$identificationNumber;

			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

			$solic_fab= new Application;

			$solic_fab->setConnection('oportudata');

			$soliData=[
				'CLIENTE'=>$identificationNumber,
				'CODASESOR'=>$codeAssessor,
				'FECHASOL'=>date("Y-m-d H:i:s",strtotime($dateLead)),
				'SUCURSAL'=>$sucursal,
				'ESTADO'=>$estado,
				'FTP'=>$ftp,
				'STATE'=>$state
			];

			$solic_fab->CLIENTE=$identificationNumber;
			$solic_fab->CODASESOR=$codeAssessor;
			$solic_fab->FECHASOL=date("Y-m-d H:i:s",strtotime($dateLead));
			$solic_fab->SUCURSAL=$sucursal;
			$solic_fab->ESTADO=$estado;
			$solic_fab->FTP=$ftp;
			$solic_fab->CODASESOR=$codeAssessor;
			$solic_fab->STATE=$state;
			$solic_fab->GRAN_TOTAL=$granTotal;


			$solic_fab->save();

			//$createOportudaLead = $solic_fab->updateOrCreate(['CLIENTE'=>$identificationNumber],$soliData)->save();


			return response()->json([true]);

		}

		if ($request->get('step') == 'comment') {
			$identificationNumber = $request->get('identificationNumber');

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead= $idLead[0]->id;

			$idLeadInfo = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`= :idLead',['idLead'=>$idLead]);
			$idLeadInfo= $idLeadInfo[0]->id;


			$leadInfo=LeadInfo::findOrFail($idLeadInfo);
			$leadInfo->availability = $request->get('availability');
			$leadInfo->comment = $request->get('comment');

			$response = $leadInfo->save();

			return response()->json([true]);
		}
		
	}

	private function validateDateConsultaComercial($identificationNumber){
		$dateNow = date('Y-m-d');
		$dateTwoMonths = strtotime ( '-2 month' , strtotime ( $dateNow ) ) ;
		$dateTwoMonths = date ( 'Y-m-d' , $dateTwoMonths );
		$dateLastConsultaComercial = DB::connection('oportudata')->select("SELECT fecha FROM consulta_ws WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastConsultaComercial)){
			return 'true';
		}else{
			$dateLastConsulta = $dateLastConsultaComercial[0]->fecha;

			if(strtotime($dateLastConsulta) < strtotime($dateTwoMonths)){
				return 'true';
			}else{
				return 'false';
			}	
		}
	}

	private function validatePolicyCredit($identificationNumber){
		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($queryScoreClient)){
			return false;
		}else{
			$respScoreClient = $queryScoreClient[0]->score;

			$queryScoreCreditPolicy = DB::connection('mysql')->select("SELECT score FROM credit_policy LIMIT 1");
			$respScoreCreditPolicy = $queryScoreCreditPolicy[0]->score;
			
			if($respScoreClient > $respScoreCreditPolicy){
				return true;
			}else{
				return false;
			}
		}
	}

	private function execConsultaComercial($identificationNumber, $typeDocument){
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->identificationNumber = trim($identificationNumber);
		$ws = new \SoapClient("http://10.238.14.181:2923/Service1.svc?singleWsdl",array());
		$result = $ws->ConsultarInformacionComercial($obj);
	}

	public function getDataStep2($identificationNumber){
	      $data = [];

	      $query2 = "SELECT `code` as value, `name` as label FROM `ciudades` ORDER BY name ";

	      $queryOportudataLead = sprintf("SELECT NOMBRES as `name`, APELLIDOS as `lastName`, SUC as branchOffice, CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, FEC_EXP as dateDocumentExpedition, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, TELFIJO as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);

	      $respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
	      $resp2 = DB::select($query2);

	      $digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

	      $data['digitalAnalyst'] = $digitalAnalysts[0];
	      $data['cities'] = $resp2;
	      $data['oportudataLead'] = $respOportudataLead[0];

	      return $data;

	}

	/*public function getDataConsultation($identificationNumber){

		$dataLead=DB::table('leads')->selectRaw('identificationNumber as ced, assessor, created_at as dateLead')
					->whereRaw('identificationNumber = ?',$identificationNumber)->get();

		return $dataLead;
	}*/

	public function getDataStep3($identificationNumber){
	      $data = [];

	      $query2 = "SELECT `CODIGO` as value, `BANCO` as label FROM BANCO ";
	      $queryOportudataLead = sprintf("SELECT NOMBRES as `name`, APELLIDOS as `lastName`, CEDULA as identificationNumber, ACTIVIDAD as `occupation` ,NIT_EMP as nit, RAZON_SOC as companyName, DIR_EMP as companyAddres, TEL_EMP as companyTelephone, TEL2_EMP as companyTelephone2, ACT_ECO as eps, CARGO as companyPosition, FEC_ING as admissionDate, ANTIG as antiquity, SUELDO as salary, TIPO_CONT as typeContract, OTROS_ING as otherRevenue, `CAMARAC` as camaraComercio, `NIT_IND` as nitInd, `RAZON_IND` as companyNameInd, `FEC_CONST` as dateCreationCompany, `EDAD_INDP` as antiquityInd, `SUELDOIND` as salaryInd, `BANCOP` as bankSavingsAccount, `ACT_IND` as whatSell
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

	private function getCodeAndDepartmentCity($nameCity){
		$query = sprintf('SELECT `departament` FROM `ciudades` WHERE `name` = "%s" LIMIT 1 ', $nameCity);
		$resp = DB::select($query);

		return $resp[0];
	}

	private function calculateAge($fecha){
		$time = strtotime($fecha);
		$now = time();
		$age = ($now-$time)/(60*60*24*365.25);
		$age = floor($age);

		return $age;
	}

	public function step1(){
		$cities = [
			[ 'label' => 'ARMENIA', 'value' => 'ARMENIA' ],
			[ 'label' => 'MANIZALES', 'value' => 'MANIZALES' ],
			[ 'label' => 'SINCELEJO', 'value' => 'SINCELEJO' ],
			[ 'label' => 'YOPAL', 'value' => 'YOPAL' ],
			[ 'label' => 'CERETÉ', 'value' => 'CERETÉ' ],
			[ 'label' => 'TULUÁ', 'value' => 'TULUÁ' ],
			[ 'label' => 'ACACÍAS', 'value' => 'ACACÍAS' ],
			[ 'label' => 'ESPINAL', 'value' => 'ESPINAL' ],
			[ 'label' => 'MARIQUITA', 'value' => 'MARIQUITA' ],
			[ 'label' => 'CARTAGENA', 'value' => 'CARTAGENA' ],
			[ 'label' => 'LA DORADA', 'value' => 'LA DORADA' ],
			[ 'label' => 'IBAGUÉ', 'value' => 'IBAGUÉ' ],
			[ 'label' => 'MONTERÍA', 'value' => 'MONTERÍA' ],
			[ 'label' => 'MAGANGUÉ', 'value' => 'MAGANGUÉ' ],
			[ 'label' => 'PEREIRA', 'value' => 'PEREIRA' ],
			[ 'label' => 'CALI', 'value' => 'CALI' ],
			[ 'label' => 'MONTELIBANO', 'value' => 'MONTELIBANO' ],
			[ 'label' => 'SAHAGÚN', 'value' => 'SAHAGÚN' ],
			[ 'label' => 'PLANETA RICA', 'value' => 'PLANETA RICA' ],
			[ 'label' => 'COROZAL', 'value' => 'COROZAL' ],
			[ 'label' => 'CIÉNAGA', 'value' => 'CIÉNAGA' ],
			[ 'label' => 'MONTELÍ', 'value' => 'MONTELÍ' ],
			[ 'label' => 'PLATO', 'value' => 'PLATO' ],
			[ 'label' => 'SABANALARGA', 'value' => 'SABANALARGA' ],
			[ 'label' => 'GRANADA', 'value' => 'GRANADA' ],
			[ 'label' => 'PUERTO BERRÍ', 'value' => 'PUERTO BERRÍ' ],
			[ 'label' => 'VILLAVICENCIO', 'value' => 'VILLAVICENCIO' ],
			[ 'label' => 'TAURAMENA', 'value' => 'TAURAMENA' ],
			[ 'label' => 'PUERTO GAITÁN', 'value' => 'PUERTO GAITÁN' ],
			[ 'label' => 'PUERTO BOYACÁ', 'value' => 'PUERTO BOYACÁ' ],
			[ 'label' => 'PUERTO LÓPEZ', 'value' => 'PUERTO LÓPEZ' ],
			[ 'label' => 'SEVILLA', 'value' => 'SEVILLA' ],
			[ 'label' => 'CHINCHINÁ', 'value' => 'CHINCHINÁ' ],
			[ 'label' => 'AGUACHICA', 'value' => 'AGUACHICA' ],
			[ 'label' => 'BARRANCABERMEJA', 'value' => 'BARRANCABERMEJA' ],
			[ 'label' => 'LA VIRGINIA', 'value' => 'LA VIRGINIA' ],
			[ 'label' => 'SANTA ROSA DE CABAL', 'value' => 'SANTA ROSA DE CABAL' ],
			[ 'label' => 'GIRARDOT', 'value' => 'GIRARDOT' ],
			[ 'label' => 'VILLANUEVA', 'value' => 'VILLANUEVA' ],
			[ 'label' => 'PITALITO', 'value' => 'PITALITO' ],
			[ 'label' => 'GARZÓN', 'value' => 'GARZÓN' ],
			[ 'label' => 'NEIVA', 'value' => 'NEIVA' ],
			[ 'label' => 'LORICA', 'value' => 'LORICA' ],
			[ 'label' => 'AGUAZUL',  'value' => 'AGUAZUL']
		];
		$digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		return view('oportuya.step1', ['digitalAnalyst' => $digitalAnalyst[0], 'cities' => array_sort($cities, 'label', SORT_DESC)]);
	}

	public function step2($string){
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step2', ['identificactionNumber' => $identificactionNumber]);
	}

	public function step3($string){
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step3', ['identificactionNumber' => $identificactionNumber]);
	}

	public function encrypt($string) {
		$string = utf8_encode($string);
		$control1 = "*]wy";
		$control2 = "3/~";
		$string = $control1.$string.$control2;
		$string = base64_encode($string);

		return $string;
	} 

	public function decrypt($string){
		$string = $string; 
		$string = base64_decode($string); 
		$controls = ['*]wy', '3/~']; 
		$replaces = ['', ''];
		$string = str_replace($controls, $replaces, $string); 

		return $string;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
