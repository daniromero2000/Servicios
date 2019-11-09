<?php

namespace App\Entities\Assessors\Repositories;

use App\Entities\Assessors\Assessor;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\QueryException;

class AssessorRepository implements AssessorRepositoryInterface
{
    public function __construct(
        Assessor $assessor
    ) {
        $this->model = $assessor;
    }

    public function createAssessor(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getAssessorCompany($codeAssessor)
    {
        try {
            return $this->model->where('Codigo', $codeAssessor)->get(['ID_EMPRESA']);
        } catch (QueryBuilder $e) { }
    }
}
