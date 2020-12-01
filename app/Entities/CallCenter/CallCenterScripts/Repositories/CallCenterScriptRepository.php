<?php

namespace Entities\CallCenter\CallCenterScripts\Repositories;
use Entities\CallCenterScripts\Repositories\Interfaces\CallCenterScriptRepositoryInterface;
use Entities\CallCenterScripts\CallCenterScript;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class CallCenterScriptRepository implements CallCenterScriptRepositoryInterface
{
    private $columns = [
        'id',
        'call_center_script',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(CallCenterScript $callCenterScript)
    {
        $this->model = $callCenterScript;
    }

    public function createcallCenterScript(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatecallCenterScript(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listcallCenterScript($totalView): Support
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
