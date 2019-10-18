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
use App\Intenciones;
use App\cliCel;
use App\CreditPolicy;
use App\ResultadoPolitica;
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
use App\Exports\ExportToExcel;
use Maatwebsite\Excel\Facades\Excel;

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
			$lead= new Lead;
			$oportudataLead= new OportuyaV2;
			$identificationNumber = trim($request->get('identificationNumber'));
			$cityName = $this->getCity($request->get('city'));
			$getIdcityUbi = $this->getIdcityUbi(trim($cityName[0]->CIUDAD));
			$departament = $this->getCodeAndDepartmentCity(trim($cityName[0]->CIUDAD));
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
			$createLead = $lead->updateOrCreate(['identificationNumber'=>$identificationNumber],$dataLead)->save();

			$getExistLead = OportuyaV2::find($identificationNumber);
			$clienteWeb = 1;
			$usuarioCreacion = (string) $assessorCode;
			$usuarioActualizacion = "";
			if(!empty($getExistLead)){
				$clienteWeb = $getExistLead->CLIENTE_WEB;
				$usuarioCreacion = $getExistLead->USUARIO_CREACION;
				$usuarioActualizacion = (string) $assessorCode;
			}
			$dataOportudata=[
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
				'SUC' => $request->get('city'),
				'ESTADO' => $estado,
				'PASO' => $paso,
				'ORIGEN' => $request->get('typeService'),
				'CLIENTE_WEB' => $clienteWeb,
				'TRAT_DATOS' => "SI",
				'USUARIO_CREACION' => $usuarioCreacion,
				'USUARIO_ACTUALIZACION' => $usuarioActualizacion,
				'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
				'ID_CIUD_UBI' => trim($getIdcityUbi[0]->ID_DIAN),
                'MEDIO_PAGO' => 12,
			];
			
			$createOportudaLead = $oportudataLead->updateOrCreate(['CEDULA'=>$identificationNumber],$dataOportudata)->save();

			$getExistCel = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :identi AND `NUM` = :num ", ['identi' => $identificationNumber, 'num' => trim($request->get('telephone'))]);
			if($request->get('CEL_VAL') == 0 && $getExistCel[0]->total < 1){
				$clienteCelular = new CliCel;
				$clienteCelular->IDENTI = $identificationNumber;
				$clienteCelular->NUM = trim($request->get('telephone'));
				$clienteCelular->TIPO = 'CEL';
				$clienteCelular->CEL_VAL = 1;
				$clienteCelular->FECHA = date("Y-m-d H:i:s");
				$clienteCelular->save();
			}

			$consultasFosyga = $this->execConsultaFosygaLead($identificationNumber, $request->get('typeDocument'), $request->get('dateDocumentExpedition'), $request->get('name'), $request->get('lastName'));
			if($consultasFosyga == "-1"){
				return "-1";
			}
			if($consultasFosyga == "-3"){
				return "-3";
			}

			return "1";
		}
		
		if($request->get('step')==2){
			$identificationNumber = trim($request->get('identificationNumber'));
            $getIdcityExp = $this->getIdcityUbi(trim($request->get('cityExpedition')));
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

			$dataLead=[
				'DIRECCION' => trim(strtoupper($request->get('addres'))),
				'FEC_NAC' => $request->get('birthdate'),
				'CIUD_EXP' => trim($request->get('cityExpedition')),
				'EDAD' => $this->calculateAge($request->get('birthdate')),
                'ID_CIUD_EXP' => trim($getIdcityExp[0]->ID_DIAN),
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
				'PASO' => $paso
			];

			$identificationNumber = (string)$identificationNumber;
			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

			return response()->json([true]);
		}

		if($request->get('step')==3){
			$identificationNumber = $request->get('identificationNumber');
			$identificationNumber = (string)$identificationNumber;
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
			$existSolicFab = $this->getExistSolicFab($identificationNumber);
			if($existSolicFab == true){
				return -3; // Tiene solicitud
			}
			if(trim($oportudataLead[0]->ACTIVIDAD) == 'SOLDADO-MILITAR-POLICÍA' || trim($oportudataLead[0]->ACTIVIDAD) == 6) return -2;

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

			// Update/save information in CLIENTE_FAB table
			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);
			$dataDatosCliente = ['NOM_REFPER' => $request->get('NOM_REFPER'), 'TEL_REFPER' => $request->get('TEL_REFPER'), 'NOM_REFFAM' => $request->get('NOM_REFFAM'), 'TEL_REFFAM' => $request->get('TEL_REFFAM')];
			$lastName = explode(" ",$oportudataLead[0]->APELLIDOS);
			$fechaExpIdentification = explode("-", $oportudataLead[0]->FEC_EXP);
			$fechaExpIdentification = $fechaExpIdentification[2]."/".$fechaExpIdentification[1]."/".$fechaExpIdentification[0];
			$consultasLead = $this->execConsultasLead($oportudataLead[0]->CEDULA, $oportudataLead[0]->TIPO_DOC, 'PASOAPASO', $lastName[0], $fechaExpIdentification, $dataDatosCliente);
			if($consultasLead['resp'] == 'confronta'){
				return $consultasLead;
			}
			if(isset($consultasLead['resp']['resp'])){
				if($consultasLead['resp']['resp'] == 'false'){
					return -2;
				}
				if($consultasLead['resp']['resp'] == '-2'){
					return -1;
				}
			}
			$estado = $consultasLead['infoLead']->ESTADO;
			if($estado == 'PREAPROBADO' || $estado == 'SIN COMERCIAL' || $estado == 'APROBADO'){
				$quotaApprovedProduct = $consultasLead['quotaApprovedProduct'];
				$quotaApprovedAdvance = $consultasLead['quotaApprovedAdvance'];
				return response()->json(['data' => true,'quota' => $quotaApprovedProduct, 'numSolic' => $consultasLead['infoLead']->numSolic,'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
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

	public function getNumLead($identificationNumber, $typeResp = 'json'){
		$getNumVal = DB::connection('oportudata')->select("SELECT `NUM`, `CEL_VAL` FROM `CLI_CEL` WHERE `TIPO` = 'CEL' AND `CEL_VAL` = 1 AND `IDENTI` = :identificationNumber ORDER BY `FECHA` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(count($getNumVal) > 0){
			if($typeResp == 'json'){
				return response()->json(['resp' => $getNumVal]);
			}else{
				return $getNumVal;
			}
		}

		$getNum = DB::connection('oportudata')->select("SELECT `NUM`, `CEL_VAL` FROM `CLI_CEL` WHERE `TIPO` = 'CEL' AND `IDENTI` = :identificationNumber ORDER BY `FECHA` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);

		if(count($getNum) > 0){
			if($typeResp == 'json'){
				return response()->json(['resp' => $getNum]);
			}else{
				return $getNum;
			}
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


	private function validateDateConsultaUbica($identificationNumber){
		$daysToIncrement = DB::connection('oportudata')->select("SELECT `pub_vigencia` FROM `VIG_CONSULTA` LIMIT 1");
		$daysToIncrement = $daysToIncrement[0]->pub_vigencia;
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- $daysToIncrement day", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		$dateLastConsultaUbica = DB::connection('oportudata')->select("SELECT fecha FROM consulta_ubica WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($dateLastConsultaUbica)){
			return 'true';
		}else{
			$dateLastConsulta = $dateLastConsultaUbica[0]->fecha;

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

	public function simulatePolicyGroup(){
		$resultadoPolitica = new ResultadoPolitica;
		$archivoName = "";
		$result = [];
		$noExists = [];
		foreach ($_FILES as $archivo) {
			$archivoName = $archivo["tmp_name"];
		}

		$fp = fopen($archivoName, "r");

		while(!feof($fp)) {
			$linea = fgets($fp);
			$buscar=array(chr(13).chr(10), "\r\n", "\n", "\r");
			$reemplazar=array("", "", "", "");
			$lineaCed = str_ireplace($buscar,$reemplazar,$linea);
			if($lineaCed != ''){
				$resultPolicy = $this->simulatePolicy($lineaCed);
				if($resultPolicy == "-1" || $resultPolicy == "-2"){
					$noExists[] = $lineaCed;
				}else{
					$result[$lineaCed] = $resultPolicy[0];
				}
			}
		}
		fclose($fp);
		$resultadoPolitica->RESULTADO = json_encode($result);
		$resultadoPolitica->save();
		
		return response()->json(['leads' => $result, 'noExist' => $noExists, 'idResultado' => $resultadoPolitica->ID]);
	}

	public function downloadResultadoPolitica($id){
		$queryResultado = DB::connection('oportudata')->select("SELECT `RESULTADO` FROM `TB_RESULTADO_POLITICA` WHERE `ID` = :id ", ['id' => $id]);
		$resultado = json_decode($queryResultado[0]->RESULTADO);
		$resultado = (array) $resultado;
		$printExcel = [];
		$cont = 0;
		$tipoDoc = "";
		foreach ($resultado as $key => $value) {
			$tipoDoc = "";
			$motivoRechazo = "";
			$tiempoLabor = "";
			$ingresos = "";
			$triplea = "";
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
					$tipoDoc = "Fidecoismo";
					break;
			}
			if($value->ESTADO == 'NEGADO'){
				$motivoRechazo = $value->DESCRIPCION."/".$value->ID_DEF;
			}
			if($value->ACTIVIDAD == 'RENTISTA' || $value->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $value->ACTIVIDAD == 'NO CERTIFICADO'){
				$tiempoLabor = $value->EDAD_INDP;
				$ingresos = $value->SUELDOIND;
			}else{
				$ingresos = $value->SUELDO;
				$tiempoLabor = $value->ANTIG;
			}
			$cont ++;
			if($cont == 1){
				$printExcel[] = ['FECHA Y HORA DEL PROCESO', 'TIPO DE DOCUMENTO', 'CEDULA', 'NOMBRE TERCERO', 'RESULTADO', 'MOTIVO RECHAZO', 'FECHA DE EXPEDICIÓN DOCUMENTO', 'SUCURSAL', 'ZONA RIESGO', 'SCORE', 'CALIFICACION', 'FECHA DE NACIMIENTO', 'EDAD', 'ACTIVIDAD ECONOMICA', 'TIEMPO EN LABOR', 'INGRESOS', 'INGRESOS ADICIONALES', 'TIPO DE CLIENTE', 'DEFINICION CLIENTE', 'CLIENTE TIPO AAA', 'CLIENTE TIPO 5 ESPECIAL', 'HISTORIAL DE CREDITO', 'TARJETA APLICABLE', 'VISITA OCULAR', 'DIRECCION', 'CELULAR', 'TIPO DE VIVIENDA'];
			}
			$printExcel[] = [$value->FECHA_INTENCION, $tipoDoc, $value->CEDULA, $value->NOMBRES, $value->ESTADO, $motivoRechazo, $value->FEC_EXP, $value->SUC, $value->ZONA_RIESGO, $value->score, $value->PERFIL_CREDITICIO, $value->FEC_NAC, $value->EDAD, $value->ACTIVIDAD, $tiempoLabor, $ingresos, $value->OTROS_ING, $value->TIPO_CLIENTE, $value->DESCRIPCION."/".$value->ID_DEF, ($value->TARJETA == 'Tarjeta Black') ? 'Aplica' : 'No Aplica' , ($value->TIPO_5_ESPECIAL == '1') ? 'Aplica' : 'No Aplica', ($value->HISTORIAL_CREDITO == '1') ? 'Aplica' : 'No Aplica', $value->TARJETA, ($value->INSPECCION_OCULAR == '1') ? 'Aplica' : 'No Aplica', $value->DIRECCION, $value->CELULAR, $value->TIPOV];
		}
		$export = new ExportToExcel($printExcel);
	
		return Excel::download($export, 'resultadoPolitica.xlsx');
	}

	public function simulatePolicy($cedula){
		$intencion = new Intenciones;
		$intencion->CEDULA = $cedula;
		$intencion->save();
		$queryLeadExist = DB::connection('oportudata')->select('SELECT COUNT(`CEDULA`) as total 
		FROM `CLIENTE_FAB`
		WHERE `CEDULA` = :cedula ', ['cedula' => $cedula]);

		if($queryLeadExist[0]->total < 1){
			return "-1";
		}

		$queryLeadExistConsultaWs = DB::connection('oportudata')->select("SELECT COUNT(`cedula`) as total
		from `consulta_ws`
		WHERE `cedula` = :cedula ", ['cedula' => $cedula]);

		$queryLeadExistTercero = DB::connection('oportudata')->select("SELECT COUNT(`tercedula`) as total
		from `cifin_tercero`
		WHERE `tercedula` = :cedula ", ['cedula' => $cedula]);
		
		if($queryLeadExistConsultaWs[0]->total < 1 || $queryLeadExistTercero[0]->total < 1){
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

	private function validatePolicyCredit_new($identificationNumber){
		$getDataCliente = DB::connection('oportudata')->select("SELECT `EDAD`, `ACTIVIDAD`, `ANTIG`, `EDAD_INDP`, `CIUD_UBI`, `SUC` FROM `CLIENTE_FAB` WHERE `CEDULA` = :identificationNumber", ['identificationNumber' => $identificationNumber]);
		
		// 3.2	Puntaje y 3.4 Calificacion Score
		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if(empty($queryScoreClient)){
			return ['resp' => "false"];
		}else{
			if($queryScoreClient[0]->score >= 1 && $queryScoreClient[0]->score <= 275){
				$perfilCrediticio = 'TIPO D';
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio, '3.2');
				return ['resp' => "false"];
			}
			if($queryScoreClient[0]->score >= -7 && $queryScoreClient[0]->score <= 0){
				$perfilCrediticio = 'TIPO 5';
			}
			if($queryScoreClient[0]->score >= 275 && $queryScoreClient[0]->score <= 527){
				$perfilCrediticio = 'TIPO D';
			}

			if($queryScoreClient[0]->score >= 528 && $queryScoreClient[0]->score <= 624){
				$perfilCrediticio = 'TIPO C';
			}

			if($queryScoreClient[0]->score >= 625 && $queryScoreClient[0]->score <= 674){
				$perfilCrediticio = 'TIPO B';
			}

			if($queryScoreClient[0]->score >= 675 && $queryScoreClient[0]->score <= 1000){
				$perfilCrediticio = 'TIPO A';
			}

			$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio);
		}

		// 2. WS Fosyga
		$getDataFosyga = DB::connection('oportudata')->select("SELECT `estado`, `regimen`, `tipoAfiliado` FROM `fosyga_bdua` WHERE `cedula` =  :identificationNumber ORDER BY `idBdua` DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		if(!empty($getDataFosyga)){
			if(empty($getDataFosyga[0]->estado) || empty($getDataFosyga[0]->regimen) || empty($getDataFosyga[0]->tipoAfiliado)){
				return ['resp' => "false"];
			}else{
				if($getDataFosyga[0]->estado != 'ACTIVO' || $getDataFosyga[0]->regimen != 'CONTRIBUTIVO' || $getDataFosyga[0]->tipoAfiliado != 'COTIZANTE'){
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio, '2.1');
					return ['resp' => "false"];
				}
			}
		}else{
			return ['resp' => "false"];
		}

		//3.1 Estado de documento
		$getDataRegistraduria = DB::connection('oportudata')->select("SELECT  `estado` FROM `fosyga_estadoCedula` WHERE `cedula` =  :identificationNumber ORDER BY `idEstadoCedula` DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		if(!empty($getDataRegistraduria)){
			if(!empty($getDataRegistraduria[0]->estado)){
				if($getDataRegistraduria[0]->estado != 'VIGENTE'){
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'PERFIL_CREDITICIO', $perfilCrediticio, '3.1');
					return ['resp' => "false"];
				}
			}else{
				return ['resp' => "false"];	
			}
		}else{
			return ['resp' => "false"];
		}
		// 3.3 Estado de obligaciones		
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
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$this->updateLastIntencionLead($identificationNumber, 'ESTADO_OBLIGACIONES', 0, '3.3');
			return ['resp' => "false"];
		}else{
			$this->updateLastIntencionLead($identificationNumber, 'ESTADO_OBLIGACIONES', 1);
		}

		//3.5 Historial de Crédito
		$historialCrediticio = 0;
		$totalVector = 0;
		$queryComporFin = sprintf("SELECT fdcompor, fdapert
		FROM cifin_findia
		WHERE fdcalid = 'PRIN' AND `fdconsul` = (SELECT MAX(`fdconsul`) FROM `cifin_findia` WHERE `fdcedula` = %s ) AND fdcedula = %s", $identificationNumber, $identificationNumber);
		
		$respQueryComporFin = DB::connection('oportudata')->select($queryComporFin);
		foreach ($respQueryComporFin as $value) {
			$fechaComporFin = $value->fdapert;
			$fechaComporFin = explode('/', $fechaComporFin);
			$fechaComporFin = $fechaComporFin[2]."-".$fechaComporFin[1]."-".$fechaComporFin[0];
			$dateNow = date('Y-m-d');
			$dateNew = strtotime ("- 24 MONTH", strtotime ( $dateNow ) );
			if(strtotime($fechaComporFin) > $dateNew){
				$paymentArray = explode('|',$value->fdcompor);
				$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
				$popArray = array_pop($paymentArray);
				$paymentArray = array_reverse($paymentArray);
				foreach($paymentArray as $habit){
					if($totalVector >= 6){ // POner parametrizable
						$historialCrediticio = 1;
						break;
					}

					if($habit == 'N'){
						$totalVector ++;
					}else{
						$totalVector = 0;
					}
				}
			}
		}

		if($historialCrediticio == 0){
			$queryComporFinExt = sprintf("SELECT extcompor, exttermin, extapert
			FROM cifin_finext
			WHERE extcalid = 'PRIN' AND `extconsul` = (SELECT MAX(`extconsul`) FROM `cifin_finext` WHERE `extcedula` = %s ) AND extcedula = %s", $identificationNumber, $identificationNumber);
			
			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);
			
			foreach ($respQueryComporFinExt as $value) {
				if($value->exttermin == '' && $value->extapert == ''){
					break;
				}
				$fechaComporFin = ($value->exttermin != '') ? $value->exttermin : $value->extapert ;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2]."-".$fechaComporFin[1]."-".$fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime ("- 24 MONTH", strtotime ( $dateNow ) );
				if(strtotime($fechaComporFin) > $dateNew){
					$paymentArray = explode('|',$value->extcompor);
					$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach($paymentArray as $habit){
						if($totalVector >= 6){
							$historialCrediticio = 1;
							break;
						}

						if($habit == 'N'){
							$totalVector ++;
						}else{
							$totalVector = 0;
						}
					}
				}
			}
		}

		if($historialCrediticio == 0){
			$queryComporFinExt = sprintf("SELECT rdcompor , rdapert
			FROM cifin_realdia
			WHERE rdcalid = 'PRIN' AND `rdconsul` = (SELECT MAX(`rdconsul`) FROM `cifin_realdia` WHERE `rdcedula` = %s ) AND rdcedula = %s", $identificationNumber, $identificationNumber);
			
			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

			foreach ($respQueryComporFinExt as $value) {
				$fechaComporFin = $value->rdapert;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2]."-".$fechaComporFin[1]."-".$fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime ("- 24 MONTH", strtotime ( $dateNow ) );
				if(strtotime($fechaComporFin) > $dateNew){
					$paymentArray = explode('|',$value->rdcompor);
					$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach($paymentArray as $habit){
						if($totalVector >= 6){
							$historialCrediticio = 1;
							break;
						}

						if($habit == 'N'){
							$totalVector ++;
						}else{
							$totalVector = 0;
						}
					}
				}
			}
		}

		if($historialCrediticio == 0){
			$queryComporFinExt = sprintf("SELECT rexcompor , rexcorte
			FROM cifin_realext
			WHERE rexcalid  = 'PRIN' AND `rexconsul` = (SELECT MAX(`rexconsul`) FROM `cifin_realext` WHERE `rexcedula` = %s ) AND rexcedula = %s", $identificationNumber, $identificationNumber);
			
			$respQueryComporFinExt = DB::connection('oportudata')->select($queryComporFinExt);

			foreach ($respQueryComporFinExt as $value) {
				$fechaComporFin = $value->rexcorte;
				$fechaComporFin = explode('/', $fechaComporFin);
				$fechaComporFin = $fechaComporFin[2]."-".$fechaComporFin[1]."-".$fechaComporFin[0];
				$dateNow = date('Y-m-d');
				$dateNew = strtotime ("- 24 MONTH", strtotime ( $dateNow ) );
				if(strtotime($fechaComporFin) > $dateNew){
					$paymentArray = explode('|',$value->rexcompor);
					$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
					$popArray = array_pop($paymentArray);
					$paymentArray = array_reverse($paymentArray);
					foreach($paymentArray as $habit){
						if($totalVector >= 6){
							$historialCrediticio = 1;
							break;
						}

						if($habit == 'N'){
							$totalVector ++;
						}else{
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
		WHERE `CODIGO` = '%s' ", $getDataCliente[0]->SUC);
		$respZonaRiesgo = DB::connection('oportudata')->select($queryGetZonaRiesgo);
		$this->updateLastIntencionLead($identificationNumber, 'ZONA_RIESGO', $respZonaRiesgo[0]->ZONA);

		// 4.2 Tipo de cliente
		$tipoCliente = '';
		$queryGetClienteActivo = sprintf("SELECT COUNT(`CEDULA`) as tipoCliente
		FROM TB_CLIENTES_ACTIVOS
		WHERE `CEDULA` = %s AND FECHA >= date_add(NOW(), INTERVAL -24 MONTH)", $identificationNumber);
		$this->updateLastIntencionLead($identificationNumber, 'TIPO_CLIENTE', $tipoCliente);

		$respClienteActivo = DB::connection('oportudata')->select($queryGetClienteActivo);
		if($respClienteActivo[0]->tipoCliente == 1){
			$tipoCliente = 'OPORTUNIDADES';
		}else{
			$tipoCliente = 'NUEVO';
		}

		$this->updateLastIntencionLead($identificationNumber, 'TIPO_CLIENTE', $tipoCliente);
		// 4.3 Edad.
		$validateTipoCliente = TRUE;
		$queryEdad = DB::connection('oportudata')->select("SELECT `teredad` FROM `cifin_tercero` WHERE `tercedula` = :identificationNumber ORDER BY `terconsul` DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
		if($queryEdad == false || empty($queryEdad)){
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
			return ['resp' => "false"];
		}
		if($queryEdad[0]->teredad == 'Mas 75'){
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
			return ['resp' => "false"];
		}
		$edad = $queryEdad[0]->teredad;
		$edad = explode('-',$edad);
		$edadMin = $edad[0];
		$edadMax = $edad[1];
		if($getDataCliente[0]->ACTIVIDAD == 'PENSIONADO'){
			$validateTipoCliente = FALSE;
			if($edadMin >= 18 && $edadMax <= 70){
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		if($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE){
			if($edadMin >= 18 && $edadMax <= 75){
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		if($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE){
			if($edadMin >= 18 && $edadMax <= 70){
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 1);
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'EDAD', 0, '4.3');
				return ['resp' => "false"];
			}
		}

		// 4.5 Tiempo en Labor
		if($getDataCliente[0]->ACTIVIDAD == 'PENSIONADO'){
			$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
		}else{
			if($getDataCliente[0]->ACTIVIDAD == 'RENTISTA' || $getDataCliente[0]->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $getDataCliente[0]->ACTIVIDAD == 'NO CERTIFICADO'){
				if($getDataCliente[0]->EDAD_INDP >= 4){
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
				}else{
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 0, '4.5');
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					return ['resp' => "false"];
				}
			}else{
				if($getDataCliente[0]->ANTIG >= 4){
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 1);
				}else{
					$this->updateLastIntencionLead($identificationNumber, 'TIEMPO_LABOR', 0, '4.5');
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					return ['resp' => "false"];
				}
			}
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = 0;
		if($perfilCrediticio == 'TIPO 5'){
			$tipo5Especial = 1;
		}
		$this->updateLastIntencionLead($identificationNumber, 'TIPO_5_ESPECiAL', $tipo5Especial);
		// 4.7 Inspecciones Oculares
		if($tipoCliente == 'NUEVO'){
			if($getDataCliente[0]->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $getDataCliente[0]->ACTIVIDAD == 'NO CERTIFICADO'){
				if($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5'){
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
		if($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1){
			$queryVectores = sprintf("SELECT fdcompor, fdconsul FROM `cifin_findia` WHERE `fdconsul` = (SELECT MAX(`fdconsul`) FROM `cifin_findia` WHERE `fdcedula` = '%s' ) AND `fdcedula` = '%s' AND `fdtipocon` != 'SRV' ", $identificationNumber, $identificationNumber);
			$respVectores = DB::connection('oportudata')->select($queryVectores);
			foreach ($respVectores as $key => $payment) {
				$paymentArray = explode('|',$payment->fdcompor);
				$paymentArray = array_map(array($this,'applyTrim'),$paymentArray);
				$popArray = array_pop($paymentArray);
				$paymentArray = array_reverse($paymentArray);
				$paymentArray = array_splice($paymentArray, 0, 12);
				$elementsPaymentExt = array_keys($paymentArray,'N');
				$paymentsExtNumber = count($elementsPaymentExt);
				if ($paymentsExtNumber == 12) {
					$aprobadoVectores = true;
					break;
				}
			}
			if($getDataCliente[0]->CIUD_UBI == 'BOGOTÁ' || $getDataCliente[0]->CIUD_UBI == 'MEDELLÍN'){
				if($queryScoreClient[0]->score >= 725){
					if($aprobadoVectores == true){
						$aprobado = true;
					}
				}
			}else{
				if($aprobadoVectores == true){
					$aprobado = true;
				}
			}

			if($aprobado == true){
				$tarjeta = "Tarjeta Black";
				$quotaApprovedProduct = 1900000;
				$quotaApprovedAdvance = 500000;
			}
		}

		// 3.7 Tarjeta Gray
		if($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1 && $aprobado == false){
			if($getDataCliente[0]->ACTIVIDAD == 'PENSIONADO' || $getDataCliente[0]->ACTIVIDAD == 'EMPLEADO'){
				$aprobado = true;
				$tarjeta = "Tarjeta Gray";
				$quotaApprovedProduct = 1600000;
				$quotaApprovedAdvance = 500000;
			}
		}
		
		if($aprobado == true){
			$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta);
		}

		if($aprobado == false && $historialCrediticio == 0){
			$tarjeta = "Crédito Tradicional";
			$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-2');
			return ['resp' => "-2"];
		}

		// 5 Definiciones cliente
		if($perfilCrediticio == 'TIPO A'){
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-1');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance];
			}

			if($getDataCliente[0]->ACTIVIDAD == 'EMPLEADO'){
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-2');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance];
			}

			if($getDataCliente[0]->ACTIVIDAD == 'PENSIONADO'){
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-3');
				return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance];
			}

			if($getDataCliente[0]->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $getDataCliente[0]->ACTIVIDAD == 'NO CERTIFICADO'){
				if($historialCrediticio == 1){
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'TARJETA', $tarjeta, 'A-4');
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance];
				}else{
					$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
					$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'A-5');
					return ['resp' => "-2"];
				}
			}
		}

		if($perfilCrediticio == 'TIPO B'){
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'B-1');
				return ['resp' => "-2"];
			}else{
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
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'C-2');
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $queryScoreClient[0]->score >= 275) {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', 'D-1');
				return ['resp' => "-2"];
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "NEGADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', '', 'D-2');
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if($tipo5Especial == 1){
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-2');
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-1');
				return ['resp' =>  "-2"];
			}else{
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "PREAPROBADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				$this->updateLastIntencionLead($identificationNumber, 'TARJETA', 'Crédito Tradicional', '5-3');
				return ['resp' =>  "-2"];
			}
		}

		return ['resp' => "true"];
	}

	public function deniedLeadForFecExp($identificationNumber, $typeDenied){
		$identificationNumber = (string)$identificationNumber;
		$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
		$intencion = new Intenciones;
		$intencion->CEDULA = $identificationNumber;
		$intencion->ID_DEF = $typeDenied;
		$intencion->save();

		$dataLead=[
			'ESTADO' => 'NEGADO'
		];

		$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);

		return "true";
	}

	private function updateLastIntencionLead($identificationNumber, $campo, $value, $idDef = false){
		$queryUpdate = sprintf("UPDATE `TB_INTENCIONES` SET `%s` = '%s' ", $campo, $value);

		if($idDef != false){
			$queryUpdate .= sprintf(", `ID_DEF` = '%s' ", $idDef);
		}

		$queryUpdate .= sprintf(" WHERE `CEDULA` = '%s' ORDER BY FECHA_INTENCION DESC LIMIT 1", $identificationNumber);
		
		$resp = DB::connection('oportudata')->select($queryUpdate);

		return $resp;
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
			$port = config('portsWs.creditVision');
			// 2801 CreditVision Produccion, 2020 CreditVision Pruebas
			$ws = new \SoapClient("http://10.238.14.181:".$port."/Service1.svc?singleWsdl",array()); //correcta
			$result = $ws->ConsultarInformacionComercial($obj);  // correcta
			return 1;
		}catch (\Throwable $th){
			return 0;
		}
	}

	private function execConsultaComercialLead($identificationNumber, $tipoDoc){
		$dateConsultaComercial = $this->validateDateConsultaComercial($identificationNumber);
		if($dateConsultaComercial == 'true'){
			return $consultaComercial = $this->execConsultaComercial($identificationNumber, $tipoDoc);
		}else{
			$consultaComercial = 1;
		}

		return $consultaComercial;
	}

	private function execConsultaUbica($identificationNumber, $typeDocument, $lastName){
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->identificationNumber = trim($identificationNumber);
		$obj->lastName = trim($lastName);
		try {
			// 2040 Ubica Pruebas
			$port = config('portsWs.ubica');
			$ws = new \SoapClient("http://10.238.14.181:".$port."/Service1.svc?singleWsdl",array()); //correcta
			$result = $ws->ConsultaUbicaPlus($obj);  // correcta
			return 1;
		}catch (\Throwable $th){
			return 0;
		}
	}

	private function execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName){
		$dateConsultaUbica = $this->validateDateConsultaUbica($identificationNumber);
		if($dateConsultaUbica == 'true'){
			$consultaUbica = $this->execConsultaUbica($identificationNumber, $tipoDoc, $lastName);
		}else{
			$consultaUbica = 1;
		}

		return $consultaUbica;
	}

	private function execConsultaConfronta($typeDocument, $identificationNumber, $dateExpIdentification, $lastName){
		$obj = new \stdClass();
		$obj->typeDocument = trim($typeDocument);
		$obj->expeditionDate = trim($dateExpIdentification);
		$obj->identificationNumber = trim($identificationNumber);
		$obj->lastName = trim($lastName);
		$obj->phone = "3333333";
		try {
			// 2040 Ubica Pruebas
			$port = config('portsWs.confronta');
			$ws = new \SoapClient("http://10.238.14.181:".$port."/Service1.svc?singleWsdl",array()); //correcta
			$result = $ws->obtenerCuestionario($obj);  // correcta
			return 1;
		}catch (\Throwable $th){
			return 0;
		}
	}

	private function execEvaluarConfronta($cedula, $cuestionario){
		$dataEvaluar = DB::connection('oportudata')->select("SELECT * FROM `confronta_selec` WHERE `cedula` = :cedula AND `secuencia_cuest` = :cuestionario", ['cedula' => $cedula, 'cuestionario' => $cuestionario]);
		try {
			// 2050 Confronta Pruebas
			$port = config('portsWs.confronta');
			$ws = new \SoapClient("http://10.238.14.181:".$port."/Service1.svc?singleWsdl"); //correcta
			$result = $ws->evaluarCuestionario(['Code' => 7081, 'question1' => $dataEvaluar[0]->secuencia_preg, 'answer1' => $dataEvaluar[0]->secuencia_resp, 'question2' => $dataEvaluar[1]->secuencia_preg, 'answer2' => $dataEvaluar[1]->secuencia_resp, 'question3' => $dataEvaluar[2]->secuencia_preg, 'answer3' => $dataEvaluar[2]->secuencia_resp,'question4' => $dataEvaluar[3]->secuencia_preg, 'answer4' => $dataEvaluar[3]->secuencia_resp, 'secuence' => $cuestionario]);  // correcta
			return 1;
		}catch (\Throwable $th){
			return 0;
		}
	}

	public function getFormConfronta($identificationNumber){
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

	public function validateFormConfronta(Request $request){
		$leadInfo = $request->leadInfo;
		$confronta = $request->confronta;
		$cedula = "";
		$cuestionario = "";
		$consec = "";
		foreach ($confronta as $pregunta) {
			$insertSelec = DB::connection('oportudata')->select('INSERT INTO `confronta_selec` (`consec`, `cedula`, `secuencia_cuest`, `secuencia_preg`, `secuencia_resp`) 
			VALUES (:consec, :cedula, :secuencia_cuest, :secuencia_preg, :secuencia_resp)', 
			['consec' => $pregunta['consec'], 'cedula' => $pregunta['cedula'], 'secuencia_cuest' => $pregunta['cuestionario'], 'secuencia_preg' => $pregunta['secuencia'], 'secuencia_resp' => $pregunta['opcion']]);
			$cedula = $pregunta['cedula'];
			$cuestionario = $pregunta['cuestionario'];
			$consec = $pregunta['consec'];
		}

		$this->execEvaluarConfronta($cedula, $cuestionario);

		$getResultConfronta = DB::connection('oportudata')->select("SELECT `cod_resp`
		FROM `confronta_result`
		WHERE `consec` = :consec AND `cedula` = :cedula", ['consec' => $consec, 'cedula' => $cedula]);

		if($getResultConfronta[0]->cod_resp == 1){
			$estadoSolic = "APROBADO";
		}else{
			$estadoSolic = "ANALISIS";
		}
		$dataDatosCliente = ['NOM_REFPER' => $leadInfo['NOM_REFPER'], 'TEL_REFPER' => $leadInfo['TEL_REFPER'], 'NOM_REFFAM' => $leadInfo['NOM_REFFAM'], 'TEL_REFFAM' => $leadInfo['TEL_REFFAM']];
		$policyCredit = $this->validatePolicyCredit_new($leadInfo['identificationNumber']);

		$solicCredit = $this->addSolicCredit($leadInfo['identificationNumber'], $policyCredit, $estadoSolic, "PASOAPASO", $dataDatosCliente);

		$estado = ($estadoSolic == "APROBADO") ? "APROBADO" : "PREAPROBADO" ;
		$quotaApprovedProduct = $solicCredit['quotaApprovedProduct'];
		$quotaApprovedAdvance = $solicCredit['quotaApprovedAdvance'];
		return response()->json(['data' => true,'quota' => $quotaApprovedProduct, 'numSolic' => $solicCredit['infoLead']->numSolic, 'textPreaprobado' => 2, 'quotaAdvance' => $quotaApprovedAdvance, 'estado' => $estado]);
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
			$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
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
		if($respEstadoCedula[0]->fechaExpedicion != ''){
			$dateExpEstadoCedula = $respEstadoCedula[0]->fechaExpedicion;
			$dateExpEstadoCedula = str_replace(" de ", "/", $dateExpEstadoCedula);
			
			$dateExplode = explode("/", $dateExpEstadoCedula);
			$numMonth = $this->getNumMonthOfText($dateExplode[1]);
			$dateExpEstadoCedula = str_replace($dateExplode[1],$numMonth,$dateExpEstadoCedula);
			$dateExplode = explode("/", $dateExpEstadoCedula);
			$dateExpEstadoCedula = $dateExplode[2]."/".$dateExplode[1]."/".$dateExplode[0];

			if(strtotime($dateExpedition) != strtotime($dateExpEstadoCedula)){
				$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "NO COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "REGISTRADURIA" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				return -4; // Fecha de expedicion no coincide
			}
		}

		if ($respEstadoCedula[0]->estado != 'VIGENTE') {
			$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "REGISTRADURIA" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
			return -1; // Cedula no vigente
		}

		$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
		$updateTemp = DB::connection('oportudata')->select('UPDATE `temp_consultaFosyga` SET `paz_cli` = "COINCIDE" WHERE `cedula` = :identificationNumber ORDER BY id DESC LIMIT 1', ['identificationNumber' => $identificationNumber]);
		return 1;
	}

	public function validateConsultaUbica($identificationNumber){
		$consecConsultaUbica = DB::connection('oportudata')->select("SELECT `consec` FROM `consulta_ubica` WHERE `cedula` = :identificationNumber ORDER BY consec DESC LIMIT 1", ['identificationNumber' => $identificationNumber]);
		$getDataCliente = DB::connection('oportudata')->select("SELECT `TEL_EMP`, `TEL2_EMP`, `EMAIL` FROM `CLIENTE_FAB` WHERE  `CEDULA` = :identificationNumber", ['identificationNumber' => $identificationNumber]);
		$consec = $consecConsultaUbica[0]->consec;
		$aprobo = 0;
		// Validacion Celular
		$numLead = $this->getNumLead($identificationNumber, 'normal');
		$celLead = $numLead[0]->NUM;
		$telConsultaUbica = DB::connection('oportudata')->select("SELECT `ubicelular`, `ubiprimerrep` FROM `ubica_celular` WHERE `ubicelular` = :celular AND `ubiconsul` = :consec ", ['celular' => $celLead, 'consec' => $consec]);
		if(!empty($telConsultaUbica)){
			$aprobo = $this->validateDateUbica($telConsultaUbica[0]->ubiprimerrep);
		}else{
			$aprobo = 0;
		}

		if($aprobo == 0){
			// Validacion Telefono empresarial
			if($getDataCliente[0]->TEL_EMP != '' && $getDataCliente[0]->TEL_EMP != '0'){
				$telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_telefono` WHERE `ubitipoubi` LIKE '%LAB%' AND `ubiconsul` = :consec AND (`ubitelefono` = :tel_emp OR `ubitelefono` = :tel2_emp ) ",['consec' => $consec, 'tel_emp' =>$getDataCliente[0]->TEL_EMP, 'tel2_emp' =>$getDataCliente[0]->TEL2_EMP]);
				if(!empty($telEmpConsultaUbica)){
					$aprobo = $this->validateDateUbica($telEmpConsultaUbica[0]->ubiprimerrep);
				}else{
					$aprobo = 0;
				}
			}else{
				$aprobo = 0;
			}
		}

		if($aprobo == 0){
			// Validacion Correo
			if($getDataCliente[0]->EMAIL != ''){
				$emailConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep` FROM `ubica_mail` WHERE `ubiconsul` = :consec AND `ubicorreo` = :correo ", ['consec' => $consec, 'correo' => $getDataCliente[0]->EMAIL]);
				if(!empty($emailConsultaUbica)){
					$aprobo = $this->validateDateUbica($emailConsultaUbica[0]->ubica_mail);
				}
			}else{
				$aprobo = 0;
			}
		}
		return $aprobo;
	}

	private function validateDateUbica($fecha){
		$fechaTelConsultaUbica = explode("/",$fecha);
		$fechaTelConsultaUbica = "20".$fechaTelConsultaUbica[2]."-".$fechaTelConsultaUbica[1]."-".$fechaTelConsultaUbica[0];
		$fechaTelConsultaUbica = strtotime($fechaTelConsultaUbica);
		$dateNow = date('Y-m-d');
		$dateNew = strtotime ("- 12 month", strtotime ( $dateNow ) );
		$dateNew = date ( 'Y-m-d' , $dateNew );
		if($fechaTelConsultaUbica < strtotime($dateNew)){
			$aprobo = 1;
		}else{
			$aprobo = 0;
		}

		return $aprobo;
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
		
		$urlConsulta = sprintf('http://produccion.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4g0b0$&jor=%s&icf=%s&thy=co&klm=%s', $idConsultaWebService, $tipoDocumento, $identificationNumber);
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

	private function getIdcityUbi($city){
        $queryCity = sprintf('SELECT `ID_DIAN` FROM `CIUDADES` WHERE `NOMBRE` = "%s" ', $city);
        
        $resp = DB::connection('oportudata')->select($queryCity);

		return $resp;
	}
	
	private function getNameCiudadExp($city){
        $queryCity = sprintf("SELECT `NOMBRE` FROM `CIUDADES` WHERE `CODIGO` = %s ", $city);

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

	public function execConsultasLead($identificationNumber, $tipoDoc, $tipoCreacion, $lastName, $dateExpIdentification, $data = []){
		$consultaComercial = $this->execConsultaComercialLead($identificationNumber, $tipoDoc);
		$estadoSolic = 'ANALISIS';
		if($consultaComercial == 0){
			$dataLead=[
				'ESTADO' => "SIN COMERCIAL"
			];
			
			$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);
		}else{ 
			$intencion = new Intenciones;
			$intencion->CEDULA = $identificationNumber;
			$intencion->save();

			$policyCredit = $this->validatePolicyCredit_new($identificationNumber);
			$infoLead = [];
			$infoLead = $this->getInfoLeadCreate($identificationNumber);

			if ($tipoCreacion == 'PASOAPASO') {
				if($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2'){
					return ['resp' => $policyCredit, 'infoLead' => $infoLead];
				}
			}
			if($tipoCreacion == 'CREDITO'){
				if($policyCredit['resp'] == 'false' || $policyCredit['resp'] == '-2'){
					return ['resp' => $policyCredit, 'infoLead' => $infoLead];
				}
			}

			$this->execConsultaUbicaLead($identificationNumber, $tipoDoc, $lastName);
			$resultUbica = $this->validateConsultaUbica($identificationNumber);
			if($resultUbica == 0){
				$confronta = $this->execConsultaConfronta($tipoDoc, $identificationNumber, $dateExpIdentification, $lastName);
				if($confronta == 1){
					$form = $this->getFormConfronta($identificationNumber);
					if(empty($form)){
						$estadoSolic = "ANALISIS";
					}else{
						return ['form' => $form, 'resp' => 'confronta'];
					}
				}else{
					$estadoSolic = 'ANALISIS';
				}
			}else{
				$estadoSolic = 'APROBADO';
			}
		}
		return $this->addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data);
	}
	
	private function addSolicCredit($identificationNumber, $policyCredit, $estadoSolic, $tipoCreacion, $data){
		$numSolic = $this->addSolicFab($identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $estadoSolic);
		if(!empty($data)){
			$dataDatosCliente = ['identificationNumber' => $identificationNumber, 'numSolic' => $numSolic, 'NOM_REFPER' => $data['NOM_REFPER'], 'TEL_REFPER' => $data['TEL_REFPER'], 'NOM_REFFAM' => $data['NOM_REFFAM'], 'TEL_REFFAM' => $data['TEL_REFFAM']];
		}else{
			$dataDatosCliente = ['identificationNumber' => $identificationNumber, 'numSolic' => $numSolic, 'NOM_REFPER' => 'NA', 'TEL_REFPER' => 'NA', 'NOM_REFFAM' => 'NA', 'TEL_REFFAM' => 'NA'];
		}

		$addDatosCliente = $this->addDatosCliente($dataDatosCliente);
		
		$addAnalisis = $this->addAnalisis($numSolic, $identificationNumber);
		$infoLead = [];
		$infoLead = $this->getInfoLeadCreate($identificationNumber);
		$infoLead->numSolic = $numSolic->SOLICITUD;
		if($estadoSolic == "APROBADO"){
			$estadoResult = "APROBADO";
			$tarjeta = $this->addTarjeta($numSolic->SOLICITUD, $identificationNumber, $policyCredit['quotaApprovedProduct'],  $policyCredit['quotaApprovedAdvance'], $infoLead->SUC);
		}else{
			$estadoResult = "PREAPROBADO";
			$turnos = $this->addTurnos($identificationNumber, $numSolic);
		}
		$dataLead=[
			'ESTADO' => $estadoResult,
		];
		$response = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->update($dataLead);
		$infoLead = [];
		$infoLead = $this->getInfoLeadCreate($identificationNumber);
		$infoLead->numSolic = $numSolic->SOLICITUD;
		if ($tipoCreacion == 'PASOAPASO') {
			return ['resp' => $policyCredit['resp'], 'infoLead' => $infoLead, 'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'], 'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']];
		}
		return ['resp' => 'true', 'infoLead' => $infoLead];
	}

	private function execConsultaFosygaLead($identificationNumber, $typeDocument, $dateDocument, $name, $lastName){
			// Fosyga
			$validateConsultaFosyga = 0;
			$validateConsultaRegistraduria = 0;
			$dateConsultaFosyga = $this->validateDateConsultaFosyga($identificationNumber);
			if($dateConsultaFosyga == "true"){
				$consultaFosyga = $this->execConsultaFosyga($identificationNumber, $typeDocument, $dateDocument);
			}else{
				$consultaFosyga = 1;
			}

			if ($consultaFosyga > 0) {
				$validateConsultaFosyga = $this->validateConsultaFosyga($identificationNumber, strtolower(trim($name)), strtolower(trim($lastName)), $dateDocument);
			}else{
				$validateConsultaFosyga = 1;
			}
			// Registraduria8
			$dateConsultaRegistraduria = $this->validateDateConsultaRegistraduria($identificationNumber);
			if($dateConsultaRegistraduria == "true"){
				$consultaRegistraduria = $this->execConsultaRegistraduria($identificationNumber, $typeDocument, $dateDocument);
			}else{
				$consultaRegistraduria = 1;
			}

			if ($consultaRegistraduria > 0) {
				$validateConsultaRegistraduria = $this->validateConsultaRegistraduria($identificationNumber, strtolower(trim($name)), strtolower(trim($lastName)), $dateDocument);
			}else{
				$validateConsultaRegistraduria = 1;
			}
			
			if($validateConsultaRegistraduria == -1){
				return -1;
			}

			if($validateConsultaRegistraduria < 0 || $validateConsultaFosyga < 0){
				return "-3";
			}

			return "true";
	}

	private function addSolicFab($identificationNumber, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado){
		$authAssessor= (Auth::guard('assessor')->check())?Auth::guard('assessor')->user()->CODIGO:NULL;
		if(Auth::user()){
			$authAssessor = (Auth::user()->codeOportudata != NULL) ? Auth::user()->codeOportudata : $authAssessor;
		}
		$assessorCode=($authAssessor !== NULL)?$authAssessor:998877;
		$queryIdEmpresa = sprintf("SELECT `ID_EMPRESA` FROM `ASESORES` WHERE `CODIGO` = '%s'", $assessorCode);
		$IdEmpresa = DB::connection('oportudata')->select($queryIdEmpresa);

		$oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')->where('CEDULA','=',$identificationNumber)->get();
		$sucursal=DB::connection('oportudata')->select(sprintf("SELECT `CODIGO` FROM `SUCURSALES` WHERE `CIUDAD` = '%s' AND `PRINCIPAL` = 1 ", $oportudataLead[0]->CIUD_UBI));
		$sucursal=$sucursal[0]->CODIGO;

		$solic_fab= new Application;
		$solic_fab->AVANCE_W=$quotaApprovedAdvance;
		$solic_fab->PRODUC_W= $quotaApprovedProduct;
		$solic_fab->CLIENTE=$identificationNumber;
		$solic_fab->CODASESOR=$assessorCode;
		$solic_fab->id_asesor=$assessorCode;
		$solic_fab->ID_EMPRESA=$IdEmpresa[0]->ID_EMPRESA;
		$solic_fab->FECHASOL=date("Y-m-d H:i:s");
		$solic_fab->SUCURSAL=$sucursal;
		$solic_fab->ESTADO=$estado;
		$solic_fab->FTP=0;
		$solic_fab->STATE=$estado;
		$solic_fab->GRAN_TOTAL=0;
		$solic_fab->SOLICITUD_WEB = 1;
		$solic_fab->save();
		$numSolic = $this->getNumSolic($identificationNumber);

		return $numSolic;
	}

	private function addDatosCliente($data = []){
		$datosCliente= new DatosCliente;

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

	private function addAnalisis($numSolic, $identificationNumber){
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
		if(count($respQueryTemp) > 0){
			$analisis->paz_cli = $respQueryTemp[0]->paz_cli;
			$analisis->fos_cliente = $respQueryTemp[0]->fos_cliente;
		}
		$analisis->save();
	}

	private function addTurnos($identificationNumber, $numSolic){
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

	private function addTarjeta($numSolic, $identificationNumber, $cupoCompra, $cupoAvance, $sucursal){
		$tipoTarjeta = "";
		$tarjeta= new Tarjeta;
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

	private function getInfoLeadCreate($identificationNumber){
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

	public function advanceStep1(){
		$digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];

		return view('advance.step1', ['digitalAnalyst' => $digitalAnalyst[0]]);
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
		$query = "SELECT CODIGO as value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 AND STATE='A' ORDER BY CIUDAD ASC";

		$resp = DB::connection('oportudata')->select($query);

		return $resp;
	}

	public function getDataStep2($identificationNumber){
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
}