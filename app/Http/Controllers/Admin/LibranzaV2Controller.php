<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libranza;
use App\Imagenes;
use App\Application;
use App\Lead;
use App\Pagaduria;
use App\DatosCliente;
use App\CreditPolicy;
use App\LeadInfo;
use App\OportuyaV2;
use App\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LibranzaV2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$query = "SELECT leads.`id`, leads.`name`, leads.`lastName`, leads.`email`, leads.`telephone`, leads.`city`, leads.`typeService`, leads.`typeProduct`, leads.`created_at`, leads.`state`,leads.`channel`,liquidator.`creditLine`, liquidator.`pagaduria`, liquidator.`age`, liquidator.`customerType`, liquidator.`salary` 
		FROM leads 
		LEFT JOIN `liquidator` ON liquidator.`idLead` = leads.`id`
		WHERE 1";


	
	$query .= " ORDER BY leads.`id` DESC";


	$resp = DB::select($query);

	return response()->json([$resp]);
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
			//get step one request from data sended by form
		$response=false;

		if(($request->get('step'))==1){
            
       /*     $this->validate($request, [
            	'g-recaptcha-response' => 'required|captcha',
        	]);
			$dateConsultaComercial = $this->validateDateConsultaComercial($identificationNumber);
			if($dateConsultaComercial == 'true'){
				$consultaComercial = $this->execConsultaComercial($identificationNumber, $request->get('typeDocument'));
            }*/
            
            		//catch data from request and values assigning to leads table columns

		//	$validatePolicyCredit = $this->validatePolicyCredit($identificationNumber);
			$identificationNumber = $request->get('identificationNumber');
			$departament = $this->getCodeAndDepartmentCity($request->get('city'));
			$flag=0;
			$lead= new Lead;
			$leadInfo= new LeadInfo;
			
			$assessorCode=($request->get('assessor') !== NULL)?$request->get('assessor'):998877;
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

            if($createLead != true){

                $flag=1;
                
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
                $flag = 2;
            }

            /*if($validatePolicyCredit == false){
				return redirect()->route('thankYouPageOportuyaDenied');
            }*/

            if($flag==2){
				$identificationNumberEncrypt = $this->encrypt($identificationNumber);
			 	return response()->json([1,$identificationNumberEncrypt]);
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);
			}else{

				return response()->json([true]);
			}	           

        }
        if($request->get('step')==2){
            
			$flag=0;

            $identificationNumber= $request->get('identificationNumber');
			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead = $idLead[0]->id;

			$flag_lead= LeadInfo::where('idLead',$idLead);

			if(empty($flag_lead)){
				$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
				$idLead_info= $idLead_info[0]->id;
			
				$lead=LeadInfo::findOrFail($idLead_info);
			}else{
				$lead=new LeadInfo;
			}

			

            $dataLead=[
                'idLead'=>$idLead,
                'addres'=>strtoupper($request->get('addres')),
                'birthdate'=>($request->get('birthdate') != '')?$request->get('birthdate'):'0000/1/1',
                'age'=>($request->get('birthdate') != '')?$this->calculateAge($request->get('birthdate')):0,
                'cityExpedition'=>($request->get('cityExpedition') != '')?strtoupper($request->get('cityExpedition')):'NA',
                'housingOwner'=>($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')):'NA',
                'gender' => strtoupper($request->get('gender')),
				'housingType' => strtoupper($request->get('housingType')),
				'dateDocumentExpedition'=> ($request->get('dateDocumentExpedition') != '' )? $request->get('dateDocumentExpedition'):'0000/1/1',
				'housingTime' => ($request->get('housingTime') != '')?$request->get('housingTime'):'NA',
				'housingTelephone' => ($request->get('housingTelephone') != '')?$request->get('housingTelephone'):'',
				'spouseTelephone' => ($request->get('spouseTelephone') != '')?$request->get('spouseTelephone'):'',
				'leaseValue' => ($request->get('leaseValue') != '') ? $request->get('leaseValue') : 0,
				'spouseEps' => ($request->get('spouseEps') != '') ? strtoupper($request->get('spouseEps')) : 'NA',
				'spouseIdentificationNumber' => ($request->get('spouseIdentificationNumber') != '') ? $request->get('spouseIdentificationNumber') : '0',
				'spouseJob' => ($request->get('spouseJob')) ? strtoupper($request->get('spouseJob')) : 'NA' ,
				'spouseJobName' => ($request->get('spouseJobName') != '') ? strtoupper($request->get('spouseJobName')) : 'NA',
				'spouseName' => ($request->get('spouseName') != '') ? strtoupper($request->get('spouseName')) : 'NA',
				'spouseProfession' => ($request->get('spouseProfession') != '') ? strtoupper($request->get('spouseProfession')) : 'NA' ,
				'spouseSalary' => ($request->get('spouseSalary') != '') ? $request->get('spouseSalary') : '0',
				'spouseSalary' => ($request->get('spouseTelephone') != '') ? $request->get('spouseTelephone') : '0',
				'stratum' => ($request->get('stratum') != '')? $request->get('stratum'): 0,
				'nationality' => ($request->get('nationality') != '')? $request->get('nationality') : 52,
				'civilStatus'=>($request->get('civilStatus') != '')?$request->get('civilStatus'):'NA',
				'levelStudy'=>($request->get('levelStudy') != '')?$request->get('levelStudy'):'',
				'vehicle'=>($request->get('vehicle') != '')?$request->get('vehicle'):0,
				'vehiclePlate'=>($request->get('vehiclePlate') != '')?$request->get('vehiclePlate'):'',
				'nit'=>($request->get('nit') != '')?$request->get('nit'):'',
				'indicative'=>($request->get('indicative') != '')?$request->get('indicative'):'',
				'companyName'=>($request->get('companyName') != '')?$request->get('companyName'):'',
				'nit'=> ($request->get('nit') != '')?$request->get('nit') :0,
				'companyName' => ($request->get('companyName') != '')? strtoupper($request->get('companyName')):'NA',
				'companyAddres' => ($request->get('companyAddres') != '')?strtoupper($request->get('companyAddres')):0,
				'companyTelephone' => ($request->get('companyTelephone') != '')?strtoupper($request->get('companyTelephone')):0,
				'companyTelephone2' => ($request->get('companyTelephone2') != '')?strtoupper($request->get('companyTelephone')):0,
				'eps' => ($request->get('eps') != '')? strtoupper($request->get('eps')):'-',
				'companyPosition' => ($request->get('companyPosition') != '')?strtoupper($request->get('companyPosition')):'NA',
				'admissionDate' =>($request->get('admissionDate') != '')?$request->get('admissionDate'):'2019/1/1',
				'antiquity' =>($request->get('antiquity') != '')?$request->get('antiquity'):1,
				'salary' => ($request->get('salary') != '')?$request->get('salary'): 0,
				'typeContract' => ($request->get('typeContract') != '')?strtoupper($request->get('typeContract')): 'NA',
				'otherRevenue' => ($request->get('otherRevenue') != '') ? $request->get('otherRevenue') : 0,
				'camaraComercio' => ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'whatShell' => ($request->get('whatSell') != '') ? $request->get('whatSell') : 'NA',
				'dateCreationCompany' => ($request->get('dateCreationCompany') != '') ? $request->get('dateCreationCompany') : '2000/1/1',
				'bankSavingsAccount' => ($request->get('bankSavingsAccount') != '') ? $request->get('bankSavingsAccount') : 'NA',
				'whatSell' => ($request->get('whatSell') != '') ? $request->get('whatSell') : 'NA',
				'pagaduria'=>($request->get('pagaduria') != '' )? $request->get('pagaduria'):1,
				'membershipNumber'=>($request->get('membershipNumber') != '' )? $request->get('membershipNumber'):''
            ];

            //verify if a customer exist before save a lead , then save data into leads table.
            
			$createLead = $lead->updateOrCreate(['idLead'=>$idLead],$dataLead)->save();
			//$lead->save();

			//get id throught identification number from leads table           


            if($createLead != true){

                $flag=1;

                $lead->idLead = $idLead;
                $lead->addres = strtoupper($request->get('addres'));
                $lead->birthdate = ($request->get('birthdate') != '')?$request->get('birthdate'):'0000/1/1';
                $lead->age = ($request->get('birthdate') != '')?$this->calculateAge($request->get('birthdate')):0;
                $lead->cityExpedition = $request->get('cityExpedition');
                $lead->housingOwner = ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')):'NA';
                $lead->gender=  strtoupper($request->get('gender'));
				$lead->housingType=  strtoupper($request->get('housingType'));
				$lead->housingTime=  $request->get('housingTime');
				$lead->housingTelephone=  $request->get('housingTelephone');
				$lead->leaseValue=  ($request->get('leaseValue') != '') ? $request->get('leaseValue') : 0;
				$lead->spouseEps=  ($request->get('spouseEps') != '') ? strtoupper($request->get('spouseEps')) : 'NA';
				$lead->spouseIdentificationNumber=  ($request->get('spouseIdentificationNumber') != '') ? $request->get('spouseIdentificationNumber') : '0';
				$lead->spouseJob=  ($request->get('spouseJob')) ? strtoupper($request->get('spouseJob')) : 'NA' ;
				$lead->spouseJobName=  ($request->get('spouseJobName') != '') ? strtoupper($request->get('spouseJobName')) : 'NA';
				$lead->spouseName=  ($request->get('spouseName') != '') ? strtoupper($request->get('spouseName')) : 'NA';
				$lead->spouseProfession=  ($request->get('spouseProfession') != '') ? strtoupper($request->get('spouseProfession')) : 'NA' ;
				$lead->spouseSalary=  ($request->get('spouseSalary') != '') ? $request->get('spouseSalary') : '0';
				$lead->spouseSalary=  ($request->get('spouseTelephone') != '') ? $request->get('spouseTelephone') : '0';
				$lead->stratum =  $request->get('stratum');
				$lead->nationality = $request->get('nationality');
                
                $response = $lead->save();

            }

            if(($response == true) || ($createLead == true)){
                $flag = 2;
            }

            /*if($validatePolicyCredit == false){
				return redirect()->route('thankYouPageOportuyaDenied');
            }*/

            if($flag==2){
				$identificationNumberEncrypt = $this->encrypt($identificationNumber);
				return response()->json([true]);
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);
			}else{

				return response()->json([true]);
			}	           

		}
		
		if($request->get('step') == 3){
			
			$flag=0;

			$identificationNumber= $request->get('identificationNumber');		
			

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead = $idLead[0]->id;
			$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
			$idLead_info= $idLead_info[0]->id;
			
			$lead=LeadInfo::findOrFail($idLead_info);
			 

			$dataLead=[
				'nit'=> ($request->get('nit') != '')?$request->get('nit') :0,
				'companyName' => ($request->get('companyName') != '')? strtoupper($request->get('companyName')):'NA',
				'companyAddres' => ($request->get('companyAddres') != '')?strtoupper($request->get('companyAddres')):0,
				'companyTelephone' => ($request->get('companyTelephone') != '')?strtoupper($request->get('companyTelephone')):0,
				'companyTelephone2' => ($request->get('companyTelephone2') != '')?strtoupper($request->get('companyTelephone')):0,
				'eps' => ($request->get('eps') != '')? strtoupper($request->get('eps')):'-',
				'companyPosition' => ($request->get('companyPosition') != '')?strtoupper($request->get('companyPosition')):'NA',
				'admissionDate' =>($request->get('admissionDate') != '')?$request->get('admissionDate'):'0000/1/1',
				'antiquity' =>($request->get('antiquity') != '')?$request->get('antiquity'):1,
				'salary' => ($request->get('salary') != '')?$request->get('salary'): 0,
				'typeContract' => ($request->get('typeContract') != '')?strtoupper($request->get('typeContract')): 'NA',
				'otherRevenue' => ($request->get('otherRevenue') != '') ? $request->get('otherRevenue') : 0,
				'camaraComercio' => ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'whatShell' => ($request->get('whatSell') != '') ? $request->get('whatSell') : 'NA',
				'dateCreationCompany' => ($request->get('dateCreationCompany') != '') ? $request->get('dateCreationCompany') : '0000/1/1',
				'bankSavingsAccount' => ($request->get('bankSavingsAccount') != '') ? $request->get('bankSavingsAccount') : 'NA',
				'pagaduria'=>($request->get('pagaduria') != '' )? $request->get('pagaduria'):1,
				'membershipNumber'=>($request->get('membershipNumber') != '' )? $request->get('membershipNumber'):'0000'

			];

			
            //verify if a customer exist before save a lead , then save data into leads table.
            
			$createLead = $lead->updateOrCreate(['idLead'=>$idLead],$dataLead)->save();
			//$lead->save();
		
			//get id throught identification number from leads table           


            if($createLead != true){

                $flag=1;

                $lead->idLead = $idLead;
                $lead->addres = strtoupper($request->get('addres'));
                $lead->birthdate = $request->get('birthdate');
                $lead->age = $this->calculateAge($request->get('birthday'));
                $lead->cityExpedition = $request->get('cityExpedition');
                $lead->housingOwner = ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')):'NA';
                $lead->gender=  strtoupper($request->get('gender'));
				$lead->housingType=  strtoupper($request->get('housingType'));
				$lead->housingTime=  $request->get('housingTime');
				$lead->housingTelephone=  $request->get('housingTelephone');
				$lead->leaseValue=  ($request->get('leaseValue') != '') ? $request->get('leaseValue') : 0;
				$lead->spouseEps=  ($request->get('spouseEps') != '') ? strtoupper($request->get('spouseEps')) : 'NA';
				$lead->spouseIdentificationNumber=  ($request->get('spouseIdentificationNumber') != '') ? $request->get('spouseIdentificationNumber') : '0';
				$lead->spouseJob=  ($request->get('spouseJob')) ? strtoupper($request->get('spouseJob')) : 'NA' ;
				$lead->spouseJobName=  ($request->get('spouseJobName') != '') ? strtoupper($request->get('spouseJobName')) : 'NA';
				$lead->spouseName=  ($request->get('spouseName') != '') ? strtoupper($request->get('spouseName')) : 'NA';
				$lead->spouseProfession=  ($request->get('spouseProfession') != '') ? strtoupper($request->get('spouseProfession')) : 'NA' ;
				$lead->spouseSalary=  ($request->get('spouseSalary') != '') ? $request->get('spouseSalary') : '0';
				$lead->spouseSalary=  ($request->get('spouseTelephone') != '') ? $request->get('spouseTelephone') : '0';
				$lead->stratum =  $request->get('stratum');
				$lead->pagaduria =  $request->get('pagaduria');
				$lead->membershipNumber =  $request->get('membershipNumber');
                
                $response = $lead->save();

            }

            if(($response == true) || ($createLead == true)){
                $flag = 2;
            }

            if($flag==2){
			
				return response()->json([true,$lead]);
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);
			}else{

				return response()->json([false]);
			}	
		}


		if ($request->get('step') == 'comment') {

			$flag=0;
			$identificationNumber= $request->get('identificationNumber');	

			$idLead=DB::select('SELECT `id` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
			$idLead = $idLead[0]->id;
			$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
			$idLead_info= $idLead_info[0]->id;
			
			$lead=LeadInfo::findOrFail($idLead_info);

			$dataLead=[
				'comment'=> $request->get('comment'),
				'availability' => $request->get('availability')
			];

			$createLead = $lead->updateOrCreate(['idLead'=>$idLead],$dataLead)->save();

			if($createLead != true){

                $flag=1;

                $lead->comment = $request->get('comment');
                $lead->availability = $request->get('availability');
                
                $response = $lead->save();

            }

			if(($response == true) || ($createLead == true)){
                $flag = 2;
            }

            if($flag==2){
			
				return response()->json([true]);
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);
			}else{

				return response()->json([false]);
			}
			
		}
            
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

    private function validateDateConsultaComercial($identificationNumber){
		$dateNow = date('Y-m-d');
		$queryTimeCreditPolicy = DB::connection('mysql')->select("SELECT timeLimit FROM credit_policy LIMIT 1");
		$timeScore = $queryTimeCreditPolicy[0]->timeLimit;
		$dateTwoMonths = strtotime ($timeScore, strtotime ( $dateNow ) ) ;
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

	public function cities(){
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

		return response()->json([$cities]);
	}

	public function getDataStep1(){
		$query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 ORDER BY CIUDAD ASC";

		$resp = DB::connection('oportudata')->select($query);
		$verbose='localhost:8000';
		$getCode =$verbose.'/api/oportudata/getCodeVerification/';

		return $resp;
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
		
		return view('libranza.step1', ['digitalAnalyst' => $digitalAnalyst[0], 'cities' => array_sort($cities, 'label', SORT_DESC)]);
    }
    
    
	/**
	 * Get departament code through city name
	 *
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 *
	 * @param  string $nameCity
	 * @return string  
	 */

	private function getCodeAndDepartmentCity($nameCity){
		$query = sprintf('SELECT `departament` FROM `ciudades` WHERE `name` = "%s" LIMIT 1 ', $nameCity);
		$resp = DB::select($query);

		return $resp;
    }


    private function execConsultaComercial($identificationNumber, $typeDocument){
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->identificationNumber = trim($identificationNumber);
		$ws = new \SoapClient("http://10.238.14.181:2020/Service1.svc?singleWsdl",array()); //correcta
		$result = $ws->ConsultarInformacionComercial($obj);  // correcta
    }
    
    private function calculateAge($fecha){
		$time = strtotime($fecha);
		$now = time();
		$age = ($now-$time)/(60*60*24*365.25);
		$age = floor($age);

		return $age;
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


	public function getDataStep3($identificationNumber){
		$identificationNumber=$this->decrypt($identificationNumber);
		$idLeadQuery=DB::select('SELECT `id`,`occupation` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
		$idLead = $idLeadQuery[0]->id;
		return $idLead;
		$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
		$idLead_info= $idLead_info[0]->id;

		$pagaduria=DB::select('SELECT `id`, `name`,`address`,`office` FROM `pagaduria` WHERE 1');
		$lead_info=DB::select('SELECT `nit`,`indicative`,`companyName`,`companyAddres`,`companyTelephone`,`companyTelephone2`, `companyPosition`,`antiquity`,`salary`,`typeContract`, `otherRevenue`,`camaraComercio`,`eps`,`admissionDate`,`dateCreationCompany`,`bankSavingsAccount`,`whatSell`,`membershipNumber` FROM `leads_info` WHERE `id`=:idLead ',['idLead'=>$idLead_info]);
		
		$data = [];
		$digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];
		$data['digitalAnalyst'] = $digitalAnalysts[0];
		$data['dataLead']=$lead_info;
		$data['occupation']=$idLeadQuery[0]->occupation;
		$data['pagaduria']=$pagaduria;
	
		return $data;
  }


	public function getDataStep2($identificationNumber){
		$data = [];

		$idLead=DB::select('SELECT `id`,`occupation` FROM `leads` WHERE `identificationNumber`= :identificationNumber',['identificationNumber'=>$identificationNumber]);
		$occupation=$idLead[0]->occupation;
		$idLead = $idLead[0]->id;
		//$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
		$idLead_info=false;
		$lead_info=false;

		try {
			$idLeadInfo= LeadInfo::where('idLead',$idLead);	

			if($idLeadInfo){
				$idLead_info = DB::select('SELECT `id` FROM `leads_info` WHERE `idLead`=:idlead',['idlead'=>$idLead]);
				$idLead_info= $idLead_info[0]->id;
				$lead_info=DB::select('SELECT `dateDocumentExpedition`,`cityExpedition`,`nationality`,`housingType`,`housingTime`,`housingOwner`, `addres`,`housingTelephone`,`stratum`,`birthdate`, `gender`,`civilStatus` FROM `leads_info` WHERE `id`=:idLead ',['idLead'=>$idLead_info]);
			}else{
				$idLead_info=false;
				$lead_info=false;
			}

		} catch (\Throwable $th) {

		}
		
		$queryCountries = "SELECT `id`,`name`,`iso` FROM  `paises`";
		$countries = DB::select($queryCountries);

		$query2 = "SELECT `code` as value, `name` as label FROM `ciudades` ORDER BY name ";				
		$resp2 = DB::select($query2);

		$digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		

		$data['digitalAnalyst'] = $digitalAnalysts[0];
		$data['cities'] = $resp2;
		$data['countries']=$countries;
		$data['dataLead']=$lead_info;
		$data['idLead']=$idLead_info;
		$data['occupation']=$occupation;
		return response()->json([$data]);

  }

  public function encrypt($string) {
	$string = utf8_encode($string);
	$control1 = "*]wy";
	$control2 = "3/~";
	$string = $control1.$string.$control2;
	$string = base64_encode($string);

	return $string;
} 

public function getIDStep2($string){
	$identificactionNumber = $this->decrypt($string);
	return response()->json([$identificactionNumber]);
}

public function step2($string){
	
	$identificactionNumber = $this->decrypt($string);

	return view('libranza.step2', ['identificactionNumber' => $identificactionNumber]);
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

	public function step3($string){
		$identificactionNumber = $this->decrypt($string);

		return view('libranza.step3', ['identificactionNumber' => $identificactionNumber]);
	}
    
}
