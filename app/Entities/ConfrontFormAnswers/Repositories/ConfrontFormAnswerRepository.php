<?php

namespace App\Entities\ConfrontFormAnswers\Repositories;

use App\Entities\ConfrontFormAnswers\ConfrontFormAnswer;
use App\Entities\ConfrontFormAnswers\Repositories\Interfaces\ConfrontFormAnswerRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontFormAnswerRepository implements ConfrontFormAnswerRepositoryInterface
{
    private $columns = [
        'id',
        'confront_form_id',
        'confront_form_question_id',
        'confront_form_option_id',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontFormAnswer $confrontFormAnswer
    ) {
        $this->model = $confrontFormAnswer;
    }

    public function createConfrontFormAnswer($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontFormAnswers()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
