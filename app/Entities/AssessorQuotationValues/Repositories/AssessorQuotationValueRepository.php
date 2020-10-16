<?php

namespace App\Entities\AssessorQuotationValues\Repositories;

use App\Entities\AssessorQuotationValues\AssessorQuotationValue;
use App\Entities\AssessorQuotationValues\Repositories\Interfaces\AssessorQuotationValueRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class AssessorQuotationValueRepository implements AssessorQuotationValueRepositoryInterface
{
    public function __construct(
        AssessorQuotationValue $assessorQuotation
    ) {
        $this->model = $assessorQuotation;
    }

    public function createAssessorQuotationValues($data)
    {
        try {
            return $this->model->create($data)
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function updateAssessorQuotationsValues($data): AssessorQuotationValue
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
