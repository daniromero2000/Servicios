<?php

namespace App\Entities\ConfrontFormOptions\Repositories;

use App\Entities\ConfrontFormOptions\ConfrontFormOption;
use App\Entities\ConfrontFormOptions\Repositories\Interfaces\ConfrontFormOptionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontFormOptionRepository implements ConfrontFormOptionRepositoryInterface
{
    private $columns = [
        'id',
        'confront_form_question_id',
        'option',
        'correct_option',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontFormOption $confrontFormOptions
    ) {
        $this->model = $confrontFormOptions;
    }

    public function createConfrontFormOption($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontFormOptions()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getQuestionCorrectOption($questionId)
    {
        try {
            return $this->model->where('confront_form_question_id', $questionId)->where('correct_option', 1)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
