<?php

namespace Modules\CallCenter\Entities\CallCenterQuestionnaires\Repositories;

use Modules\CallCenter\Entities\CallCenterQuestionnaires\Repositories\Interfaces\CallCenterQuestionnaireRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterQuestionnaires\CallCenterQuestionnaire;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterQuestionnaireRepository implements CallCenterQuestionnaireRepositoryInterface
{
    private $columns = [
        'id',
        'question',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterQuestionnaire $callCenterQuestionnaire)
    {
        $this->model = $callCenterQuestionnaire;
    }

    public function createcallCenterQuestionnaire(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterQuestionnaire(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterQuestionnaires($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
