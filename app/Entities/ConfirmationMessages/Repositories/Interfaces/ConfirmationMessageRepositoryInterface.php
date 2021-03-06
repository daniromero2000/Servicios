<?php

namespace App\Entities\ConfirmationMessages\Repositories\Interfaces;

use App\Entities\ConfirmationMessages\ConfirmationMessage;

interface ConfirmationMessageRepositoryInterface
{
    public function findConfirmationMessageById(int $id): ConfirmationMessage;

    public function getPageDeniedTr();

    public function getPageDeniedAl();

    public function getPageDeniedSH();

    public function getPageDenied();
}
