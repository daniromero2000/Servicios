<?php

namespace App\Entities\ConfrontForms\Repositories;

use App\Entities\ConfrontForms\ConfrontForm;
use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontFormRepository implements ConfrontFormRepositoryInterface
{
    private $columns = [
        'id',
        'identificationNumber',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontForm $confrontForm
    ) {
        $this->model = $confrontForm;
    }

    public function createConfrontForm($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontForms()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCustomerConfrontFormLastDay($identificationNumber){
        $dateIni = date("Y-m-d 01:00:00");
        $dateFin = date("Y-m-d 23:59:59");
        try {
            return $this->model->where('created_at', '>=', $dateIni)->where('created_at', '<=', $dateFin)->where('identificationNumber', $identificationNumber)->count();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
