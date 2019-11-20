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
}