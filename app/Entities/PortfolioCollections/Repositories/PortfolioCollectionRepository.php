<?php

namespace App\Entities\PortfolioCollections\Repositories;

use App\Entities\PortfolioCollections\PortfolioCollection;
use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class PortfolioCollectionRepository implements PortfolioCollectionRepositoryInterface
{
    private $columns = [
     
    ];

    public function __construct(
        PortfolioCollection $PortfolioCollection
    ) {
        $this->model = $PortfolioCollection;
    }

    public function createPortfolioCollection($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllPortfolioCollections()
    {
        try {
            return $this->model->with('userChecked')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
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

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://200.13.195.48:9980/api/form/process/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ 'ProjectId': '1018', 'ApplicationId': '13', 'ButtonId': '46820', 'Table': 'false', 'Controls': [ { 'Id': 'numeroTransaccion', 'Valor': '201912160278133129' }, { 'Id': 'nombreEmpresa', 'Valor': 'CREDICORP CAPITAL COLOMBIA S.A.' }, { 'Id': 'nitEmpresa', 'Valor': '8600681825' }, { 'Id': 'referenciaPago', 'Valor': '123234234' }, { 'Id': 'nombreBanco', 'Valor': 'Bancolombia' }, { 'Id': 'tipoEntidad', 'Valor': 'ENTIDAD BANCARIA' }, { 'Id': 'codigoBanco', 'Valor': '19' }, { 'Id': 'oficina', 'Valor': 'PLAZA DE LAS AMERICAS' }, { 'Id': 'ciudad', 'Valor': 'BOGOTA' }, { 'Id': 'codigoCuenta', 'Valor': '24651' }, { 'Id': 'fechaPago', 'Valor': '10/09/2020' }, { 'Id': 'valorPago', 'Valor': '500000' }, { 'Id': 'origen', 'Valor': '4' } ] }",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer YjDviCv971qv5_sRSOSOZSdLgIluGFnmOAj3ouSclzYXOqGtEzVEi9P1j_KPSFxRRf2YeavT_80RiYAT_-70_UkTV0qlNOQ71DjJqU7hklO8shwPxiF62vCVfc-qUG-KQKm5sDVJ55ez3dvh5Yl5-IY6zyoNiwJgrtgkvdGszUO5ZSc8rj4-zZViVF9PdzwG81HaYWLKwZW14JUe33mlV_fdvaA-gK7Ps6f76B9YNcZH6c2EIa_9BGZ9g6QLrPaPlNi4sZ8WSeXrLmSud82cS5uUumYrkVMXtVDk4ynVTZ4WTnzlbSQOi_WA5Y4cqNeysBbprwPhwM0RS3jzcHx7ww ",
                "content-type: application/json"
            ),
        ));

        $response =  curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

}