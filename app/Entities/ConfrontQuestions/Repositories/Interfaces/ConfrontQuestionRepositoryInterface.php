<?php

namespace App\Entities\ConfrontQuestions\Repositories\Interfaces;

interface ConfrontQuestionRepositoryInterface
{
    public function createConfrontQuestion($data);

    public function getAllConfrontQuestions();

    public function getConfrontQuestionPhoneChange();

    public function getDataQuestionOne($identicationNumber);

    public function getDataQuestionTwo($identificationNumber);

    public function getDataQuestionThree($identificationNumber);

    public function getDataQuestionFour($identicationNumber);
}
