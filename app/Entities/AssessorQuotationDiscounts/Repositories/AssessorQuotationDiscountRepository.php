<?php

namespace App\Entities\AssessorQuotationDiscounts\Repositories;

use App\Entities\AssessorQuotationDiscounts\AssessorQuotationDiscount;
use App\Entities\AssessorQuotationDiscounts\Repositories\Interfaces\AssessorQuotationDiscountRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class AssessorQuotationDiscountRepository implements AssessorQuotationDiscountRepositoryInterface
{
    public function __construct(
        AssessorQuotationDiscount $assessorQuotation
    ) {
        $this->model = $assessorQuotation;
    }

    public function listAssessorQuotationDiscounts($from, $to)
    {
        try {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}