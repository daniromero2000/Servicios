<?php

namespace App\Entities\CommercialConsultations\Repositories;

use App\Entities\CommercialConsultations\CommercialConsultation;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use Illuminate\Database\QueryException;

class CommercialConsultationRepository implements CommercialConsultationRepositoryInterface
{
    public function __construct(
        CommercialConsultation $commercialConsultation
    ) {
        $this->model = $commercialConsultation;
    }

    public function getLastCommercialConsultation($identificationNumber)
    {
        try {
            return $this->model->where('cedula', $identificationNumber)
                ->orderBy('consec', 'desc')->get(['fecha'])->first();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function doConsultaComercial($oportudataLead, $days)
    {
        $dateConsultaComercial = $this->validateDateConsultaComercial($oportudataLead->CEDULA, $days);
        if ($dateConsultaComercial == 'true') {
            $consultaComercial = $this->execConsultaComercial($oportudataLead);
        } else {
            $consultaComercial = 1;
        }

        return $consultaComercial;
    }


    public function execConsultaComercial($oportudataLead)
    {
        $obj = new \stdClass();
        $obj->typeDocument = trim($oportudataLead->TIPO_DOC);
        $obj->identificationNumber = trim($oportudataLead->CEDULA);
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

    public function execConsultaComercialxml($oportudataLead)
    {
        $obj = new \stdClass();
        $obj->typeDocument = '1';
        $obj->identificationNumber = trim($oportudataLead);
        try {
            $ws = new \SoapClient("http://10.238.14.151:9999/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->execConsultaComercialxml($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            dd($th);
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

    public function validateDateConsultaComercial($identificationNumber, $daysToIncrement)
    {
        $dateNow = date('Y-m-d');
        $dateNew = strtotime("- $daysToIncrement day", strtotime($dateNow));
        $dateNew = date('Y-m-d', $dateNew);

        $dateLastConsultaComercial = $this->getLastCommercialConsultation($identificationNumber);

        if (empty($dateLastConsultaComercial)) {
            return 'true';
        } else {
            $dateLastConsulta = $dateLastConsultaComercial->fecha;

            if (strtotime($dateLastConsulta) < strtotime($dateNew)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }
}
