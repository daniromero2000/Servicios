<?php

/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Modulo: MODULO Oportuya
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: Controlador de solicitud de credito oportuya, 
    **				donde mediante los datos ingresados
    **				en un formulario divido en tres pasos se puede pre-aprobar
    **				o negar una solicitud de tarjeta oportuya.
    **Fecha: 15/11/2018
**/


/**
    **Project: SERVICIOS FINANCIEROS
    **Module: Oportuya Module
    **Author: Sebastian Ormaza
    **Email: desarrollo@lagobo.com
    **Author: Robert García
    **Email: desarrollo1@lagobo.com
    **Description:Oportuya credit request controller, where people by a form can know if a oportuya credit is pre-approve 
    **Date: 15/11/2018
**/

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Application;
use App\Lead;
use App\DatosCliente;
use App\cliCel;
use App\CreditPolicy;
use App\LeadInfo;
use App\OportuyaV2;
use App\Tarjeta;
use App\TurnosOportuya;
use App\Analisis;
use App\Bdua;
use App\EstadoCedula;
use App\CodeUserVerification;
use App\codeUserVerificationOportudata;
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


	public function getPageDeniedTr(){
		$mensaje = DB::connection('oportudata')->select('SELECT `MSJ` FROM `TB_MSJ_CONFIRMACION` WHERE `ID` = 2 ');
		
		return view('advance.pageDeniedTradicional',['mensaje'=>$mensaje[0]->MSJ]);
	}

	public function getPageDeniedAl(){
		$mensaje = DB::connection('oportudata')->select('SELECT `MSJ` FROM `TB_MSJ_CONFIRMACION` WHERE `ID` = 3 ');
		
		return view('advance.pageDeniedAlmacen',['mensaje'=>$mensaje[0]->MSJ]);
	}

	public function getPageDeniedSH(){
		$mensaje = DB::connection('oportudata')->select('SELECT `MSJ` FROM `TB_MSJ_CONFIRMACION` WHERE `ID` = 5 ');
		
		return view('advance.pageDeniedSinHistorial',['mensaje'=>$mensaje[0]->MSJ]);
	}

	public function getPageDenied(){
		$mensaje = DB::connection('oportudata')->select('SELECT `MSJ` FROM `TB_MSJ_CONFIRMACION` WHERE `ID` = 4 ');
		
		return view('advance.pageDeniedAdvance',['mensaje'=>$mensaje[0]->MSJ]);
	}

	public function validateEmail(){
		return response()->json(true);
		$emailsValidos = [];
		foreach ($listaCorreos as $value) {
			
			$re = '/^[a-z0-9!#$%&\'*+\=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/m';
			$str = strtolower($value);
			if(preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0)){
				if($str != '00000@0000.com' && $str != 'no@hotmail.com' && $str != 'ninguno@hotmail.com' && $str != 'no@hotmail.co' && $str != 'na@hotmail.com' && $str != 'na@na.com' && $str != 'na@gmail.com' && $str != 'notiene@hotmail.com'){
					$pos = strpos($str, 'xxx');
					if($pos === false){
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
	 * it get data from step by step form  (one by step),
	 * so first through id the register is verified, 
	 * if this exist, the information is  updated,
	 * otherwise it store a new register
	 *
	 * In the process, the data is stored in OPORTUDATA database
	 *
	 * @author Sebastian Ormaza
	 * @email  desarrollo@lagobo.com
	 *
	 * @author Robert García
	 * @email  desarrollo1@lagobo.com
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request){
		//get step one request from data sended by form
		if(($request->get('step'))==1){
			$identificationNumber = trim($request->get('identificationNumber'));
			/*
			// Fosyga
			$dateConsultaFosyga = $this->validateDateConsultaFosyga($identificationNumber);
			if($dateConsultaFosyga == "true"){
				$consultaFosyga = $this->execConsultaFosyga($identificationNumber, $request->get('typeDocument'), trim($request->get('dateDocumentExpedition')));
			}else{
				$consultaFosyga = 1;
			}

			if ($consultaFosyga > 0) {
				$validateConsultaFosyga = $this->validateConsultaFosyga($identificationNumber, strtolower(trim($request->get('name'))), strtolower(trim($request->get('lastName'))), trim($request->get('dateDocumentExpedition')));
			}else{
				$validateConsultaFosyga = 0;
			}
			// Registraduria
			$dateConsultaRegistraduria = $this->validateDateConsultaRegistraduria($identificationNumber);
			if($dateConsultaRegistraduria == "true"){
				$consultaRegistraduria = $this->execConsultaRegistraduria($identificationNumber, $request->get('typeDocument'), trim($request->get('dateDocumentExpedition')));
			}else{
				$consultaRegistraduria = 1;
			}

			if ($consultaRegistraduria > 0) {
				$validateConsultaRegistraduria = $this->validateConsultaRegistraduria($identificationNumber, strtolower(trim($request->get('name'))), strtolower(trim($request->get('lastName'))), trim($request->get('dateDocumentExpedition')));
			}else{
				$validateConsultaRegistraduria = 0;
			}

			if ($validateConsultaFosyga > 0 && $validateConsultaRegistraduria > 0) {
				$dateConsultaComercial = $this->validateDateConsultaComercial($identificationNumber);
				if($dateConsultaComercial == 'true'){
					$consultaComercial = $this->execConsultaComercial($identificationNumber, $request->get('typeDocument'));
				}else{
					$consultaComercial = 1;
				}
			}*/

			$dateConsultaComercial = $this->validateDateConsultaComercial($identificationNumber);
			if($dateConsultaComercial == 'true'){
				$consultaComercial = $this->execConsultaComercial($identificationNumber, $request->get('typeDocument'));
			}else{
				$consultaComercial = 1;
			}

			$cityName = $this->getCity($request->get('city'));

			//catch data from request and values assigning to leads table columns
			$departament = $this->getCodeAndDepartmentCity(trim($cityName[0]->CIUDAD));
			$flag=0;
			$lead= new Lead;
			$leadInfo= new LeadInfo;
			$response = false;
			$authAssessor= (Auth::guard('assessor')->check())?Auth::guard('assessor')->user()->CODIGO:NULL;
			if(Auth::user()){
				$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
			}
			$assessorCode=($authAssessor !== NULL)?$authAssessor:998877;
			$dataLead=[
				'typeDocument'=> $request->get('typeDocument'),
				'identificationNumber'=> $identificationNumber,
				'assessor' => $assessorCode,
				'name'=> trim($request->get('name')),
				'lastName'=> trim($request->get('lastName')),
				'email'=> trim($request->get('email')),
				'channel'=>  1,
				'telephone'=> trim($request->get('telephone')),
				'occupation' =>  trim($request->get('occupation')),
				'termsAndConditions'=> trim($request->get('termsAndConditions')),
				'city' =>  trim($cityName[0]->CIUDAD),
				'typeProduct' =>  '',
				'typeService' =>  trim($request->get('typeService'))
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
				$lead->name=trim($request->get('name'));
				$lead->lastName=trim($request->get('lastName'));
				$lead->email=trim($request->get('email'));
				$lead->channel= 1;
				$lead->telephone=trim($request->get('telephone'));
				$lead->occupation = trim($request->get('occupation'));
				$lead->termsAndConditions=$request->get('termsAndConditions');
				$lead->city= trim($cityName[0]->CIUDAD);
				$lead->typeProduct = $request->get('typeProduct');
				$lead->typeService = $request->get('typeService');
				$response = $lead->save();
			}

			//if data was saving into leads table successfully, data is stored into Oportudata CLIENTES_FAB table 
			if(($response == true) || ($createLead == true)){
				$estado = "";
				$paso = "";
				switch ($request->get('typeService')) {
					case 'Avance':
						$paso = "A-PASO1";
						break;
					
					case 'Oportuya':
						$paso = "O-PASO1";
						break;
				}
				/*if ($validateConsultaFosyga > 0 && $validateConsultaRegistraduria > 0) {
					$estado = ($consultaComercial == 0) ? 'SIN COMERCIAL' : $estado ;
				}*/
				$estado = ($consultaComercial == 0) ? 'SIN COMERCIAL' : $estado ;
				// $flag =1 means  data into leads table was saved correctly
				$flag=1;
				
				$oportudataLead= new OportuyaV2;
				$oportudataLead->setConnection('oportudata');
				$dataoportudata=[
					'TIPO_DOC' => $request->get('typeDocument'),
					'CEDULA' => $identificationNumber,
					'NOMBRES' => trim(strtoupper($request->get('name'))),
					'APELLIDOS' => trim(strtoupper($request->get('lastName'))),
					'EMAIL' => trim($request->get('email')),
					'CELULAR' =>trim($request->get('telephone')),
					'PROFESION' => 'NO APLICA',
					'ACTIVIDAD' => strtoupper($request->get('occupation')),
					'CIUD_UBI' => trim($cityName[0]->CIUDAD),
					'DEPTO' => trim($departament->departament),
					'FEC_EXP' => trim($request->get('dateDocumentExpedition')),
					'TIPOCLIENTE' => 'OPORTUYA',
					'SUBTIPO' => 'WEB',
					'STATE' => 'A',
					'SUC' => ($request->get('branchOffice') != '') ? $request->get('branchOffice') : 9999,
					'ESTADO' => $estado,
					'PASO' => $paso,
					'ORIGEN' => $request->get('typeService')
				];
				//verify if a customer exist before save a lead , then save data into CLIENTES_FAB table.
				$createOportudaLead = $oportudataLead->updateOrCreate(['CEDULA'=>$identificationNumber],$dataoportudata)->save();
				if($request->get('CEL_VAL') == 0){
					$clienteCelular = new CliCel;
					$clienteCelular->IDENTI = $identificationNumber;
					$clienteCelular->NUM = trim($request->get('telephone'));
					$clienteCelular->TIPO = 'CEL';
					$clienteCelular->CEL_VAL = 1;
					$clienteCelular->FECHA = date("Y-m-d H:i:s");
					$clienteCelular->save();
				}
				
				//if updateOrCreate method fails save data without verify its existent, then save data into CLIENTES_FAB table
				if($createOportudaLead != true){
					$oportudataLead->TIPO_DOC = $request->get('typeDocument');
					$oportudataLead->CEDULA = $identificationNumber;
					$oportudataLead->NOMBRES = trim(strtoupper($request->get('name')));
					$oportudataLead->APELLIDOS = trim(strtoupper($request->get('lastName')));
					$oportudataLead->EMAIL = trim($request->get('email'));
					$oportudataLead->CELULAR =trim($request->get('telephone'));
					$oportudataLead->PROFESION = 'NO APLICA';
					$oportudataLead->ACTIVIDAD = strtoupper($request->get('occupation'));
					$oportudataLead->CIUD_UBI = trim($cityName[0]->CIUDAD);
					$oportudataLead->DEPTO = trim($departament->departament);
					$oportudataLead->FEC_EXP = trim($request->get('dateDocumentExpedition'));
					$oportudataLead->TIPOCLIENTE = 'OPORTUYA';
					$oportudataLead->SUBTIPO = 'WEB';
					$oportudataLead->STATE = 'A';
					$oportudataLead->SUC = ($request->get('branchOffice') != '') ? $request->get('branchOffice') : 9999;
					$oportudataLead->ESTADO = $estado;
					$oportudataLead->ORIGEN = $request->get('typeService');
					$response = $oportudataLead->save();
				}

				if(($response == true) || ($createOportudaLead== true)){
					// $flag =2 means  data into leads and CLIENTES_FAB table was saved correctly
					$flag=2;
				}

			}

			/*if ($validateConsultaFosyga < 1) {
				return $validateConsultaFosyga;
			}


			if($validateConsultaRegistraduria < 1){
				return $validateConsultaRegistraduria;
			}*/

			if(trim($request->get('occupation')) == 'SOLDADO-MILITAR-POLICÍA' || trim($request->get('occupation')) == 6) return -1;
			if($consultaComercial == 1){
				$validatePolicyCredit = $this->validatePolicyCredit($identificationNumber, trim($cityName[0]->CIUDAD));
			}else{
				$validatePolicyCredit = true;
			}

			if($validatePolicyCredit == false){
				return -1;
			}
			if($flag==2){

				$identificationNumberEncrypt = $this->encrypt($identificationNumber);
				if($assessorCode != 998877){
					return 1;
				}
				return 1;
			}elseif ($flag==1) {

				return response()->json(['servicios'=>$response]);
			}else{

				return response()->json([true]);
			}
		}


		//get step two data from request form

		if($request->get('step')==2){
			$flag= 0;
			$identificationNumber = trim($request->get('identificationNumber'));

			$flag=1;

			// CEDULA query from OPORTUDATA data base

			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
			$paso = "";
			switch ($oportudataLead[0]->ORIGEN) {
				case 'Avance':
					$paso = "A-PASO2";
					break;
				
				case 'Oportuya':
					$paso = "O-PASO2";
					break;
			}
			//Assign data from request to CLIENTE_FAB colums

			$dataLead=[
				'DIRECCION' => trim(strtoupper($request->get('addres'))),
				'FEC_NAC' => $request->get('birthdate'),
				'EDAD' => $this->calculateAge($request->get('birthdate')),
				'CIUD_EXP' => $request->get('cityExpedition'),
				'ESTADOCIVIL' => strtoupper($request->get('civilStatus')),
				'PROPIETARIO' => ($request->get('housingOwner') != '') ? strtoupper($request->get('housingOwner')) : 'NA' ,
				'SEXO' => strtoupper($request->get('gender')),
				'TIPOV' => strtoupper($request->get('housingType')),
				'TIEMPO_VIV' => trim($request->get('housingTime')),
				'TELFIJO' => trim($request->get('housingTelephone')),
				'VRARRIENDO' => ($request->get('leaseValue') != '') ? trim($request->get('leaseValue')) : 0,
				'EPS_CONYU' => ($request->get('spouseEps') != '') ? trim(strtoupper($request->get('spouseEps'))) : 'NA',
				'CEDULA_C' => ($request->get('spouseIdentificationNumber') != '') ? trim($request->get('spouseIdentificationNumber')) : '0',
				'TRABAJO_CONYU' => ($request->get('spouseJob')) ? trim(strtoupper($request->get('spouseJob'))) : 'NA' ,
				'CARGO_CONYU' => ($request->get('spouseJobName') != '') ? trim(strtoupper($request->get('spouseJobName'))) : 'NA',
				'NOMBRE_CONYU' => ($request->get('spouseName') != '') ? trim(strtoupper($request->get('spouseName'))) : 'NA',
				'PROFESION_CONYU' => ($request->get('spouseProfession') != '') ? trim(strtoupper($request->get('spouseProfession'))) : 'NA' ,
				'SALARIO_CONYU' => ($request->get('spouseSalary') != '') ? trim($request->get('spouseSalary')) : '0',
				'CELULAR_CONYU' => ($request->get('spouseTelephone') != '') ? trim($request->get('spouseTelephone')) : '0',
				'ESTRATO' => $request->get('stratum'),
				'PASO' => $paso,
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

			//cast $identificationNumber

			$identificationNumber = (string)$identificationNumber;

			// Update/save data in OPORTUDATA data base

			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

			return response()->json([true]);
		}


		//get step three data from request form

		if($request->get('step')==3){
			$identificationNumber = $request->get('identificationNumber');
			/*$queryTemp = sprintf("SELECT `paz_cli`, `fos_cliente` FROM `temp_consultaFosyga` WHERE `cedula` = '%s' ORDER BY `id` DESC LIMIT 1 ", $identificationNumber);
			$respQueryTemp = DB::connection('oportudata')->select($queryTemp);*/
			$quotaApproved = 0;
			$quotaApprovedProduct = 0;
			$existSolicFab = $this->getExistSolicFab($identificationNumber);
			if($existSolicFab == true){
				return -3; // Tiene solicitud
			}
			$datosCliente= new DatosCliente;
			$turnosOportuya = new TurnosOportuya;
			$analisis = new Analisis;
			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
			$paso = "";
			switch ($oportudataLead[0]->ORIGEN) {
				case 'Avance':
					$paso = "A-PASO3";
					break;
				
				case 'Oportuya':
					$paso = "O-PASO3";
					break;
			}
			$estadoLead = $oportudataLead[0]->ESTADO;
			//establishing connection to OPORTUDATA data base
			$datosCliente->setConnection('oportudata');
			$turnosOportuya->setConnection('oportudata');
			$flag=0;

			$selectAssessor=DB::table('leads')->selectRaw('assessor, created_at as dateLead')
					->whereRaw('identificationNumber = ?',$identificationNumber)->get();

			//$queryCity = sprintf("SELECT `CODIGO` FROM `SUCURSALES` WHERE `CIUDAD` = %s AND `PRINCIPAL` = 1", $oportudataLead[0]->);
			$codeAssessor=$selectAssessor[0]->assessor;
			$dateLead=$selectAssessor[0]->dateLead;
			$sucursal=DB::connection('oportudata')->select(sprintf("SELECT `CODIGO` FROM `SUCURSALES` WHERE `CIUDAD` = '%s' AND `PRINCIPAL` = 1 ", $oportudataLead[0]->CIUD_UBI));
			$sucursal=$sucursal[0]->CODIGO;
			$estado='ANALISIS';
			$ftp=0;
			$state='A';
			$granTotal=0;
			$queryIdEmpresa = sprintf("SELECT `ID_EMPRESA` FROM `ASESORES` WHERE `CODIGO` = '%s'", $codeAssessor);
        	$IdEmpresa = DB::connection('oportudata')->select($queryIdEmpresa);
	
			$flag = 1;

			// Assign data to CLIENTE_FAB columns

			$dataLead=[
				'NIT_EMP' => ($request->get('nit') != '') ? trim($request->get('nit')) : 0,
				'RAZON_SOC' => ($request->get('companyName') != '') ? trim(strtoupper($request->get('companyName'))) : 'NA',
				'DIR_EMP' => ($request->get('companyAddres') != '') ? trim(strtoupper($request->get('companyAddres'))) : 'NA',
				'TEL_EMP' => ($request->get('companyTelephone') != '') ? trim($request->get('companyTelephone')) : 0,
				'TEL2_EMP'	=> ($request->get('companyTelephone2') != '') ? trim($request->get('companyTelephone2')) : 0,
				'ACT_ECO' => ($request->get('eps') != '') ? trim(strtoupper($request->get('eps'))) : '-',
				'CARGO' => ($request->get('companyPosition') != '') ? trim(strtoupper($request->get('companyPosition'))) : 'NA',
				'FEC_ING' => ($request->get('admissionDate') != '') ? trim($request->get('admissionDate')) : '0000/1/1',
				'ANTIG' => ($request->get('antiquity') != '') ? trim($request->get('antiquity')) : 1,
				'SUELDO' => ($request->get('salary') != '') ? trim($request->get('salary')) : 0,
				'TIPO_CONT' => ($request->get('typeContract') != '') ? trim(strtoupper($request->get('typeContract'))) : 'NA',
				'OTROS_ING' => ($request->get('otherRevenue') != '') ? trim($request->get('otherRevenue')) : 0,
				'CAMARAC' => ($request->get('camaraComercio') != '') ? $request->get('camaraComercio') : 'NO',
				'NIT_IND' => ($request->get('nitInd') != '') ? trim($request->get('nitInd')) : 0,
				'RAZON_IND' => ($request->get('companyNameInd') != '') ? trim($request->get('companyNameInd')) : 'NA',
				'ACT_IND' => ($request->get('whatSell') != '') ? trim($request->get('whatSell')) : 'NA',
				'FEC_CONST' => ($request->get('dateCreationCompany') != '') ? trim($request->get('dateCreationCompany')) : '0000/1/1',
				'EDAD_INDP' => ($request->get('antiquityInd') != '') ? trim($request->get('antiquityInd')) : 1,
				'SUELDOIND' => ($request->get('salaryInd') != '') ? trim($request->get('salaryInd')) : 0,
				'BANCOP' => ($request->get('bankSavingsAccount') != '') ? trim($request->get('bankSavingsAccount')) : 'NA',
				'PASO' => $paso
			];

			$identificationNumber = (string)$identificationNumber;

			// Update/save information in CLIENTE_FAB table

			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

			$solic_fab= new Application;

			$solic_fab->setConnection('oportudata');
			if($estadoLead != 'SIN COMERCIAL'){
				$decisionCredit = $this->decisionCredit($identificationNumber);
				if ($decisionCredit < 0) {
					return $decisionCredit;
				}
				$quotaApprovedProduct = $this->execCreditPolicy($identificationNumber);	
			}else{
				$quotaApprovedProduct = 1;
			}

			$estado = "";
			if($quotaApprovedProduct > 0){
				if($estadoLead != 'SIN COMERCIAL'){
					$quotaApproved = '500000';
					$queryScoreLead = sprintf("SELECT `score` FROM `cifin_score` WHERE `scocedula` = %s ORDER BY `scoconsul` DESC LIMIT 1 ", $identificationNumber);
					$respScoreLead = DB::connection('oportudata')->select($queryScoreLead);
					
					$solic_fab->AVANCE_W=$quotaApproved;
					$solic_fab->PRODUC_W=$quotaApprovedProduct;

					$scoreLead = $respScoreLead[0]->score;
				}else{
					$solic_fab->AVANCE_W=0;
					$solic_fab->PRODUC_W=0;
					$scoreLead = 0;
				}
				$solic_fab->CLIENTE=$identificationNumber;
				$solic_fab->CODASESOR=$codeAssessor;
				$solic_fab->ID_EMPRESA=$IdEmpresa[0]->ID_EMPRESA;
				$solic_fab->FECHASOL=date("Y-m-d H:i:s");
				$solic_fab->SUCURSAL=$sucursal;
				$solic_fab->ESTADO="ANALISIS";
				$solic_fab->FTP=$ftp;
				$solic_fab->STATE=$state;
				$solic_fab->GRAN_TOTAL=$granTotal;
				$solic_fab->SOLICITUD_WEB = 1;
				$solic_fab->save();
				$numSolic = $this->getNumSolic($identificationNumber);
				$datosCliente->CEDULA = $identificationNumber;
				$datosCliente->SOLICITUD = $numSolic->SOLICITUD;
				$datosCliente->NOM_REFPER = trim($request->get('NOM_REFPER'));
				$datosCliente->DIR_REFPER = 'NA';
				$datosCliente->BAR_REFPER = 'NA';
				$datosCliente->TEL_REFPER = trim($request->get('TEL_REFPER'));
				$datosCliente->CIU_REFPER = 'NA';
				$datosCliente->NOM_REFPE2 = 'NA';
				$datosCliente->DIR_REFPE2 = 'NA';
				$datosCliente->BAR_REFPE2 = 'NA';
				$datosCliente->TEL_REFPE2 = 0;
				$datosCliente->CIU_REFPE2 = " ";
				$datosCliente->NOM_REFFAM = trim($request->get('NOM_REFFAM'));
				$datosCliente->DIR_REFFAM = 'NA';
				$datosCliente->BAR_REFFAM = 'NA';
				$datosCliente->TEL_REFFAM = trim($request->get('TEL_REFFAM'));
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
				$analisis->data_cli= "0";
				$analisis->data_cod1= "0";
				$analisis->data_cod2= "0";
				$analisis->rec_cod1= "0";
				$analisis->rec_cod2= "0";
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
				/*$analisis->paz_cli = $respQueryTemp[0]->paz_cli;
				$analisis->fos_cliente = $respQueryTemp[0]->fos_cliente;*/
				$analisis->save();
				$estado = "PREAPROBADO";
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
			}else{
				$estado = "NEGADO";
			}
			//$daleteTemp = DB::connection('oportudata')->select('DELETE FROM `temp_consultaFosyga` WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$estado = ($estadoLead != 'SIN COMERCIAL') ? $estado : "SIN COMERCIAL" ;
			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
			$dataLead=[
				'ESTADO' => $estado
			];
			
			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);
			if($estado == 'NEGADO'){
				return response()->json(['data' => false]);
			}elseif($estado == 'PREAPROBADO' || $estado == 'SIN COMERCIAL'){
				$textPreaprobado = ($estadoLead != 'SIN COMERCIAL') ? 1 : 0 ;
				return response()->json(['data' => true, 'quota' => ($quotaApproved > 0) ? $quotaApproved : $quotaApprovedProduct, 'numSolic' => $numSolic->SOLICITUD, 'textPreaprobado' => $textPreaprobado]);				
			}
		}

		if ($request->get('step') == 'comment') {
			$identificationNumber = $request->get('identificationNumber');

			$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
			$oportudataLead = [
				'NOTA1' =>  $request->get('availability'),
				'NOTA2' => trim($request->get('comment'))
			];

			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($oportudataLead);

			return response()->json([true]);
		}
	}


	/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: Administrador de Usuarios
    **Autor: Robert García
    **Email: desarrollo1@lagobo.com
    **Fecha: 20/12/2018
	**/

	public function getNumLead($identificationNumber){
		$getNumVal = DB::connection('oportudata')->select("SELECT `NUM`, `CEL_VAL` FROM `CLI_CEL` WHERE `TIPO` = 'CEL' AND `CEL_VAL` = 1 AND `IDENTI` = :identificationNumber ORDER BY `FECHA` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(count($getNumVal) > 0){
			return response()->json(['resp' => $getNumVal]);
		}

		$getNum = DB::connection('oportudata')->select("SELECT `NUM`, `CEL_VAL` FROM `CLI_CEL` WHERE `TIPO` = 'CEL' AND `IDENTI` = :identificationNumber ORDER BY `FECHA` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);

		if(count($getNum) > 0){
			return response()->json(['resp' => $getNum]);
		}

		return response()->json(['resp' => -1]);
	}

	public function validationLead($identificationNumber){
		$existCard = $this->getExistCard($identificationNumber);
		if($existCard == true){
			return -1; // Tiene tarjeta
		}
		
		$empleado = $this->getExistEmployed($identificationNumber);
		if($empleado == true){
			return -2; // Es empleado
		}

		$existSolicFab = $this->getExistSolicFab($identificationNumber);
		if($existSolicFab == true){
			return -3; // Es empleado
		}

		$existDefault = $this->getExistLeadDefault($identificationNumber);
		if($existDefault == true){
			return -4;
		}

		return response()->json(true);
	}

	public function getCodeVerification($identificationNumber, $celNumber){
		$this->setCodesState($identificationNumber);
		$codeUserVerification = new CodeUserVerification;
		$options = [
			[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
			['A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z']
		];
		$code = '';
		$codeExist = 1;
		while ($codeExist >= 1){
			for ($i=0; $i < 6; $i++) {
				$randomOption = rand(0,1);
				if($randomOption == 0){
					$randomNumChar = rand(0, 9);
				}else{
					$randomNumChar = rand(0, 51);
				}
				$code = $code.$options[$randomOption][$randomNumChar];
			}

			$codeExist = DB::select('SELECT COUNT(`id`) as `totalCodes` FROM `code_user_verification` WHERE `code` = :code ', ['code' => $code]);
			$codeExist = $codeExist[0]->totalCodes;
		}

		$codeUserVerification->code = $code;
		$codeUserVerification->identificationNumber = $identificationNumber;

		$codeUserVerification->save();

		$date = DB::select('SELECT `created_at` FROM `code_user_verification` WHERE `code` = :code ', ['code' => $code]);
		
		$dateTwo = gettype($date[0]->created_at);
		$dateNew = date('Y-m-d H:i:s', strtotime($date[0]->created_at));
		return $this->sendMessageSms($code, $identificationNumber, $dateNew, $celNumber);
	}

	public function getCodeVerificationOportudata($identificationNumber, $celNumber, $type = "ORIGEN"){
		$this->setCodesStateOportudata($identificationNumber);
		$codeUserVerificationOportudata = new codeUserVerificationOportudata;
		$options = [
			[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
			['A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z']
		];
		$code = '';
		$codeExist = 1;
		while ($codeExist >= 1){
			for ($i=0; $i < 6; $i++) {
				$randomOption = rand(0,1);
				if($randomOption == 0){
					$randomNumChar = rand(0, 9);
				}else{
					$randomNumChar = rand(0, 51);
				}
				$code = $code.$options[$randomOption][$randomNumChar];
			}

			$codeExist = DB::connection('oportudata')->select('SELECT COUNT(`identificador`) as `totalCodes` FROM `code_user_verification` WHERE `token` = :code ', ['code' => $code]);
			$codeExist = $codeExist[0]->totalCodes;
		}

		$codeUserVerificationOportudata->token = $code;
		$codeUserVerificationOportudata->identificationNumber = $identificationNumber;
		$codeUserVerificationOportudata->telephone = $celNumber;
		$codeUserVerificationOportudata->type = $type;
		$codeUserVerificationOportudata->created_at = date('Y-m-d H:i:s');

		$codeUserVerificationOportudata->save();

		$date = DB::connection('oportudata')->select('SELECT `created_at` FROM `code_user_verification` WHERE `token` = :code ', ['code' => $code]);
		
		$dateTwo = gettype($date[0]->created_at);
		$dateNew = date('Y-m-d H:i:s', strtotime($date[0]->created_at));
		return $this->sendMessageSms($code, $identificationNumber, $dateNew, $celNumber);
	}

	private function setCodesStateOportudata($identificationNumber){
		$query = sprintf("UPDATE `code_user_verification` SET `state` = 1 WHERE `identificationNumber` = %s ", $identificationNumber);

		$resp = DB::connection('oportudata')->select($query);
	}
	
	public function enviarMensaje(){
		return true;
		$url = 'https://api.hablame.co/sms/envio/';
		$data = array(
			'cliente' => 10013280, //Numero de cliente
			'api' => 'D5jpJ67LPns7keU7MjqXoZojaZIUI6', //Clave API suministrada
			'numero' => '573136392833', //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
			'sms' => 'Probando mensaje 1.2.3', //Mensaje de texto a enviar
			'fecha' => '', //(campo opcional) Fecha de envio, si se envia vacio se envia inmediatamente (Ejemplo: 2017-12-31 23:59:59)
			'referencia' => 'Referenca Envio Hablame', //(campo opcional) Numero de referencio ó nombre de campaña
		);
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = json_decode((file_get_contents($url, false, $context)), true);
	
		if ($result["resultado"]===0){
			$mensaje = 'Se ha enviado el SMS exitosamente';
		}else{
			$mensaje = 'ha ocurrido un error!!';
		}
	
		return response()->json([$mensaje, $result]);
	}

	public function sendMessageSms($code, $identificationNumber, $date, $celNumber){
		$url = 'https://api.hablame.co/sms/envio/';
		$data = array(
			'cliente' => 10013280, //Numero de cliente
			'api' => 'D5jpJ67LPns7keU7MjqXoZojaZIUI6', //Clave API suministrada
			'numero' => '57'.$celNumber, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
			'sms' => 'El token de verificacion para Servicios Oportunidades es '.$code." el cual tiene una vigencia de 10 minutos. Aplica TyC http://bit.ly/2HX67DR - " . $date, //Mensaje de texto a enviar
			'fecha' => '', //(campo opcional) Fecha de envio, si se envia vacio se envia inmediatamente (Ejemplo: 2017-12-31 23:59:59)
			'referencia' => 'Verificación', //(campo opcional) Numero de referencio ó nombre de campaña
		);
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = json_decode((file_get_contents($url, false, $context)), true);
	
		if($result["resultado"]===0){
			$mensaje = 'Se ha enviado el SMS exitosamente';
		}else{
			$mensaje = 'ha ocurrido un error!!';
		}
	
		return response()->json(true);
	}

	public function verificationCode($code, $identificationNumber){
		$getCode = DB::connection('oportudata')->select(sprintf('SELECT `token`, `created_at` FROM `code_user_verification` WHERE `identificationNumber` = %s AND `state` = 0 ORDER BY `identificador` DESC LIMIT 1 ', $identificationNumber));
		$dateNow =strtotime(date('Y-m-d H:i:s'));
		$dateCode = date('Y-m-d H:i:s', strtotime($getCode[0]->created_at));
		$smsVigency = DB::connection('oportudata')->select("SELECT `sms_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$smsVigency = $smsVigency[0]->sms_vigencia;
		$dateCodeNew = strtotime ("+ $smsVigency minute", strtotime ( $dateCode ) );
		if($dateNow <= $dateCodeNew){
			if($code === $getCode[0]->token){
				$updateCode = DB::connection('oportudata')->select(sprintf('UPDATE `code_user_verification` SET `state` = 1 WHERE `token` = "%s" ', $code));
				return response()->json(true);
			}else{
				return response()->json(-1);
			}
		}else{
			return response()->json(-2);
		}
	}
	

	private function setCodesState($identificationNumber){
		$query = sprintf("UPDATE `code_user_verification` SET `state` = 1 WHERE `identificationNumber` = %s ", $identificationNumber);

		$resp = DB::select($query);
	}

	public function getContactData($identificationNumber){
		$query = sprintf("SELECT `NOMBRES` as name, `APELLIDOS` as lastName, `EMAIL` as email, `TELFIJO` as telephone, `CIUD_UBI` as city, `TIPO_DOC` as typeDocument, `CEDULA` as identificationNumber, `ACTIVIDAD` as occupation FROM `CLIENTE_FAB` WHERE `CEDULA` = %s LIMIT 1 ", trim($identificationNumber));

		$resp = DB::connection('oportudata')->select($query);

		return response()->json($resp[0]);
	}

	private function getNumSolic($identificationNumber){
		$query = sprintf("SELECT `SOLICITUD` FROM `SOLIC_FAB` WHERE `CLIENTE` = %s ORDER BY SOLICITUD DESC LIMIT 1 ", $identificationNumber);

		$resp = DB::connection('oportudata')->select($query);

		return $resp[0];
	}

	private function getExistCard($identificationNumber){
		$queryExistCard = sprintf("SELECT COUNT(`NUMERO`) as numTarjeta FROM `TARJETA` WHERE `CLIENTE` = %s ", $identificationNumber);

		$resp = DB::connection('oportudata')->select($queryExistCard);

		if($resp[0]->numTarjeta > 0){
			return true; // Tiene tarjeta
		}else{
			return false; // No tiene tarjeta
		}
	}

	private function getExistEmployed($identificationNumber){
		$queryExistEmployed = sprintf("SELECT COUNT(`identificador`) as totalEmployes FROM `LISTA_EMPLEADOS` WHERE `num_documento` = %s AND `estado` = 1 ", $identificationNumber);

		$resp = DB::connection('oportudata')->select($queryExistEmployed);

		if($resp[0]->totalEmployes > 0){
			return true; // Es empleado
		}else{
			return false; // No es empelado
		}
	}

	private function getExistSolicFab($identificationNumber){
		$timeRejectedVigency = DB::connection('oportudata')->select("SELECT `rechazado_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$timeRejectedVigency = $timeRejectedVigency[0]->rechazado_vigencia;
		$dateNow = date('Y-m-d');
		$dateNow = strtotime ("- $timeRejectedVigency day", strtotime ( $dateNow ) );
		$dateNow = date ( 'Y-m-d' , $dateNow );
		$queryExistSolicFab = sprintf("SELECT COUNT(`SOLICITUD`) as totalSolicitudes FROM `SOLIC_FAB` WHERE (`ESTADO` = 'ANALISIS' OR `ESTADO` = 'NEGADO' OR `ESTADO` = 'DESISTIDO' ) AND `CLIENTE` = '%s' AND `FECHASOL` > '%s' AND `STATE` = 'A' ", $identificationNumber, $dateNow);
		$resp = DB::connection('oportudata')->select($queryExistSolicFab);

		if($resp[0]->totalSolicitudes > 0){
			return true; // Tiene Solictud
		}else{
			return false; // No tiene solicitud
		}
	}

	private function getExistLeadDefault($identificationNumber){
		$queryExistDefault = sprintf("SELECT COUNT(`cedula`) as `totalDefault` FROM `TB_CASTIGO` WHERE `cedula` = %s ", $identificationNumber);

		$resp = DB::connection('oportudata')->select($queryExistDefault);

		if($resp[0]->totalDefault > 0){
			return true; // Esta en mora
		}else{
			return false; // No esta en mora
		}
	}

	private function validateDateConsultaComercial($identificationNumber){
		$daysToIncrement = DB::connection('oportudata')->select("SELECT `pub_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$daysToIncrement = $daysToIncrement[0]->pub_vigencia;
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- $daysToIncrement day", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		$dateLastConsultaComercial = DB::connection('oportudata')->select("SELECT fecha FROM consulta_ws WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastConsultaComercial)){
			return 'true';
		}else{
			$dateLastConsulta = $dateLastConsultaComercial[0]->fecha;

			if(strtotime($dateLastConsulta) < strtotime($dateNew)){
				return 'true';
			}else{
				return 'false';
			}
		}
	}

	private function validateDateConsultaFosyga($identificationNumber){
		$daysToIncrement = DB::connection('oportudata')->select("SELECT `pub_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$daysToIncrement = $daysToIncrement[0]->pub_vigencia;
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- $daysToIncrement day", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		$dateLastConsultaFosyga = DB::connection('oportudata')->select("SELECT fechaConsulta, fuenteFallo FROM fosyga_bdua WHERE cedula = :identificationNumber ORDER BY idBdua DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastConsultaFosyga)){
			return 'true';
		}else{
			if($dateLastConsultaFosyga[0]->fuenteFallo == "SI"){
				return 'true';
			}

			$dateLastConsulta = $dateLastConsultaFosyga[0]->fechaConsulta;

			if(strtotime($dateLastConsulta) < strtotime($dateNew)){
				return 'true';
			}else{
				return 'false';
			}
		}
	}

	private function validateDateConsultaRegistraduria($identificationNumber){
		$daysToIncrement = DB::connection('oportudata')->select("SELECT `pub_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$daysToIncrement = $daysToIncrement[0]->pub_vigencia;
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- $daysToIncrement day", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		$dateLastConsultaFosyga = DB::connection('oportudata')->select("SELECT fechaConsulta, fuenteFallo FROM fosyga_estadoCedula WHERE cedula = :identificationNumber ORDER BY idEstadoCedula DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastConsultaFosyga)){
			return "true";
		}else{
			if($dateLastConsultaFosyga[0]->fuenteFallo == "SI"){
				return "true";
			}

			$dateLastConsulta = $dateLastConsultaFosyga[0]->fechaConsulta;

			if(strtotime($dateLastConsulta) < strtotime($dateNew)){
				return "true";
			}else{
				return 'false';
			}
		}
	}

	private function validateDateExperto($identificationNumber){
		$daysToIncrement = DB::connection('oportudata')->select("SELECT `pub_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$daysToIncrement = $daysToIncrement[0]->pub_vigencia;
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- $daysToIncrement day", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		$dateLastExperto = DB::connection('oportudata')->select("SELECT fecha FROM consulta_exp WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastExperto)){
			return 'true';
		}else{
			$dateLastConsulta = $dateLastExperto[0]->fecha;

			if(strtotime($dateLastConsulta) < strtotime($dateNew)){
				return 'true';
			}else{
				return 'false';
			}
		}
	}

	private function applyTrim($charItem){
		
		$charTrim = trim($charItem);
		return $charTrim; 

	}

	public function creditPolicyAdvance($identificationNumber){

		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(($queryScoreClient[0]->score) < 686 ){
			return response()->json([false]);	
		}

		$sfMainAccount=sprintf("SELECT COUNT(`fdcalid`) AS sumFdCalid FROM `cifin_findia` WHERE `fdcedula`=%s AND fdcalid='PRIN'",$identificationNumber);
		$paymentFinDia=sprintf("SELECT fdcompor FROM OPORTUDATA1.cifin_findia WHERE fdcedula=%s AND fdcalid='PRIN'",$identificationNumber);
		$sfMainAccountQuery= DB::connection('oportudata')->select($sfMainAccount);
		
		if(($sfMainAccountQuery[0]->sumFdCalid) < 1){
			return response()->json([false]);
		}

		$paymentFinDiaQuery= DB::connection('oportudata')->select($paymentFinDia);
		$totalPayment=0;
		
		foreach($paymentFinDiaQuery as $key => $payment){

			$paymentArray = explode('|',$payment->fdcompor);
			$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
			$elementsPayment = array_keys(($paymentArray),'N');
			$paymentsNumber = count($elementsPayment);

			$totalPayment=$totalPayment+$paymentsNumber;

		}

		if($totalPayment < 12 ){
			$paymentFinExt = sprintf("SELECT extcompor  FROM OPORTUDATA1.cifin_finext WHERE extcedula=%s AND extcalid='PRIN'",$identificationNumber);
			$queryPaymentExt=DB::connection('oportudata')->select($paymentFinExt);
			$totalPaymentExt=0;
			foreach($queryPaymentExt as $key => $paymentExt){
				$paymentExtArray = explode('|',$paymentExt->extcompor);
				$paymentExtArray = array_map(array($this,'applyTrim'),$paymentExtArray);
				$elementsPaymentExt = array_keys($paymentExtArray,'N ');
				$paymentsExtNumber = count($elementsPaymentExt);
	
				$totalPaymentExt=$totalPaymentExt+$paymentsExtNumber;
	
			}
			$sumPayments = $totalPayment + $totalPaymentExt;

			if($sumPayments < 12){
				return response()->json([false]);
			}

			return response()->json([false]);
			
		}
		return  response()->json([true]);
	}

	public function execCreditPolicy($identificationNumber){
		// Negacion, condicion 1, vectores comportamiento
		$queryVectores = sprintf("SELECT fdcompor, fdconsul FROM `cifin_findia` WHERE `fdconsul` = (SELECT MAX(`fdconsul`) FROM `cifin_findia` WHERE `fdcedula` = '%s' ) AND `fdcedula` = '%s' AND `fdtipocon` != 'SRV' ", $identificationNumber, $identificationNumber);

		$respVectores = DB::connection('oportudata')->select($queryVectores);
		$aprobado = false;
		foreach ($respVectores as $key => $payment) {
			$aprobado = false;
			$paymentArray = explode('|',$payment->fdcompor);
			$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
			$popArray = array_pop($paymentArray);
			$paymentArray = array_reverse($paymentArray);
			$paymentArray = array_splice($paymentArray, 0, 12);
			$elementsPaymentExt = array_keys($paymentArray,'N');
			$paymentsExtNumber = count($elementsPaymentExt);
			if ($paymentsExtNumber == 12) {
				$aprobado = true;
				break;
			}
		}

		if($aprobado == false){
			return -1; // Credito negado
		}

		
		// Negacion, codicion 2, saldo en mora

		$queryValorMoraFinanciero = sprintf("SELECT SUM(`finvrmora`) as totalMoraFin
		FROM `cifin_finmora` 
		WHERE `finconsul` = (SELECT MAX(`finconsul`) FROM `cifin_finmora` WHERE `fincedula` = %s )
		AND `fincedula` = %s AND `fincalid` != 'CODE' AND `fintipocon` != 'SRV' ", $identificationNumber, $identificationNumber);

		$respValorMoraFinanciero = DB::connection('oportudata')->select($queryValorMoraFinanciero);

		$queryValorMoraReal = sprintf("SELECT SUM(`rmvrmora`) as totalMoraReal
		FROM `cifin_realmora` 
		WHERE `rmconsul` = (SELECT MAX(`rmconsul`) FROM `cifin_realmora` WHERE `rmcedula` = %s )
		AND `rmcedula` = %s AND (`rmtipoent` != 'COMU' OR `rmcalid` != 'CODE') AND `rmtipocon` != 'SRV' ", $identificationNumber, $identificationNumber);

		$respValorMoraReal = DB::connection('oportudata')->select($queryValorMoraReal);

		$totalValorMora = $respValorMoraFinanciero[0]->totalMoraFin + $respValorMoraReal[0]->totalMoraReal;
		
		if($totalValorMora > 100){
			return -2; // Credito negado
		}

		return 1300000;
	}

	private function getQuotaApproved($typeValidation, $identificationNumber){
		// typeValidation = 1 Sin Historia Comercial, 2 Con historia Comercial
		$quotaApproved = 0;
		$queryOccupationLead = sprintf("SELECT `ACTIVIDAD` FROM `CLIENTE_FAB` WHERE `CEDULA` = %s ", $identificationNumber);
		$respOccupationLead = DB::connection('oportudata')->select($queryOccupationLead);
		$occupation = $respOccupationLead[0]->ACTIVIDAD;

		$queryScoreLead = sprintf("SELECT `score` FROM `cifin_score` WHERE `scocedula` = %s ORDER BY `scoconsul` DESC LIMIT 1 ", $identificationNumber);
		$respScoreLead = DB::connection('oportudata')->select($queryScoreLead);
		$score = $respScoreLead[0]->score;
		
		if($typeValidation == 1){
			// Sin historia comercial
			if($occupation == 'EMPLEADO' || $occupation == 'PENSIONADO'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 2100000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 2300000;
				}
			}elseif($occupation == 'INDEPENDIENTE CERTIFICADO'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 1700000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 1900000;
				}
			}elseif($occupation == 'NO CERTIFICADO' || $occupation == 'RENTISTA' || $occupation == 'PRESTACIÓN DE SERVICIOS'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 1500000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 1500000;
				}
			}
		}else{
			// Con historia comercial
			if($occupation == 'EMPLEADO' || $occupation == 'PENSIONADO'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 2300000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 2500000;
				}
			}elseif($occupation == 'INDEPENDIENTE CERTIFICADO'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 1900000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 2100000;
				}
			}elseif($occupation == 'NO CERTIFICADO' || $occupation == 'RENTISTA' || $occupation == 'PRESTACIÓN DE SERVICIOS'){
				if($score >= 686 && $score <= 725){
					$quotaApproved = 1700000;
				}
				if($score >= 726 && $score <= 1000){
					$quotaApproved = 1700000;
				}
			}
		}

		return $quotaApproved;
	}

	private function validatePolicyCredit($identificationNumber, $cityName){
		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		
		if(empty($queryScoreClient)){
			return false;
		}else{
			$respScoreClient = $queryScoreClient[0]->score;
			
			/*$queryScoreCreditPolicy = DB::connection('mysql')->select("SELECT score FROM credit_policy LIMIT 1");
			$respScoreCreditPolicy = $queryScoreCreditPolicy[0]->score;*/
			$scoreMin = 528;
			if($cityName == 'MEDELLÍN' || $cityName =='BOGOTÁ'){
				$scoreMin = 726;
			}

			if($respScoreClient >= -7 && $respScoreClient <= 0){
				return true;
			}

			if($respScoreClient >= $scoreMin){
				return true;
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "RECHAZADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				return false;
			}
		}
	}

	private function decisionCredit($identificationNumber){
		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);

		$respScoreClient = $queryScoreClient[0]->score;

		if ($respScoreClient >= -7 && $respScoreClient <= 0) {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "SIN HISTORIAL" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -4; // Sin Historial Crediticio
		}

		if ($respScoreClient >= 528 && $respScoreClient <= 624) {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "ALMACEN" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -1; // En almacen
		}

		if ($respScoreClient >= 625 && $respScoreClient <= 675) {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "TRADICIONAL" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -2; // Tradicional
		}

		if ($respScoreClient > 676) {
			return 1;
		}
	}

	private function execConsultaComercial($identificationNumber, $typeDocument){
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->identificationNumber = trim($identificationNumber);
		try {
			// 2923 Produccion, 2020 Pruebas, 2801 CreditVision Produccion, 2001 CreditVision Pruebas
			$ws = new \SoapClient("http://10.238.14.181:2801/Service1.svc?singleWsdl",array()); //correcta
			$result = $ws->ConsultarInformacionComercial($obj);  // correcta
			return 1;
		}catch (\Throwable $th){
			return 0;
		}
	}

	public function execConsultaFosyga($identificationNumber, $typeDocument, $dateExpeditionDocument){
		$bdua = new Bdua;

		// Consulta bdua - Base de datos unificada
		$infoBdua = $this->execWebServiceFosyga($identificationNumber, '23948865', $typeDocument, "");
		$infoBdua = (array) $infoBdua;
		$infoBdua = $infoBdua['original'];
		if($infoBdua['fuenteFallo'] == "SI"){
			$bdua->cedula = $identificationNumber;
			$bdua->fuenteFallo = "SI";
			$bdua->save();
			return -1; 
		}
		$bdua->cedula = $infoBdua['personaVO']['numeroDocumento'];
		$bdua->tipoDocumento = $infoBdua['personaVO']['tipoDocumento'];
		$bdua->pais = $infoBdua['personaVO']['pais'];
		$bdua->primerNombre = $infoBdua['personaVO']['nombres']['BDUA']['primerNombre'];
		$bdua->primerApellido = $infoBdua['personaVO']['nombres']['BDUA']['primerApellido'];
		$bdua->tipoNombre = $infoBdua['personaVO']['nombres']['BDUA']['tipoNombre'];
		$bdua->estado = $infoBdua['estado'];
		$bdua->entidad = $infoBdua['entidad'];
		$bdua->regimen = $infoBdua['regimen'];
		$bdua->fechaAfiliacion = $infoBdua['fechaAfiliacion'];
		$bdua->fechaFinalAfiliacion = $infoBdua['fechaFinalAfiliacion'];
		$bdua->departamento = $infoBdua['departamento'];
		$bdua->ciudad = $infoBdua['ciudad'];
		$bdua->tipoAfiliado = $infoBdua['tipoAfiliado'];
		$bdua->fechaConsulta = $infoBdua['fechaConsulta'];
		$bdua->fuenteFallo = $infoBdua['fuenteFallo'];
		$bdua->save();

		return 1;
	}

	public function execConsultaRegistraduria($identificationNumber, $typeDocument, $dateExpeditionDocument){
		$estadoCedula = new EstadoCedula;
		// Consulta estado cedula
		$infoEstadoCedula = $this->execWebServiceFosyga($identificationNumber, '91891024', $typeDocument, $dateExpeditionDocument);
		$infoEstadoCedula = (array) $infoEstadoCedula;
		$infoEstadoCedula = $infoEstadoCedula['original'];
		if($infoEstadoCedula['fuenteFallo'] == "SI"){
			$estadoCedula->cedula = $identificationNumber;
			$estadoCedula->fuenteFallo = "SI";
			$estadoCedula->save();
			return -1; 
		}
		$estadoCedula->cedula = $infoEstadoCedula['personaVO']['numeroDocumento'];
		$estadoCedula->tipoDocumento = $infoEstadoCedula['personaVO']['tipoDocumento'];
		$estadoCedula->pais = $infoEstadoCedula['personaVO']['pais'];
		$estadoCedula->primerNombre = $infoEstadoCedula['personaVO']['nombres']['ESTADO-CEDULA-COLOMBIA']['primerNombre'];
		$estadoCedula->tipoNombre = $infoEstadoCedula['personaVO']['nombres']['ESTADO-CEDULA-COLOMBIA']['tipoNombre'];
		$estadoCedula->fechaExpedicion = $infoEstadoCedula['fechaExpedicion'];
		$estadoCedula->lugarExpedicion = $infoEstadoCedula['lugarExpedicion'];
		$estadoCedula->estado = $infoEstadoCedula['estado'];
		$estadoCedula->resolucion = $infoEstadoCedula['resolucion'];
		$estadoCedula->fechaResolucion = $infoEstadoCedula['fechaResolucion'];
		$estadoCedula->fechaConsulta = $infoEstadoCedula['fechaConsulta'];
		$estadoCedula->fuenteFallo = $infoEstadoCedula['fuenteFallo'];
		$estadoCedula->save();
		
		return 1;
	}

	public function validateConsultaFosyga($identificationNumber, $names, $lastName, $dateExpedition){
		// Fosyga
		$queryBdua = sprintf("SELECT LOWER(`primerNombre`) as primerNombre, LOWER(`primerApellido`) as primerApellido, `regimen`, `tipoAfiliado` 
		FROM `fosyga_bdua` 
		WHERE `cedula` = '%s' ORDER BY `idBdua` DESC LIMIT 1 ", $identificationNumber, $identificationNumber);
		$respBdua = DB::connection('oportudata')->select($queryBdua);

		$daleteTemp = DB::connection('oportudata')->select('INSERT INTO `temp_consultaFosyga` (`cedula`, `fos_cliente`) VALUES (:identificationNumber, :fos_cliente)', ['identificationNumber' => $identificationNumber, 'fos_cliente' => $respBdua[0]->tipoAfiliado]);

		$nameDataLead = explode(" ",$names);
		$nameBdua = explode(" ",$respBdua[0]->primerNombre);
		$coincideNames = $this->compareNamesLastNames($nameDataLead, $nameBdua);
		
		$lastNameDataLead = explode(" ",$lastName);
		$lastNameBdua = explode(" ",$respBdua[0]->primerApellido);
		$coincideLastNames = $this->compareNamesLastNames($lastNameDataLead, $lastNameBdua);
		
		if($coincideNames == 0 || $coincideLastNames == 0){
			$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "FOSYGA" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -3; // Nombres y/o apellidos no coinciden
		}

		return 1;
	}

	public function validateConsultaRegistraduria($identificationNumber, $names, $lastName, $dateExpedition){
		// Registraduria
		$queryEstadoCedula = sprintf("SELECT LOWER(`fechaExpedicion`) as fechaExpedicion, estado 
		FROM `fosyga_estadoCedula` 
		WHERE  `cedula` = '%s' ORDER BY `idEstadoCedula` DESC LIMIT 1 ", $identificationNumber, $identificationNumber);

		$respEstadoCedula = DB::connection('oportudata')->select($queryEstadoCedula);

		$dateExpEstadoCedula = $respEstadoCedula[0]->fechaExpedicion;
		$dateExpEstadoCedula = str_replace(" de ", "/", $dateExpEstadoCedula);
		
		$dateExplode = explode("/", $dateExpEstadoCedula);
		$numMonth = $this->getNumMonthOfText($dateExplode[1]);
		$dateExpEstadoCedula = str_replace($dateExplode[1],$numMonth,$dateExpEstadoCedula);
		$dateExplode = explode("/", $dateExpEstadoCedula);
		$dateExpEstadoCedula = $dateExplode[2]."/".$dateExplode[1]."/".$dateExplode[0];

		if(strtotime($dateExpedition) != strtotime($dateExpEstadoCedula)){
			$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "REGISTRADURIA" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -4; // Fecha de expedicion no coincide
		}

		if ($respEstadoCedula[0]->estado != 'VIGENTE') {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "REGISTRADURIA" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -1; // Cedula no vigente
		}

		$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
		$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "COINCIDE" WHERE `cedula` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
		return 1;
	}

	private function compareNamesLastNames($arrayCompare, $arrayCompareTo){
		$coincide = 0;
		foreach ($arrayCompare as $value) {
			if (in_array($value, $arrayCompareTo)) {
				$coincide = 1;
			}else{
				$coincide = 0;
				break;
			}
		}

		return $coincide;
	}

	private function getNumMonthOfText($monthText){
		$numMonth;
		switch ($monthText) {
			case 'enero':
				$numMonth = "01";
				break;
			
			case 'febrero':
				$numMonth = "02";
				break;

			case 'marzo':
				$numMonth = "03";
				break;

			case 'abril':
				$numMonth = "04";
				break;

			case 'mayo':
				$numMonth = "05";
				break;

			case 'junio':
				$numMonth = "06";
				break;

			case 'julio':
				$numMonth = "07";
				break;

			case 'agosto':
				$numMonth = "08";
				break;

			case 'septiembre':
				$numMonth = "09";
				break;

			case 'octubre':
				$numMonth = "10";
				break;

			case 'noviembre':
				$numMonth = "11";
				break;

			case 'diciembre':
				$numMonth = "12";
				break;
		}

		return $numMonth;
	}

	private function execWebServiceFosyga($identificationNumber, $idConsultaWebService, $tipoDocumento, $dateExpeditionDocument = ""){
		$urlConsulta = sprintf('http://test.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4G0bo&jor=%s&icf=%s&thy=co&klm=%s', $idConsultaWebService, $tipoDocumento, $identificationNumber);
		//$urlConsulta = sprintf('http://test.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4G0bo&jor=%s&icf=%s&thy=co&klm=ND1098XX', $idConsultaWebService, $tipoDocumento);
		if ($dateExpeditionDocument != '') {
			$urlConsulta .= sprintf('&hgu=%s', $dateExpeditionDocument);
		}
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,$urlConsulta);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,0);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		$persona = json_decode($buffer, true);

		return response()->json($persona);
	}

	private function execConsultaExperto($identificationNumber){
		$solic_fab= new Application;
		if($identificationNumber == '') return -1;
		$query = sprintf("SELECT `TIPO_DOC` as typeDocument, `CEDULA` as identificationNumber, CONCAT(`APELLIDOS`, ' ', `NOMBRES`) as name, `DIRECCION` as address, `FEC_NAC` as birthdate, expTi.`id` as housingTime, expTipo.`id` as housingType, `SUELDO` as salary, `ANTIG` as antiquity, expActi.`id` as occupation
						FROM `CLIENTE_FAB` as cf
						LEFT JOIN `exp_tiempoviv` as expTi ON cf.`TIEMPO_VIV` = expTi.`consec`
						LEFT JOIN `exp_tipoviv` as expTipo ON cf.`TIPOV` = expTipo.`consec`
						LEFT JOIN `exp_actividad` as expActi ON cf.`ACTIVIDAD` = expActi.`consec`
						WHERE `CEDULA` = %s ", $identificationNumber);

		/*$respLead = DB::connection('oportudata')->select($query);
		$obj = new \stdClass();
		$lead = $respLead[0];
		$obj->typeDocument = $lead->typeDocument; // Tipo de documento
		$obj->identificationNumber = $lead->identificationNumber; // Numero de identificacion
		$obj->name = $lead->name; // NOMBRE
		$obj->address = $lead->address; // DIRECCION ACTUAL
		$obj->birthdate = $lead->birthdate; // FECHA DE NACIMIENTO
		$obj->housingTime = $lead->housingTime; // TIEMPO DE VIVIENDA ARRENDADA
		$obj->housingType = $lead->housingType; // TIPO_DE_VIVIENDA
		$obj->salary = $lead->salary; // INGRESOS
		$obj->antiquity = $lead->antiquity; // TIEMPO LABOR MESES
		$obj->creditsClosed = "0"; // CREDITOS CERRADOS CON LAGOBO, FIJO
		$obj->paymentHabit = "13588"; // HABITO DE PAGO CON LAGOBO, FIJO
		$obj->monthLastPayment = "13592"; // MESES_DESDE_LA_ULTIMA_CANCELACION, FIJO
		$obj->requestAmount = "1500000"; // MONTO SOLICITADO
		$obj->term = "0"; // PLAZO_
		$obj->suc = "9999"; // SUCURSAL, FIJO
		$obj->typeClient = "13593"; // TIPO_DE_CLIENTE, FIJO
		$obj->rateInterest = "1"; // Tasa de interes , FIJO
		$obj->typeArticle = "13599"; // Tipo de Articulo, TIPO
		$obj->shareValue = "350000"; // VALOR CUOTA, FIJO
		$obj->occupation = $lead->occupation; // ACTIVIDAD_ECONOMICA */

		$obj = new \stdClass();

		$obj->typeDocument = 1; // Tipo de documento
		$obj->identificationNumber = "43185409"; // Numero de identificacion
		$obj->name = "CRUZ QUIMBAYO YINA ROCIO"; // NOMBRE
		$obj->address = "Centro"; // DIRECCION ACTUAL
		$obj->birthdate = "1990-02-20"; // FECHA DE NACIMIENTO
		$obj->housingTime = "13573"; // TIEMPO DE VIVIENDA ARRENDADA
		$obj->housingType = "13575"; // TIPO_DE_VIVIENDA
		$obj->salary = "2000000"; // INGRESOS
		$obj->antiquity = "3"; // TIEMPO LABOR MESES
		$obj->creditsClosed = "0"; // CREDITOS CERRADOS CON LAGOBO, FIJO
		$obj->paymentHabit = "13588"; // HABITO DE PAGO CON LAGOBO, FIJO
		$obj->monthLastPayment = "13592"; // MESES_DESDE_LA_ULTIMA_CANCELACION, FIJO
		$obj->requestAmount = "1500000"; // MONTO SOLICITADO
		$obj->term = "0"; // PLAZO_
		$obj->suc = "9999"; // SUCURSAL, FIJO
		$obj->typeClient = "13593"; // TIPO_DE_CLIENTE, FIJO
		$obj->rateInterest = "1"; // Tasa de interes , FIJO
		$obj->typeArticle = "13599"; // Tipo de Articulo, TIPO
		$obj->shareValue = "350000"; // VALOR CUOTA, FIJO
		$obj->occupation = "13601"; // ACTIVIDAD_ECONOMICA

		$ws = new \SoapClient("http://10.238.14.181:3000/Experto.svc?singleWsdl",array()); //correcta
		$result = $ws->ConsultarExperto($obj);  // correcta
		return response()-json($result);
		$solic_fab->setConnection('oportudata');
		$solic_fab->CLIENTE=$identificationNumber;
		$solic_fab->CODASESOR="998877";
		$solic_fab->FECHASOL=date("Y-m-d H:i:s");
		$solic_fab->SUCURSAL="9999";
		$solic_fab->ESTADO="ANALISIS";
		$solic_fab->FTP=0;
		$solic_fab->STATE="A";
		$solic_fab->GRAN_TOTAL=0;
		$solic_fab->SOLICITUD_WEB = 1;
		$solic_fab->save();

		$numSolic = $this->getNumSolic($identificationNumber);
		return response()->json(['numSolic' => $numSolic]);
	}

	private function getCity($code){
		$queryCity = sprintf("SELECT `CIUDAD` FROM `SUCURSALES` WHERE `CODIGO` = %s ", $code);

		$resp = DB::connection('oportudata')->select($queryCity);

		return $resp;
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

		return $resp[0];
	}

	public function advanceStep1(){
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

		return view('advance.step1', ['digitalAnalyst' => $digitalAnalyst[0], 'cities' => array_sort($cities, 'label', SORT_DESC)]);
	}

	public function advanceStep2($string){
		$identificactionNumber = $this->decrypt($string);

		return view('advance.step2', ['identificactionNumber' => $identificactionNumber]);
	}

	public function advanceStep3($string){
		$identificactionNumber = $this->decrypt($string);

		return view('advance.step3', ['identificactionNumber' => $identificactionNumber]);
	}
	
	public function getDataStep1(){
		$query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 ORDER BY CIUDAD ASC";

		$resp = DB::connection('oportudata')->select($query);

		return $resp;
	}

	public function getDataStep1New(){
		$queryActividad = "SELECT `consec` as value, `actividad` as label FROM `exp_actividad` ORDER BY `consec` ASC ";
		$respActividad = DB::connection('oportudata')->select($queryActividad);

		$query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 ORDER BY CIUDAD ASC";
		$resp = DB::connection('oportudata')->select($query);

		return response()->json(['occupations' => $respActividad, 'cities' => $resp]);
	}

	public function getDataStep2($identificationNumber){
	      $data = [];

	      $query2 = "SELECT `code` as value, `name` as label FROM `ciudades` ORDER BY name ";

	      $queryOportudataLead = sprintf("SELECT NOMBRES as name, APELLIDOS as lastName, SUC as branchOffice, CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, CELULAR as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);

	      $respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);
	      $resp2 = DB::select($query2);

	      $digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

	      $data['digitalAnalyst'] = $digitalAnalysts[0];
	      $data['cities'] = $resp2;
	      $data['oportudataLead'] = $respOportudataLead[0];

	      return $data;

	}

	public function getDataStep2New($identificationNumber){
		$data = [];

		$query2 = "SELECT `code` as value, `name` as label FROM `ciudades` ORDER BY name ";
		$resp2 = DB::select($query2);

		$queryOportudataLead = sprintf("SELECT NOMBRES as name, APELLIDOS as lastName, SUC as branchOffice, CEDULA as identificationNumber, SEXO as gender, DIRECCION as addres, FEC_NAC as birthdate, CIUD_EXP as cityExpedition, ESTADOCIVIL as civilStatus, FEC_EXP as dateDocumentExpedition, PROPIETARIO as housingOwner, TIPOV as housingType, TIEMPO_VIV as housingTime, CELULAR as housingTelephone, VRARRIENDO as leaseValue, EPS_CONYU as spouseEps, NOMBRE_CONYU as spouseName, CEDULA_C as spouseIdentificationNumber, TRABAJO_CONYU as spouseJob, CARGO_CONYU as spouseJobName, PROFESION_CONYU as spouseProfession, SALARIO_CONYU as spouseSalary, CELULAR_CONYU as spouseTelephone, ESTRATO as stratum FROM CLIENTE_FAB WHERE CEDULA = %s ", $identificationNumber);
		$respOportudataLead = DB::connection('oportudata')->select($queryOportudataLead);

		$queryTipoViv = "SELECT `consec` as value, `tipoviv` as label FROM `exp_tipoviv` ORDER BY `consec` ASC";
		$respTipoViv = DB::connection('oportudata')->select($queryTipoViv);

		$queryAntiquity = "SELECT `consec` as value, `tiempoviv` as label FROM `exp_tiempoviv` ORDER BY `consec` ASC";
		$respAntiquity = DB::connection('oportudata')->select($queryAntiquity);

		$digitalAnalysts = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		$data['digitalAnalyst'] = $digitalAnalysts[0];
		$data['cities'] = $resp2;
		$data['housingTypes'] = $respTipoViv;
		$data['housingTimes'] = $respAntiquity;
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

	public function getDataStep3($identificationNumber){
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


	private function calculateAge($fecha){
		$time = strtotime($fecha);
		$now = time();
		$age = ($now-$time)/(60*60*24*365.25);
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


	public function step2($string){
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

	public function step3($string){
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

	public function encrypt($string) {
		$string = utf8_encode($string);
		$control1 = "*]wy";
		$control2 = "3/~";
		$string = $control1.$string.$control2;
		$string = base64_encode($string);

		return $string;
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
