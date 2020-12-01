<?php

namespace Modules\CallCenter\Entities\CallCenterQuestionnaires\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface CallCenterQuestionnaireRepositoryInterface
{
    public function createCallCenterQuestionnaire(array $data);

    public function updateCallCenterQuestionnaire(array $data);

    public function listCallCenterQuestionnaires($totalView): Support;
}
