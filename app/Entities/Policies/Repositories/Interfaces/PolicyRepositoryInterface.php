<?php

namespace App\Entities\Policies\Repositories\Interfaces;


interface PolicyRepositoryInterface
{

    public function CheckScorePolicy($customerScore);
}
