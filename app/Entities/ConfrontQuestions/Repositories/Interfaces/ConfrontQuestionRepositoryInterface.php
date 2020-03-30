<?php

namespace App\Entities\ConfrontQuestions\Repositories\Interfaces;

interface ConfrontQuestionRepositoryInterface
{
    public function createConfrontQuestion($data);

    public function getAllConfrontQuestions();

    public function getConfrontQuestionPhoneChange();
}
