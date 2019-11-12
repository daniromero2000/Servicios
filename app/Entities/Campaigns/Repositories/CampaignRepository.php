<?php

namespace App\Entities\Campaigns\Repositories;

use App\Entities\Campaigns\Campaign;
use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use Illuminate\Database\QueryException;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function __construct(
        Campaign $Campaign
    ) {
        $this->model = $Campaign;
    }

    public function createCampaign(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCampaignById(int $id): Campaign
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCampaignByName($name)
    {
        try {
            return $this->model->where('name', $name)->get();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCampaign(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
