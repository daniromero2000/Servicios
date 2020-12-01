<?php

namespace Modules\CallCenter\Entities\CallCenterCampaigns\Repositories;

use Modules\CallCenter\Entities\CallCenterCampaigns\Repositories\Interfaces\CallCenterCampaignRepositoryInterface;
use Modules\CallCenter\Entities\CallCenterCampaigns\CallCenterCampaign;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterCampaignRepository implements CallCenterCampaignRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'description',
        'department_id',
        'begindate',
        'endingdate',
        'questionnary_id',
        'script_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterCampaign $callCenterCampaign)
    {
        $this->model = $callCenterCampaign;
    }

    public function createCallCenterCampaign(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCallCenterCampaign(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCallCenterCampaigns($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
