<?php

namespace App\Entities\SecondCodebtors\Repositories;

use App\Entities\SecondCodebtors\SecondCodebtor;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SecondCodebtorRepository implements SecondCodebtorRepositoryInterface
{

    private $columns = [];


    public function __construct(
        SecondCodebtor $SecondCodebtor
    ) {
        $this->model = $SecondCodebtor;
    }

    public function findCustomerById($identificationNumber)
    {
        try {
            return $this->model->find($identificationNumber);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createSecondCodebtor($request)
    {
        try {
            $data = [
                'CEDULA'     => '',
                'SOLICITUD'  => $request,
                'NOM_REFPER' => '',
                'DIR_REFPER' => '',
                'BAR_REFPER' => '',
                'TEL_REFPER' => '',
                'CIU_REFPER' => '',
                'NOM_REFPE2' => '',
                'DIR_REFPE2' => '',
                'BAR_REFPE2' => '',
                'TEL_REFPE2' => '',
                'CIU_REFPE2' => '',
                'NOM_REFFAM' => '',
                'DIR_REFFAM' => '',
                'BAR_REFFAM' => '',
                'TEL_REFFAM' => '',
                'PARENTESCO' => '',
                'NOM_REFFA2' => '',
                'DIR_REFFA2' => '',
                'BAR_REFFA2' => '',
                'TEL_REFFA2' => '',
                'PARENTESC2' => '',
                'NOM_REFCOM' => '',
                'TEL_REFCOM' => '',
                'NOM_REFCO'  => '',
                'TEL_REFCO2' => '',
                'NOM_CONYUG' => '',
                'CED_CONYUG' => '',
                'DIR_CONYUG' => '',
                'PROF_CONYU' => '',
                'EMP_CONYUG' => '',
                'CARGO_CONY' => '',
                'EPS_CONYUG' => '',
                'TEL_CONYUG' => '',
                'ING_CONYUG' => '',
                'CON_COD11'  => '',
                'CON_COD12'  => '',
                'CON_COD13'  => '',
                'CON_COD14'  => '',
                'EDIT_RFCOD' => '',
                'EDIT_RFCO2' => '',
                'EDIT_RFCO3' => '',
                'INFORMA1'   => '',
                'CARGO1'     => '',
                'FEC_COM1'   => '',
                'FEC_COM2'   => '',
                'ART_COM1'   => '',
                'ART_COM2'   => '',
                'CUOT_COM1'  => '',
                'CUOT_COM2'  => '',
                'HABITO1'    => '',
                'HABITO2'    => '',
                'STATE'      => 'A'
            ];
            return $this->model->create($data);
        } catch (QueryException $e) {
            return $e;
        }
    }
}
