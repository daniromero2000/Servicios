<?php

namespace App\Entities\ConfrontFormQuestions\Repositories;

use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
use App\Entities\ConfrontFormQuestions\Repositories\Interfaces\ConfrontFormQuestionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontFormQuestionRepository implements ConfrontFormQuestionRepositoryInterface
{
    private $columns = [
        'id',
        'confront_question_id',
        'confront_form_id',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontFormQuestion $confrontFormQuestion
    ) {
        $this->model = $confrontFormQuestion;
    }

    public function createConfrontFormQuestion($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontFormQuestions()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
