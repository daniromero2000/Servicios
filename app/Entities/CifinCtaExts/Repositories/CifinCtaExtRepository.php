<?php

namespace App\Entities\CifinCtaExts\Repositories;

use App\Entities\CifinCtaExts\Repositories\Interfaces\CifinCtaExtRepositoryInterface;
use App\Entities\CifinCtaExts\CifinCtaExt;
use Doctrine\DBAL\Query\QueryException;

class CifinCtaExtRepository implements CifinCtaExtRepositoryInterface
{
    public function __construct(
        CifinCtaExt $cifinCtaExt
    ) {
        $this->model = $cifinCtaExt;
    }

    public function getNameEntities(){
        try {
            return $this->model->groupBy('cextentid')->orderByRaw("RAND()")->limit(4)->get(['cextentid']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getCustomerEntityName($identificationNumber){
        return $this->model->where('cextcedula', $identificationNumber)->groupBy('cextentid')->orderByRaw("RAND()")->limit(1)->get(['cextentid']);
    }
}
