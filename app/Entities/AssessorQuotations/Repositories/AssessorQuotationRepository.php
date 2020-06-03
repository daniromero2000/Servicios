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
}
