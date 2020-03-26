<?php

namespace App\Entities\Channels\Repositories;

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
}
