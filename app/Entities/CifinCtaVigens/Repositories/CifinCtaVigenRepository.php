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

    public function getNameEntities(){
        try {
            return  $this->model->groupBy('vigentid')->random(4)->get(['vigentid']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}
