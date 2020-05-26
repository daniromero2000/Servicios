<?php

namespace App\Entities\Policies\Repositories;

use App\Entities\Policies\Policy;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;

class PolicyRepository implements PolicyRepositoryInterface
{
    public function __construct(Policy $policy)
    {
        $this->model = $policy;
    }

    public function CheckScorePolicy($customerScore)
    {
        if ($customerScore >= -7 && $customerScore <= 0) {
            return $perfilCrediticio = 'TIPO 5';
        }

        if ($customerScore >= 275 && $customerScore <= 527) {
            return $perfilCrediticio = 'TIPO D';
        }

        if ($customerScore >= 528 && $customerScore <= 624) {
            return  $perfilCrediticio = 'TIPO C';
        }

        if ($customerScore >= 625 && $customerScore <= 674) {
            return $perfilCrediticio = 'TIPO B';
        }

        if ($customerScore >= 675 && $customerScore <= 1000) {
            return $perfilCrediticio = 'TIPO A';
        }

        if ($customerScore <= -8) {
            return $perfilCrediticio = 'TIPO 7';
        }
    }
}
