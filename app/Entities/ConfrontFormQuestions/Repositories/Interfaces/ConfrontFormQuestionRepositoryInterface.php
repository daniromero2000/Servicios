<?php

namespace App\Entities\ConfrontFormQuestions\Repositories\Interfaces;

interface ConfrontFormQuestionRepositoryInterface
{
    public function createConfrontFormQuestion($data);

    public function getAllConfrontFormQuestions();
}
