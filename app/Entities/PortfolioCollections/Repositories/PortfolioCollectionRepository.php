<?php

namespace App\Entities\PortfolioCollections\Repositories;

use App\Entities\PortfolioCollections\PortfolioCollection;
use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class PortfolioCollectionRepository implements PortfolioCollectionRepositoryInterface
{
    private $columns = [];

    public function __construct(
        PortfolioCollection $PortfolioCollection
    ) {
        $this->model = $PortfolioCollection;
    }

    public function listPortfolioCollection()
    {
        try {
            return $this->model->where('subsidiary_id', auth()->user()->Assessor->SUCURSAL)
            ->orderBy('created_at', 'desc')->get();
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function createPortfolioCollection($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function findPortfolioCollectionById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatePortfolioCollection($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deletePortfolioCollection($id)
    {
        $data = $this->findPortfolioCollectionById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

    public function sendPortfolioCollection($data)
    {
        $curl = curl_init();


        $dataSend = [
            "ProjectId" => "1018",
            "ApplicationId" => "13",
            "ButtonId" => "46820",
            "Table" => "false",
            "Controls" => [
                [
                    "Id" => "numeroTransaccion",
                    "Valor" => "201912160278133129"
                ],
                [
                    "Id" => "nombreEmpresa",
                    "Valor" => "CREDICORP CAPITAL COLOMBIA S.A."
                ],
                [
                    "Id" => "nitEmpresa",
                    "Valor" => "8600681825"
                ],
                [
                    "Id" => "referenciaPago",
                    "Valor" => $data['payment_reference']
                ],
                [
                    "Id" => "nombreBanco",
                    "Valor" => "Bancolombia"
                ],
                [
                    "Id" => "tipoEntidad",
                    "Valor" => "ENTIDAD BANCARIA"
                ],
                [
                    "Id" => "codigoBanco",
                    "Valor" => "19"
                ],
                [
                    "Id" => "oficina",
                    "Valor" => "PLAZA DE LAS AMERICAS"
                ],
                [
                    "Id" => "ciudad",
                    "Valor" => "BOGOTA"
                ],
                [
                    "Id" => "codigoCuenta",
                    "Valor" => "24651"
                ],
                [
                    "Id" => "fechaPago",
                    "Valor" => $data['payment_date']
                ],
                [
                    "Id" => "valorPago",
                    "Valor" => $data['amount']
                ],
                [
                    "Id" => "origen",
                    "Valor" => "4"
                ]
            ]
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://200.13.195.48:9980/api/form/process/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($dataSend),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer " . $data['token'],
                "content-type: application/json"
            ),
        ));

        $response =  curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }
}
