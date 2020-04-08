<?php

namespace App\Entities\ConfrontFormAnswers\Repositories\Interfaces;

interface ConfrontFormAnswerRepositoryInterface
{
    public function createConfrontFormAnswer($data);

    public function getAllConfrontFormAnswers();
}
