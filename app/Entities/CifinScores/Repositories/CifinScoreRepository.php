<?php

namespace App\Entities\CifinScores\Repositories;

use App\Entities\CifinScores\CifinScore;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;

class CifinScoreRepository implements CifinScoreRepositoryInterface
{
    public function __construct(
        CifinScore $cifinScore
    ) {
        $this->model = $cifinScore;
    }

    public function getCustomerLastCifinScore($identificationNumber)
    {
        try {
            return $this->model->where('scocedula', $identificationNumber)
                ->orderBy('scoconsul', 'desc')->get(['scoconsul', 'score'])->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
