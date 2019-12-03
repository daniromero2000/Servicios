<?php

namespace App\Entities\LeadStatuses\Repositories;

use Jsdecena\Baserepo\BaseRepository;
use App\Entities\LeadStatuses\Exceptions\LeadStatusInvalidArgumentException;
use App\Entities\LeadStatuses\Exceptions\LeadStatusNotFoundException;
use App\Entities\LeadStatuses\LeadStatus;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class LeadStatusRepository extends BaseRepository implements LeadStatusRepositoryInterface
{
    /**
     * LeadStatusRepository constructor.
     * @param LeadStatus $LeadStatus
     */
    public function __construct(LeadStatus $LeadStatus)
    {
        parent::__construct($LeadStatus);
        $this->model = $LeadStatus;
    }

    /**
     * Create the customer status
     *
     * @param array $params
     * @return LeadStatus
     * @throws LeadStatusInvalidArgumentException
     */
    public function createLeadStatus(array $params): LeadStatus
    {
        try {
            return $this->create($params);
        } catch (QueryException $e) {
            throw new LeadStatusInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the Customer status
     *
     * @param array $data
     *
     * @return bool
     * @throws LeadStatusInvalidArgumentException
     */
    public function updateLeadStatus(array $data): bool
    {
        try {
            return $this->update($data);
        } catch (QueryException $e) {
            throw new LeadStatusInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return LeadStatus
     * @throws LeadStatusNotFoundException
     */
    public function findLeadStatusById(int $id): LeadStatus
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new LeadStatusNotFoundException('Customer status not found.');
        }
    }

    /**
     * @return mixed
     */
    public function listLeadStatuses()
    {
        return $this->all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteLeadStatus(): bool
    {
        return $this->delete();
    }

    /**
     * @return Collection
     */
    public function findCustomers(): Collection
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
