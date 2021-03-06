<?php

namespace App\Entities\WebServices\Repositories;

use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;

class WebServiceRepository implements WebServiceRepositoryInterface
{
    public function sendMessageSms($code, $date, $celNumber)
    {
        $ch = curl_init();

        $post = array(
                'account'           => '10013280', //número de usuario
                'apiKey'            => 'D5jpJ67LPns7keU7MjqXoZojaZIUI6', //clave API del usuario
                'token'             => '31f19ba5696fe82b68f44c026078af7b', // Token de usuario
                'toNumber'          => '57' . $celNumber, //número de destino
                'sms'               => 'El token de verificacion para Servicios Oportunidades es ' . $code . " el cual tiene una vigencia de 10 minutos. Aplica TyC http://bit.ly/2HX67DR - " . $date, // mensaje de texto
                'flash'             => '1', //mensaje tipo flash
                'sendDate'          => time(), //fecha de envío del mensaje
                'isPriority'        => 1, //mensaje prioritario
                'sc'                => '899991', //código corto para envío del mensaje de texto
                'request_dlvr_rcpt' => 0, //mensaje de texto con confirmación de entrega al celular
            );

        $url = "https://api101.hablame.co/api/sms/v2.1/send/"; //endPoint: Primario
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);

        //La respuesta estará alojada en la variable $response

        // if ($response["status"] == '1x000') {
        //     dd( 'El SMS se ha enviado exitosamente con el ID: ' . $response["smsId"] . PHP_EOL);
        // } else {
        //     dd( 'Ha ocurrido un error:' . $response["error_description"] . '(' . $response["status"] . ')' . PHP_EOL);
        // }

        return response()->json(true);
    }

    public function sendMessageSmsInfobip($code, $date, $celNumber)
    {
        $text = 'El token de verificacion para Servicios Oportunidades es ' . $code . " el cual tiene una vigencia de 15 minutos. Aplica TyC http://bit.ly/2HX67DR - " . $date;
        $username = "Lagobo.Distribuciones";
        $password = "Distribuciones2020*";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://nzzpz5.api.infobip.com/sms/2/text/advanced",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n\t\"bulkId\":\"$code\",\r\n\t\"messages\":[\r\n\t\t{\r\n\t\t\t\"from\":\"InfoSMS\",\r\n\t\t\t\"destinations\":[\r\n\t\t\t\t{\r\n\t\t\t\t\t\"to\":\"57$celNumber\",\r\n\t\t\t\t\t\"messageId\":\"$code\"\r\n\t\t\t\t}\r\n\t\t\t],\r\n\t\t\t\"text\":\"$text\",\r\n\t\t\t\"flash\":false,\r\n\t\t\t\"intermediateReport\":false,\r\n\t\t\t\"validityPeriod\": 15\r\n\t\t}\r\n\t],\r\n\t\"tracking\":{\r\n\t\t\"track\":\"SMS\",\r\n\t\t\"type\":\"MY_CAMPAIGN\"\r\n\t}\r\n}",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic " . base64_encode($username . ":" . $password),
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return response()->json(true);
    }

    public function execCheckCutomerPays($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->identificationNumber = trim($identificationNumber);
        try {
            $port = config('portsWs.pagosCliente');
            $ws = new \SoapClient("http://10.238.14.181:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $ws->ConsultaUbicaPlus($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execConsultaConfronta($customer, $dateExpIdentification, $lastName)
    {
        $obj = new \stdClass();
        $obj->typeDocument = trim($customer->TIPO_DOC);
        $obj->expeditionDate = trim($dateExpIdentification);
        $obj->identificationNumber = trim($customer->CEDULA);
        $obj->lastName = trim($lastName);
        $obj->phone = "3333333";
        try {
            // 2040 Ubica Pruebas
            $port = config('portsWs.confronta');
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl", array()); //correcta
            $ws->obtenerCuestionario($obj);  // correcta
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
            $ws->ConsultarCliente($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function execEvaluarConfronta($cuestionario, $dataEvaluar)
    {
        try {
            // 2050 Confronta Pruebas
            $port = config('portsWs.confronta');
            $ws = new \SoapClient("http://10.238.14.151:" . $port . "/Service1.svc?singleWsdl"); //correcta
            $ws->evaluarCuestionario([
                'Code'      => 7081,
                'question1' => $dataEvaluar[0]->secuencia_preg,
                'answer1'   => $dataEvaluar[0]->secuencia_resp,
                'question2' => $dataEvaluar[1]->secuencia_preg,
                'answer2'   => $dataEvaluar[1]->secuencia_resp,
                'question3' => $dataEvaluar[2]->secuencia_preg,
                'answer3'   => $dataEvaluar[2]->secuencia_resp,
                'question4' => $dataEvaluar[3]->secuencia_preg,
                'answer4'   => $dataEvaluar[3]->secuencia_resp,
                'question5' => $dataEvaluar[4]->secuencia_preg,
                'answer5'   => $dataEvaluar[4]->secuencia_resp,
                'secuence'  => $cuestionario
            ]);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
