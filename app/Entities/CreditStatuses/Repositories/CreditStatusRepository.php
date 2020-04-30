<?php

namespace App\Entities\CreditStatuses\Repositories;

use Jsdecena\Baserepo\BaseRepository;
use App\Entities\CreditStatuses\Exceptions\CreditStatusInvalidArgumentException;
use App\Entities\CreditStatuses\Exceptions\CreditStatusNotFoundException;
use App\Entities\CreditStatuses\CreditStatus;
use App\Entities\CreditStatuses\Repositories\Interfaces\CreditStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CreditStatusRepository extends BaseRepository implements CreditStatusRepositoryInterface
{
    /**
     * CreditStatusRepository constructor.
     * @param CreditStatus $CreditStatus
     */
    public function __construct(CreditStatus $CreditStatus)
    {
        parent::__construct($CreditStatus);
        $this->model = $CreditStatus;
    }

    /**
     * Create the customer status
     *
     * @param array $params
     * @return CreditStatus
     * @throws CreditStatusInvalidArgumentException
     */
    public function createCreditStatus(array $params) : CreditStatus
    {
        try {
            return $this->create($params);
        } catch (QueryException $e) {
            throw new CreditStatusInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the Customer status
     *
     * @param array $data
     *
     * @return bool
     * @throws CreditStatusInvalidArgumentException
     */
    public function updateCreditStatus(array $data) : bool
    {
        try {
            return $this->update($data);
        } catch (QueryException $e) {
            throw new CreditStatusInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return CreditStatus
     * @throws CreditStatusNotFoundException
     */
    public function findCreditStatusById(int $id) : CreditStatus
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CreditStatusNotFoundException('Customer status not found.');
        }
    }

    /**
     * @return mixed
     */
    public function listCreditStatuses()
    {
        return $this->all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteCreditStatus() : bool
    {
        return $this->delete();
    }

    /**
     * @return Collection
     */
    public function findCustomers() : Collection
    {
        return $this->model->customers()->get();
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
