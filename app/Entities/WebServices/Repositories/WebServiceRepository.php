<?php

namespace App\Entities\WebServices\Repositories;

use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;

class WebServiceRepository implements WebServiceRepositoryInterface
{
    public function execWebServiceFosygaRegistraduria($identificationNumber, $idConsultaWebService, $tipoDocumento, $dateExpeditionDocument = "")
    {
        set_time_limit(0);
        $urlConsulta = sprintf('http://produccion.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4g0b0$&jor=%s&icf=%s&thy=co&klm=%s', $idConsultaWebService, $tipoDocumento, $identificationNumber);
        //$urlConsulta = sprintf('http://test.konivin.com:32564/konivin/servicio/persona/consultar?lcy=lagobo&vpv=l4G0bo&jor=%s&icf=%s&thy=co&klm=ND1098XX', $idConsultaWebService, $tipoDocumento);
        if ($dateExpeditionDocument != '') {
            $urlConsulta .= sprintf('&hgu=%s', $dateExpeditionDocument);
        }
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $urlConsulta);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $persona = json_decode($buffer, true);

        return response()->json($persona);
    }

    public function sendMessageSms($code, $date, $celNumber)
    {
        $url = 'https://api.hablame.co/sms/envio/';
        $data = array(
            'cliente' => 10013280, //Numero de cliente
            'api' => 'D5jpJ67LPns7keU7MjqXoZojaZIUI6', //Clave API suministrada
            'numero' => '57' . $celNumber, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
            'sms' => 'El token de verificacion para Servicios Oportunidades es ' . $code . " el cual tiene una vigencia de 10 minutos. Aplica TyC http://bit.ly/2HX67DR - " . $date, //Mensaje de texto a enviar
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

        if ($result["resultado"] === 0) {
            $mensaje = 'Se ha enviado el SMS exitosamente';
        } else {
            $mensaje = 'ha ocurrido un error!!';
        }

        return response()->json(true);
    }
    
    public function sendMessageSmsInfobip($code, $date, $celNumber){
        $text = 'El token de verificacion para Servicios Oportunidades es ' . $code . " el cual tiene una vigencia de 15 minutos. Aplica TyC http://bit.ly/2HX67DR - " . $date;
        $username = "Lagobo.Distribuciones";
        $password = "Distribuciones2020";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://nzzpz5.api.infobip.com/sms/2/text/advanced",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n\t\"bulkId\":\"$code\",\r\n\t\"messages\":[\r\n\t\t{\r\n\t\t\t\"from\":\"InfoSMS\",\r\n\t\t\t\"destinations\":[\r\n\t\t\t\t{\r\n\t\t\t\t\t\"to\":\"57$celNumber\",\r\n\t\t\t\t\t\"messageId\":\"$code\"\r\n\t\t\t\t}\r\n\t\t\t],\r\n\t\t\t\"text\":\"$text\",\r\n\t\t\t\"flash\":false,\r\n\t\t\t\"intermediateReport\":false,\r\n\t\t\t\"validityPeriod\": 720\r\n\t\t}\r\n\t],\r\n\t\"tracking\":{\r\n\t\t\"track\":\"SMS\",\r\n\t\t\"type\":\"MY_CAMPAIGN\"\r\n\t}\r\n}",
            CURLOPT_HTTPHEADER => array(
              "accept: application/json",
              "authorization: Basic ". base64_encode($username . ":" . $password),
              "content-type: application/json"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }

    public function execConsultaComercial($identificationNumber, $typeDocument)
    {
        $obj = new \stdClass();
        $obj->typeDocument = trim($typeDocument);
        $obj->identificationNumber = trim($identificationNumber);
        try {
            $port = config('portsWs.creditVision');
            // 2801 CreditVision Produccion, 2020 CreditVision Pruebas
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultarInformacionComercial($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execConsultaUbica($identificationNumber, $typeDocument, $lastName)
    {
        $obj = new \stdClass();
        $obj->typeDocument = trim($typeDocument);
        $obj->identificationNumber = trim($identificationNumber);
        $obj->lastName = trim($lastName);
        try {
            // 2040 Ubica Pruebas
            $port = config('portsWs.ubica');
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultaUbicaPlus($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execCheckCutomerPays($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->identificationNumber = trim($identificationNumber);
        try {
            $port = config('portsWs.pagosCliente');
            $ws = new \SoapClient("http://10.238.14.181:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultaUbicaPlus($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execConsultaConfronta($typeDocument, $identificationNumber, $dateExpIdentification, $lastName)
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
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->obtenerCuestionario($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execMigrateCustomer($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->cedula = trim($identificationNumber);
        try {
            $ws = new \SoapClient("http://10.238.14.151:2816/Conector.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultarCliente($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function ConsultarInformacionComercial($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->typeDocument = 1;
        $obj->identificationNumber = trim($identificationNumber);
        try {
            $ws = new \SoapClient("http://10.238.14.151:9999/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultarInformacionComercial($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
