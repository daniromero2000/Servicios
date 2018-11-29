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
		return view('oportuya.indexV2',['images'=>$images, 'cities' => $cities]);
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
			$lead->typeDocument=$request->get('typeDocument');
			$lead->identificationNumber=$identificationNumber;	

			$lead->name=$request->get('name');
			$lead->lastName=$request->get('lastName');
			$lead->email=$request->get('email');
			$lead->channel= 1;
			$lead->telephone=$request->get('telephone');
			$lead->occupation = $request->get('occupation');
			$lead->termsAndConditions=$request->get('termsAndConditions');

			$response= $lead->save();

			if($response){

				$flag=1;
				
				$oportudataLead= new OportuyaV2;

				$oportudataLead->setConnection('oportudata');

				$oportudataLead->TIPO_DOC = $request->get('typeDocument');
				$oportudataLead->CEDULA = $identificationNumber;
				$oportudataLead->NOMBRES = $request->get('name');
				$oportudataLead->APELLIDOS = $request->get('lastName');
				$oportudataLead->EMAIL = $request->get('email');
				$oportudataLead->CELULAR = $request->get('telephone');
				$oportudataLead->PROFESION = $request->get('occupation');

				$response = $oportudataLead->save();

				if($response){
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

			//$idLead=Lead::select('idLead')->where('identificationNumber','=',$identificationNumber);
		}


		if($request->get('step')==2){

			$flag= 0;

			$identificationNumber = $request->get('identificationNumber');
			//return $identificationNumber;

			//$oportudataLead=OportuyaV2::findOrFail($identificationNumber);

			$idLead=DB::select(sprintf('SELECT `id` FROM `leads` WHERE `identificationNumber` = %s ', $identificationNumber)); 

			$idLead=$idLead[0]->id;
			
			$leadInfo = new LeadInfo;

			$leadInfo->idLead= $idLead;
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

			$response = $leadInfo->save();

			if($response){

				$flag=1;

				$oportudataLead = new OportuyaV2;
				$oportudataLead->setConnection('oportudata');
				$oportudataLead = OportuyaV2::findOrFail($identificationNumber);
				

				$oportudataLead = DB::connection('oportudata')->table('CLIENTES_FAB')->where('CEDULA','=',$identificactionNumber)->get();

				$dataLead=[

					'DIRECCION' => $request->get('addres'),
					'FEC_NAC' => $request->get('birthday'),
					'CIUD_EXP' => $request->get('cityExpedition'),
					'ESTADOCIVIL' => $request->get('civilStatus'),
					'FEC_EXP' => $request->get('dateDocumentExpedition'),
					'PROPIETARIO' => $request->get('housingOwner'),
					'TIEMPO_VIV' => $request->get('housingTime'),
					'TELFIJO' => $request->get('housingTelephone'),
					'VRARRIENDO' => $request->get('leaseValue'),
					'EPS_CONYU' => $request->get('spouseEps'),
					'CEDULA_C' => $request->get('spouseIdentificationNumber'),
					'TRABAJO_CONYU' => $request->get('spouseJob'),
					'CARGO_CONYU' => $request->get('spouseJobName'),
					'NOMBRE_CONYU' => $request->get('spouseName'),
					'PROFESION_CONYU' => $request->get('spouseProfession'),
					'SALARIO_CONYU' => $request->get('spouseSalary'),
					'CELULAR_CONYU' => $request->get('spouseTelephone'),
					'ESTRATO' => $request->get('stratum')

				];

				/*$oportudataLead->DIRECCION = $request->get('addres');
				$oportudataLead->FEC_NAC = $request->get('birthday');
				$oportudataLead->CIUD_EXP = $request->get('cityExpedition');
				$oportudataLead->civilStatus = $request->get('civilStatus');
				$oportudataLead->dateDocumentExpedition = $request->get('dateDocumentExpedition');
				$oportudataLead->gender= $request->get('gender');
				$oportudataLead->housingOwner = $request->get('housingOwner');
				$oportudataLead->housinTelephone = $request->get('housingTime');
				$oportudataLead->leaseValue = $request->get('leaseValue'); 
				$oportudataLead->spouseEps = $request->get('spouseEps');
				$oportudataLead->spouseIdentificationNumber = $request->get('spouseIdentificationNumber');
				$oportudataLead->spouseJob = $request->get('spouseJob');
				$oportudataLead->spouseJobName = $request->get('spouseJobName');
				$oportudataLead->spouseName = $request->get('spouseName');
				$oportudataLead->spouseProfession = $request->get('spouseProfession');
				$oportudataLead->spouseSalary = $request->get('spouseSalary');
				$oportudataLead->spouseTelephone = $request->get('spouseTelephone');
				$oportudataLead->stratum = $request->get('stratum');*/

				//$dataLead = (array)$oportudataLead;
				//$oportudataLead->save();

				//$oportudataLead->setConnection('mysql');

				DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificactionNumber)->update($dataLead);



				$identificationNumberEncrypt = $this->encrypt($identificationNumber);

				return redirect()->route('step3Oportuya', ['numIdentification' => $identificationNumberEncrypt]);
			} 
			

		}
		
	}

	public function step2($string){
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step2', ['identificactionNumber' => $identificactionNumber]);
	}

	public function step3($string){
		$identificactionNumber = $this->decrypt($string);

		return view('oportuya.step3', ['identificactionNumber' => $identificactionNumber]);
	}

	private function encrypt($string) {
		$string = utf8_encode($string);
		$control1 = "*]wy";
		$control2 = "3/~";
		$string = $control1.$string.$control2;
		$string = base64_encode($string);

		return $string;
	} 

	private function decrypt($string){
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
