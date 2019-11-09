<?php

namespace App\Entities\Assessors\Repositories\Interfaces;

interface AssessorRepositoryInterface
{
    public function createAssessor(array $data);

    public function getAssessorCompany($codeAssessor);
}
