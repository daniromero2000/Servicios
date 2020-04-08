<?php

namespace App\Entities\CifinCtaVigens\Repositories;

use App\Entities\CifinCtaVigens\CifinCtaVigen;
use App\Entities\CifinCtaVigens\Repositories\Interfaces\CifinCtaVigenRepositoryInterface;
use Doctrine\DBAL\Query\QueryException;

class CifinCtaVigenRepository implements CifinCtaVigenRepositoryInterface
{
    public function __construct(
        CifinCtaVigen $cifinCtaVigen
    ) {
        $this->model = $cifinCtaVigen;
    }

    public function getNameEntities($customerExtinctEntities){
        try {
            return  $this->model->whereNotIn('vigentid',$customerExtinctEntities)->groupBy('vigentid')->orderByRaw("RAND()")->limit(4)->get(['vigentid']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCustomerEntityName($identificationNumber){
        return $this->model->where('vigcedula', $identificationNumber)->groupBy('vigentid')->orderByRaw("RAND()")->get(['vigentid']);
    }
}
