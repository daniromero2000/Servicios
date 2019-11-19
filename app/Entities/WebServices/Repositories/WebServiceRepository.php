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
}
