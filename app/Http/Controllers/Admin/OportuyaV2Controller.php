<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Lead;
use App\LeadInfo;
use App\OportuyaV2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OportuyaV2Controller extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
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
		$images=Imagenes::selectRaw('*')
						->where('category','=','1')
						->where('isSlide','=','1')
						->get();
		return view('oportuya.indexV2',['images'=>$images, 'cities' => array_sort($cities, 'label', SORT_DESC)]);
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

		if(($request->get('step'))==1){	
					
			$flag=0;
			$lead= new Lead;
			$leadInfo= new LeadInfo;
			$identificationNumber = $request->get('identificationNumber');
			$response = false;

			$dataLead=[
				'typeDocument'=> $request->get('typeDocument'),
				'identificationNumber'=> $identificationNumber,
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


			$createLead = $lead->updateOrCreate(['identificationNumber'=>$identificationNumber],$dataLead)->save();

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead= $idLead[0]->id;

			$lead=Lead::findOrFail($idLead);

			$lead->occupation = $request->get('occupation');
			$lead->save();

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


			if(($response == true) || ($createLead == true)){

				$flag=1;
				
				$oportudataLead= new OportuyaV2;

				$oportudataLead->setConnection('oportudata');

				$dataoportudata=[

					'TIPO_DOC' => $request->get('typeDocument'),
					'CEDULA' => $identificationNumber,
					'NOMBRES' => strtoupper($request->get('name')),
					'APELLIDOS' => strtoupper($request->get('lastName')),
					'EMAIL' => strtoupper($request->get('email')),
					'CELULAR' =>$request->get('telephone'),
					'PROFESION' => strtoupper($request->get('occupation')),
					'ACTIVIDAD' => strtoupper($request->get('occupation')),
					'TIPOCLIENTE' => 'OPORTUYA',
					'SUBTIPO' => 'WEB',
					'STATE' => 'A',
					'SUC' => 9999,
					'CREACION' => date("Y-m-d")
				];


				$createOportudaLead = $oportudataLead->updateOrCreate(['CEDULA'=>$identificationNumber],$dataoportudata)->save();

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
					$flag=2;
				}

				$oportudataLead->setConnection('mysql');


			}

			

			if($flag==2){
				$identificationNumberEncrypt = $this->encrypt($identificationNumber);

				return redirect()->route('step2Oportuya', ['numIdentification' => $identificationNumberEncrypt]);
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);

			}else{

				return response()->json([true]);

			}		

			
		}


		if($request->get('step')==2){

			$flag= 0;

			$identificationNumber = $request->get('identificationNumber');
			

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]); 
			$idLeadInfo = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`= :idLead',['idLead'=>$idLead[0]->id]);
			if($idLeadInfo){
				$leadInfo=LeadInfo::findOrFail($idLeadInfo[0]->id);
			}else{
				$leadInfo = new LeadInfo;
			}


			$leadInfo->idLead= $idLead[0]->id;
			$leadInfo->addres = $request->get('addres');
			$leadInfo->birthdate = $request->get('birthdate');
			$leadInfo->cityExpedition = $request->get('cityExpedition');
			$leadInfo->civilStatus = $request->get('civilStatus');
			$leadInfo->dateDocumentExpedition = $request->get('dateDocumentExpedition');
			$leadInfo->gender= $request->get('gender');
			$leadInfo->housingOwner = $request->get('housingOwner');
			$leadInfo->housingTelephone = $request->get('housingTelephone');
			$leadInfo->housingType = $request->get('housingType');
			$leadInfo->housingTime = $request->get('housingTime');
			$leadInfo->leaseValue = $request->get('leaseValue'); 
			$leadInfo->spouseEps = $request->get('spouseEps');
			$leadInfo->spouseIdentificationNumber = $request->get('spouseIdentificationNumber');
			$leadInfo->spouseJob = $request->get('spouseJob');
			$leadInfo->spouseJobName = $request->get('spouseJobName');
			$leadInfo->spouseName = $request->get('spouseName');
			$leadInfo->spouseProfession = $request->get('spouseProfession');
			$leadInfo->spouseSalary = $request->get('spouseSalary');
			$leadInfo->spouseTelephone = $request->get('spouseTelephone');
			$leadInfo->stratum = $request->get('stratum');


			$response= $leadInfo->save();

			if($response){

				$flag=1;				

				$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();

				$dataLead=[

					'DIRECCION' => strtoupper($request->get('addres')),
					'FEC_NAC' => $request->get('birthdate'),
					'CIUD_EXP' => $request->get('cityExpedition'),
					'ESTADOCIVIL' => strtoupper($request->get('civilStatus')),
					'FEC_EXP' => $request->get('dateDocumentExpedition'),
					'PROPIETARIO' => strtoupper($request->get('housingOwner')),
					'SEXO' => strtoupper($request->get('gender')),
					'TIPOV' => strtoupper($request->get('housingType')),
					'TIEMPO_VIV' => $request->get('housingTime'),
					'TELFIJO' => $request->get('housingTelephone'),
					'VRARRIENDO' => $request->get('leaseValue'),
					'EPS_CONYU' => strtoupper($request->get('spouseEps')),
					'CEDULA_C' => $request->get('spouseIdentificationNumber'),
					'TRABAJO_CONYU' => strtoupper($request->get('spouseJob')),
					'CARGO_CONYU' => strtoupper($request->get('spouseJobName')),
					'NOMBRE_CONYU' => strtoupper($request->get('spouseName')),
					'PROFESION_CONYU' => strtoupper($request->get('spouseProfession')),
					'SALARIO_CONYU' => $request->get('spouseSalary'),
					'CELULAR_CONYU' => $request->get('spouseTelephone'),
					'ESTRATO' => $request->get('stratum')

				];

				$identificationNumber = (string)$identificationNumber;

				$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

				return response()->json([true]);
			} 
			

		}


		if($request->get('step')==3){

			$flag=0;

			$identificationNumber = $request->get('identificationNumber');

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead= $idLead[0]->id;

			$idLeadInfo = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`= :idLead',['idLead'=>$idLead]);
			$idLeadInfo= $idLeadInfo[0]->id;


			$leadInfo=LeadInfo::findOrFail($idLeadInfo);


			$leadInfo->nit = $request->get('nit');
			$leadInfo->indicative = $request->get('indicative');
			$leadInfo->companyName = $request->get('companyName');
			$leadInfo->companyAddres = $request->get('companyAddres');
			$leadInfo->companyTelephone = $request->get('companyTelephone');
			$leadInfo->companyTelephone2 = $request->get('companyTelephone2');
			$leadInfo->eps = $request->get('eps');
			$leadInfo->companyPosition = $request->get('companyPosition');
			$leadInfo->admissionDate = $request->get('admissionDate');
			$leadInfo->antiquity = $request->get('antiquity');
			$leadInfo->salary = $request->get('salary');
			$leadInfo->typeContract = $request->get('typeContract');
			$leadInfo->otherRevenue = $request->get('otherRevenue');
			$leadInfo->camaraComercio = $request->get('camaraComercio');
			$leadInfo->whatSell = $request->get('whatSell');
			$leadInfo->dateCreationCompany = $request->get('dateCrationCompany');
			$leadInfo->bankSavingsAccount = $request->get('bankSavingsAccount');

			$response = $leadInfo->save();

			if($response){
				
				$flag = 1;

				$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();

				$dataLead=[

					'NIT_EMP' => $request->get('nit'),
					'RAZON_SOC' => strtoupper($request->get('companyName')),
					'DIR_EMP' => strtoupper($request->get('companyAddres')),
					'TEL_EMP' => $request->get('companyTelephone'),
					'TEL2_EMP'	=> $request->get('companyTelephone2'),
					'ACT_ECO' => strtoupper($request->get('eps')),
					'CARGO' => strtoupper($request->get('companyPosition')),
					'FEC_ING' =>  $request->get('admissionDate'),
					'ANTIG' => $request->get('antiquity'),
					'SUELDO' => $request->get('salary'),
					'TIPO_CONT' => strtoupper($request->get('typeContract')),
					'OTROS_ING' => $request->get('otherRevenue')

				];

				$identificationNumber = (string)$identificationNumber;

				$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

				return response()->json([true]);
			}


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


	public function getDataStep2($identificationNumber){
	      $data = [];

	      $query = sprintf('SELECT `name`, `lastName` FROM `leads` WHERE `identificationNumber` = %s ', $identificationNumber);
	      $query2 = "SELECT `code` as value, `name` as label FROM `ciudades` ORDER BY name ";

	      $queryOportudataLead = sprintf("SELECT CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, FEC_EXP as dateDocumentExpedition, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, TELFIJO as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);

	      $respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
	      $resp = DB::select($query);
	      $resp2 = DB::select($query2);

	      $digitalAnalysts = [['name' => 'Fernanda', 'img' => 'images/analista1.png'], ['name' => 'Luisa', 'img' => 'images/analista2.png'], ['name' => 'Mariana', 'img' => 'images/analista3.png'], ['name' => 'Claudia', 'img' => 'images/analista4.png']];

	      $num = rand(0,3);

	      $data['dataLead'] = $resp[0];
	      $data['digitalAnalyst'] = $digitalAnalysts[$num];
	      $data['cities'] = $resp2;
	      $data['oportudataLead'] = $respOportudataLead[0];

	      return $data;

	}



	public function getDataStep3($identificationNumber){
	      $data = [];

	      $query = sprintf('SELECT `name`, `lastName`, `occupation` FROM `leads` WHERE `identificationNumber` = %s ', $identificationNumber);
	      $query2 = "SELECT `CODIGO` as value, `BANCO` as label FROM BANCO ";
	      $queryOportudataLead = sprintf("SELECT CEDULA as identificationNumber, NIT_EMP as nit, RAZON_SOC as companyName, DIR_EMP as companyAddres, TEL_EMP as companyTelephone, TEL2_EMP as companyTelephone2, ACT_ECO as eps, CARGO as companyPosition, FEC_ING as admissionDate, ANTIG as antiquity, SUELDO as salary, TIPO_CONT as typeContract, OTROS_ING as otherRevenue FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);
	      $resp = DB::select($query);
	      $resp2 = DB::connection('oportudata')->select($query2);
	      $respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
	      $digitalAnalysts = [['name' => 'Fernanda', 'img' => 'images/analista1.png'], ['name' => 'Luisa', 'img' => 'images/analista2.png'], ['name' => 'Mariana', 'img' => 'images/analista3.png'], ['name' => 'Claudia', 'img' => 'images/analista4.png']];

	      $num = rand(0,3);
	      $data['dataLead'] = $resp[0];
	      $data['digitalAnalyst'] = $digitalAnalysts[$num];
	      $data['banks'] = $resp2;
	      $data['oportudataLead'] = $respOportudataLead[0];

	      return $data;
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
