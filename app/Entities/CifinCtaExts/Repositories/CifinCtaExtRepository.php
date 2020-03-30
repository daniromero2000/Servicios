<?php

namespace App\Entities\CifinCtaExts\Repositories;

use App\Entities\CifinCtaExt\Repositories\Interfaces\CifinCtaExtRepositoryInterface;
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
            return  $this->model->groupBy('cextentid')->random(4)->get(['cextentid']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}
