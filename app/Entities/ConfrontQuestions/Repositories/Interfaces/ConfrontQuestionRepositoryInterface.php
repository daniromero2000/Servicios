<?php

namespace App\Entities\ConfrontQuestions\Repositories\Interfaces;

interface ConfrontQuestionRepositoryInterface
{
    public function createConfrontQuestion($data);

    public function getAllConfrontQuestions();

    public function getConfrontQuestionPhoneChange();

    public function getDataQuestionOne($identificationNumber);

    public function getDataQuestionTwo($identificationNumber);

    public function getDataQuestionThree($identificationNumber);

    public function getDataQuestionFour($identificationNumber);

    public function getDataQuestionFive($identificationNumber);
}
