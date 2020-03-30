<?php

namespace App\Entities\ConfrontQuestions\Repositories;

use App\Entities\ConfrontQuestions\ConfrontQuestion;
use App\Entities\ConfrontQuestions\Repositories\Interfaces\ConfrontQuestionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontQuestionRepository implements ConfrontQuestionRepositoryInterface
{
    private $columns = [
        'id',
        'question',
        'type',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontQuestion $confrontQuestion
    ) {
        $this->model = $confrontQuestion;
    }

    public function createConfrontQuestion($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontQuestions()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getConfrontQuestionPhoneChange(){
        try {
            return $this->model->where('type',1)->orWhere('type',3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getConfrontQuestionCreditRequest(){
        try {
            return $this->model->where('type',1)->orWhere('type',3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    
}
