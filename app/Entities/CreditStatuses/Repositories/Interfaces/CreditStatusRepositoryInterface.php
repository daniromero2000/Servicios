<?php

namespace App\Entities\CreditStatuses\Repositories\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Entities\CreditStatuses\CreditStatus;
use Illuminate\Support\Collection;

interface CreditStatusRepositoryInterface extends BaseRepositoryInterface
{
    public function createCreditStatus(array $CreditStatusData) : CreditStatus;

    public function updateCreditStatus(array $data) : bool;

    public function findCreditStatusById(int $id) : CreditStatus;

    public function listCreditStatuses();

    public function deleteCreditStatus() : bool;

    public function findCustomers(): Collection;

    public function findByName(string $name);
}
