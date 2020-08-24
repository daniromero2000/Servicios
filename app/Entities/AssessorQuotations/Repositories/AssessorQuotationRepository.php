<?php

namespace App\Entities\AssessorQuotations\Repositories;

use App\Entities\AssessorQuotations\AssessorQuotation;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class AssessorQuotationRepository implements AssessorQuotationRepositoryInterface
{
    public function __construct(
        AssessorQuotation $assessorQuotation
    ) {
        $this->model = $assessorQuotation;
    }

    public function listAssessorQuotations($from, $to)
    {
        try {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function createAssessorQuotations($data)
    {
        try {
            return $this->model->create($data)
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}