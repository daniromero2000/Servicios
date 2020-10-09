<?php

namespace App\Entities\AssessorQuotations\Repositories;

use App\Entities\AssessorQuotations\AssessorQuotation;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

class AssessorQuotationRepository implements AssessorQuotationRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'lastName',
        'identificationNumber',
        'telephone',
        'email',
        'total',
        'termsAndConditions',
        'assessor_id',
        'state',
        'created_at'
    ];

    public function __construct(
        AssessorQuotation $assessorQuotation
    ) {
        $this->model = $assessorQuotation;
    }

    public function listAssessorQuotations($from, $to, $totalView)
    {
        try {
            return $this->model->where('assessor_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findAssessorQuotationsById($id): AssessorQuotation
    {
        try {
            return $this->model->with(['quotationValues'])
                ->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createAssessorQuotations($data): AssessorQuotation
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchQuotations(string $text = null, $totalView,  $from = null,  $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->orderBy('created_at', 'desc')->where('assessor_id', auth()->user()->id)
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchQuotations($text, null, true, true)
                ->orderBy('created_at', 'desc')->where('assessor_id', auth()->user()->id)
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchQuotations($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])->where('assessor_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function updateAssessorQuotations($data): AssessorQuotation
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
