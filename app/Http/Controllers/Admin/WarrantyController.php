<?php

/**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIA DIGITAL
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controlador REST para la administracion de solicitudes de garantias.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Date: 29/03/2019
     **/

// includes

namespace App\Http\Controllers\Admin;

use App\codeUserVerificationOportudata;
use App\GARANTIA;
use App\OportuyaV2;
use App\cliCel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Imagenes;


class WarrantyController extends Controller
{

    public function __construct()
    {
        // except a authenticable methods 
        $this->middleware('auth', ['except' => ['index','store','sendMessageSms','setCodesStateOportudata','getCodeVerificationOportudata','verificationCode','create','products'] ]);
    }
    /**
     * Display a main page of Warranty App.
     *
     * @return \Illuminate\Http\Response with  a list of pages images
     */
    public function index(Request $request)
    {
        $images=Imagenes::selectRaw('id,img,category,isSlide')
						->where('category','=','4')
						->where('isSlide','=','1')
                        ->get();

        $logos=Imagenes::selectRaw('id,img,category,isSlide')
						->where('category','=','5')
						->where('isSlide','=','1')
                        ->get();
                        
        return view('warranty.public.layout',['images'=>$images,'logos'=>$logos]);
    }
    
    /**
     * Display a test queries.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request){
        $products = DB::connection('oportudata')->table('SOLIC_FAB')
                                                ->select('MARCA','REFERENCIA','SUPER_2.COD_ARTIC','SUCURSAL','SOLIC_FAB.SOLICITUD','ARTICULO')
                                                ->join('SUPER_2','SOLIC_FAB.SOLICITUD','=','SUPER_2.SOLICITUD')
                                                ->leftJoin('ARTICULOS','SUPER_2.COD_ARTIC','=','ARTICULOS.CODIGO')
                                                ->where('CLIENTE','=',1088021330)
                                                ->where(function($q){
                                                    $q->where('ESTADO','=','FACTURADO')
                                                    ->orWhere('ESTADO','=','EN FACTURACION');
                                                });

        $ProductsInvoice =  DB::connection('oportudata')->table('SUPER')
                                                        ->select('MARCA','REFERENCIA','products.COD_ARTIC as CODIGO','FEC_AUR','FACTURA','SUCURSAL','products.ARTICULO')
                                                        ->rightJoinSub( $products, 'products', function ($join) {
                                                            $join->on('SUPER.SOLICITUD', '=', 'products.SOLICITUD')
                                                            ->where(DB::raw('TRIM(products.COD_ARTIC)'),'=',DB::raw('TRIM(SUPER.CODIGO)'));
                                                        })
                                                        ->get();

        $products2 = DB::connection('oportudata')->table('SOLIC_FAB')
                                                        ->select('MARCA','REFERENCIA','ARTICULOS.CODIGO','FEC_AUR','FACTURA','SUCURSAL')
                                                        ->join('SUPER_2','SOLIC_FAB.SOLICITUD','=','SUPER_2.SOLICITUD')
                                                        ->join('ARTICULOS','SUPER_2.COD_ARTIC','=','ARTICULOS.CODIGO')
                                                        ->rightJoin('SUPER','SOLIC_FAB.SOLICITUD','=','SUPER.SOLICITUD')
                                                        ->where(DB::raw('TRIM(SUPER_2.COD_ARTIC)'),'=',DB::raw('TRIM(SUPER.CODIGO)'))
                                                        ->where('CLIENTE','=',$request->identificationNumber)
                                                        ->where(function($q){
                                                            $q->where('FEC_AUR','>',date("Y-m-d",strtotime(date("Y-m-d")."- 4 year")))
                                                            ->orWhere('FEC_AUR','=','1900-01-01');
                                                        })
                                                        ->where(function($q){
                                                            $q->where('ESTADO','=','FACTURADO')
                                                            ->orWhere('ESTADO','=','EN FACTURACION');
                                                        })
                                                        ->get();
            
            
        dd($ProductsInvoice,$products2, $products->get());                                        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response [listaOfStores,ListOfGroupsWithTheirRespectiveBrands,listOfTypeOfIdentification]
     */
    public function create()
    {
        // return a list of a identification number type
        $idType = DB::connection('oportudata')->table('MAESTRO_TIPO_DOC')
                                            ->select('codigo','descripcion')
                                            ->get();
        // return a list of a identification number type
        $stores = DB::connection('oportudata')->table('SUCURSALES')
                                            ->select('SUCURSALES.CODIGO','SUCURSALES.NOMBRE','SUCURSALES.DIRECCION','SUCURSALES.CIUDAD','SUCURSALES.DEPARTAMENTO_ID','DEPARTAMENTOS.NAME')
                                            ->join('DEPARTAMENTOS', 'SUCURSALES.DEPARTAMENTO_ID', '=', 'DEPARTAMENTOS.DEPARTAMENTO_ID')
                                            ->orderBy('DEPARTAMENTOS.DEPARTAMENTO_ID')
                                            ->orderBy('CIUDAD')
                                            ->where('ALMACEN','=','1')
                                            ->where('STATE','=','A')
                                            ->get();
        // group a stores by departamento and city
        $stores = $stores->groupBy('NAME')->map(function ($item, $key) {
            return collect($item)->groupBy('CIUDAD');
        });
        // return a list of a brands 
        $groupsBrands = DB::connection('oportudata')->table('GRUPO_MARCAS')
                                                ->select('GRUPO_MARCAS.GRUPO_MARCAS_ID','MARCA_ID','GRUPO_ID','GRUPO.NOMBRE','MARCAS.NOMBRE AS name')
                                                ->join('GRUPO', 'GRUPO_MARCAS.GRUPO_ID', '=', 'GRUPO.CODIGO')
                                                ->join('MARCAS', 'GRUPO_MARCAS.MARCA_ID', '=', 'MARCAS.CODIGO')
                                                ->where('GRUPO.active_warranty','=',1)
                                                ->where('MARCAS.active_warranty','=',1)
                                                ->orderBy('NOMBRE')
                                                ->orderBy('name')
                                                ->get();
        return [$stores,$groupsBrands->groupBy('NOMBRE'),$idType];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request a warranty request
     * @return \Illuminate\Http\Response id of the new warranty request 
     */
    public function store(Request $request)
    {   
        
        //add phone if exist
        if(isset($request->phone)){
            if(DB::connection('oportudata')->select("SELECT `NUM`, `IDENTI` FROM `CLI_CEL` WHERE `IDENTI` = :identificationNumber AND `NUM` = :celNum", ['identificationNumber' => $request->identificationNumber, 'celNum'  => $request->phone])){
                // if exist don't save
            }else{
                //else save a new register 
                $clienteCelular = new CliCel;
                $clienteCelular->IDENTI = $request->identificationNumber;
                $clienteCelular->NUM = $request->phone;
                $clienteCelular->TIPO = 'FIJO';
                $clienteCelular->CEL_VAL = 0;
                $clienteCelular->FECHA = date("Y-m-d H:i:s");
                $clienteCelular->save();
            }
        }
        $firstphone=True;//flag for identify a first phone
        foreach ($request->cellPhones as $cellPhone) {
            if(DB::connection('oportudata')->select("SELECT `NUM`, `IDENTI` FROM `CLI_CEL` WHERE `IDENTI` = :identificationNumber AND `NUM` = :celNum", ['identificationNumber' => $request->identificationNumber, 'celNum'  => $cellPhone['number']])){
                // if exist update
                if ($firstphone) {
                    //if is the first phone CEL_VEL = 1 becouse it was verified 
                    DB::connection('oportudata')->select("UPDATE `CLI_CEL` SET `CEL_VAL` = 1 WHERE `IDENTI` = :identificationNumber AND `NUM` = :celNum", ['identificationNumber' => $request->identificationNumber, 'celNum'  => $cellPhone['number']]);
                    $firstphone = False; // the next is´t a first cellphone
                }
            }else{
                //else save a new register 
                $warrantyPhone = new CliCel;
                $warrantyPhone->IDENTI = $request->identificationNumber;
                $warrantyPhone->NUM = $cellPhone['number'];
                $warrantyPhone->TIPO = 'CEL';
                if ($firstphone) {
                    $warrantyPhone->CEL_VAL = 1;
                    $firstphone = False;  // the next is´t a first cellphone
                }else{
                    $warrantyPhone->CEL_VAL = 0;// only is verified a first phone the othes in state 0
                }
                $warrantyPhone->FECHA = date("Y-m-d H:i:s");
                $warrantyPhone->save();
            }
        }        
        

        if(OportuyaV2::find($request->identificationNumber)){
            // if client already exist the register should be update
            $warrantyClient = OportuyaV2::find($request->identificationNumber);
            $warrantyClient->DIRECCION = $request->address;
            $warrantyClient->EMAIL = $request->email;
            $warrantyClient->save();
        }else{
            //  if client don't exist create a new register
            $warrantyClient = new CLIENTE;
            // set a values 
            $warrantyClient->TIPO_DOC = $request->idType;
            $warrantyClient->CEDULA = $request->identificationNumber;
            $warrantyClient->APELLIDOS = $request->lastNames;
            $warrantyClient->NOMBRES = $request->names;
            $warrantyClient->EMAIL = $request->email;
            $warrantyClient->save();
        }
        
        // create a new warranty request
        $warrantyRequest = new GARANTIA;

        $warrantyRequest->CEDULA = $request->identificationNumber;
        $warrantyRequest->NOM_CLIENT = $request->names." ".$request->lastNames;
        
        if ($request->meansSale['id'] == 5){
            //if a client shop a product in a physical store
            $warrantyRequest->COD_SUC = $request->store['CODIGO'];
            $warrantyRequest->NOM_SUC = $request->store['CODIGO']." ".$request->store['NOMBRE'];
        }elseif( $request->shop){
            //if client have register in oportudata
            $warrantyRequest->COD_SUC = $request->shop;
        }else{
            //else the client shop in any web store
            $warrantyRequest->COD_SUC = 9999;
        }
    
        if ($request->isUser == 'False'){
            // if a client is't a user of a product
            $warrantyRequest->PRODUCT_USER = $request->userName;
            $warrantyRequest->RELACION = $request->relationship;
        }
        // set a request data
        $warrantyRequest->FACTURA = $request->invoiceNumber;
        
        $warrantyRequest->FECHAFAC = $request->dateShop;
        $warrantyRequest->VALOR = 0;
        $warrantyRequest->N_ENTRADA = 0;
        $warrantyRequest->COD_ARTIC = $request->idProduct;
        $warrantyRequest->NOM_ARTIC = $request->reference;
        $warrantyRequest->MARCA = $request->productBrand['name'];
        $warrantyRequest->NSERVICIO = 0;
        $warrantyRequest->GRUPO = $request->productBrand['GRUPO_ID'];
        $warrantyRequest->SERIAL = 0;
        $warrantyRequest->IMEI = 0;
        $warrantyRequest->DIAGNOSTIC = 'NA';
        $warrantyRequest->NOM_TALLER = $request->type['name'];
        $warrantyRequest->OBSERVAC = $request->faultDescription;
        $warrantyRequest->INVENTARIO = 'NA';
        $warrantyRequest->UBICACION = $request->address;
        $warrantyRequest->SOLUCION = '';
        $warrantyRequest->FEC_LLEGA = date("Y-m-d G:i:s");
        $warrantyRequest->FEC_SALIDA = '0000-00-00 00:00:00';
        $warrantyRequest->FEC_SOL = '0000-00-00 00:00:00';
        $warrantyRequest->FEC_ENTREG = '0000-00-00 00:00:00';
        $warrantyRequest->USUARIO = 'JARVIS';
        $warrantyRequest->ANULA = '';
        $warrantyRequest->USU_SOL = '';
        $warrantyRequest->CIERRE = '';
        $warrantyRequest->CALIFICA = 'SIN CALIFICAR';
        $warrantyRequest->BONO = 0;
        $warrantyRequest->ESTADO = 'A';
        $warrantyRequest->STATE = 'A';
        $warrantyRequest->TOT_FAC = 0;
        if($warrantyRequest->save()){
            //  if save is construct a email data
            $emailData = ['identificationNumber' => $request->identificationNumber,'clientNames' => $request->names,'clientLastNames' => $request->lastNames,'userName' => $request->userName,'caso' => $warrantyRequest->NUMERO];
            //send a mail for alert that have a new warranty request 
            Mail::send('Emails.alertWarranty', $emailData, function($msj) use ($warrantyRequest){
                $msj->subject(date("d-m-Y G:i:s").' caso: '.$warrantyRequest->NUMERO.' cedula: '.$warrantyRequest->CEDULA);
                $msj->to('desarrolladorjunior@lagobo.com');
                $msj->to('garantiasoportunidades@lagobo.com.co');
                $msj->to('garantiasoportunidades2@lagobo.com.co');
                $msj->to('garantiasoportunidades3@lagobo.com');
                $msj->to('gestiondegarantias@lagobo.com.co');
            });
            
        
            Mail::send('Emails.alertWarrantyClient', ['caso' => $warrantyRequest->NUMERO], function($msj) use ($warrantyRequest,$request){
                $msj->subject('OPORTUNIDADES  /  ELECTROFERTAS, SOLICITUD DE GARANTÍA  CASO'.$warrantyRequest->NUMERO);
                $msj->to($request->email);
            });

            // return a request id
            return $warrantyRequest->NUMERO;

        }else{
            // if the saving process fail return false 
            return false;
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }



//------------------------------- Token verification  ------------------------------------------------------
 
public function getCodeVerificationOportudata($identificationNumber, $celNumber){
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
    $codeUserVerificationOportudata->created_at = date('Y-m-d H:i:s');
    $codeUserVerificationOportudata->telephone = $celNumber;
    $codeUserVerificationOportudata->type = "GARANTIA";

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

	public function sendMessageSms($code, $identificationNumber, $date, $celNumber){
		$url = 'https://api.hablame.co/sms/envio/';
		$data = array(
			'cliente' => 10013280, //Numero de cliente
			'api' => 'D5jpJ67LPns7keU7MjqXoZojaZIUI6', //Clave API suministrada
			'numero' => '57'.$celNumber, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
			'sms' => 'El código de verificación para el servicio de garantía de su producto es: '.$code." tiene una vigencia de 10 minutos. Aplican Terminos y Condiciones https://bit.ly/2CXo1SC - " . $date, //Mensaje de texto a enviar
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
	
		if ($result["resultado"]===0){
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
    
    /**
     *  // gGet the list of the bought products by the client in the last four years.
     *
     * @param  int  $identificationNumber
     * @return \Illuminate\Http\Response [$cilentNameAndLastName,$listOfTheProducts]
     */
	public function products(Request $request){
        // get a full name of de client 
        $getClient = DB::connection('oportudata')->table('CLIENTE_FAB')
                                                ->select('APELLIDOS','NOMBRES')
                                                ->where('CEDULA','=',$request->identificationNumber)
                                                ->get();
        if(count($getClient) == 0){
            //if don't find register 
            return 'no records';
        }
        // if find register  get a list of the products 
        $subProducts = DB::connection('oportudata')->table('SOLIC_FAB')
                                                ->select('MARCA','REFERENCIA','SUPER_2.COD_ARTIC','SUCURSAL','SOLIC_FAB.SOLICITUD','ARTICULO')
                                                ->join('SUPER_2','SOLIC_FAB.SOLICITUD','=','SUPER_2.SOLICITUD')
                                                ->leftJoin('ARTICULOS','SUPER_2.COD_ARTIC','=','ARTICULOS.CODIGO')
                                                ->where('CLIENTE','=',$request->identificationNumber)
                                                ->where(function($q){
                                                    $q->where('ESTADO','=','FACTURADO')
                                                    ->orWhere('ESTADO','=','EN FACTURACION');
                                                });

        $products =  DB::connection('oportudata')->table('SUPER')
                                                        ->select('MARCA','REFERENCIA','products.COD_ARTIC as CODIGO','FEC_AUR','FACTURA','SUCURSAL','products.ARTICULO')
                                                        ->rightJoinSub( $subProducts, 'products', function ($join) {
                                                            $join->on('SUPER.SOLICITUD', '=', 'products.SOLICITUD')
                                                            ->where(DB::raw('TRIM(products.COD_ARTIC)'),'=',DB::raw('TRIM(SUPER.CODIGO)'));
                                                        })
                                                        ->get();
        
        if(count($products)==0){
            // if don't find products 
            return [$getClient['0']];
        }
        //return a client information and list of products
        return [$getClient['0'],$products];
	}
}