<?php

namespace App\Entities\Assessors\Repositories\Interfaces;

use App\Entities\Assessors\Assessor;
use Illuminate\Database\Eloquent\Collection;

interface AssessorRepositoryInterface
{
    public function createAssessor(array $data);

    public function getAssessorCompany($codeAssessor);

    public function findAssessorById(int $id): Assessor;

    public function getCustomerAssessor($identificationNumber): Assessor;

    // public function listAssessorDigitalChannel();

    public function checkCustomerHasAssessor($identificationNumber, $timeRejectedVigency);

    public function getCustomerlatestAssessor($identificationNumber, $timeRejectedVigency);

    // public function listAssessors($totalView): Support;

    public function countAssessorsStatuses($from, $to);

    public function getAssessorsTotal($from, $to);

    public function listIntentionDirector($director);

    public function listAsessorssForSubsidiaries($subsidiary);

    public function searchAssessor(string $text = null, $totalView,  $from = null,  $to = null,  $status = null,  $subsidiary = null): Collection;
}