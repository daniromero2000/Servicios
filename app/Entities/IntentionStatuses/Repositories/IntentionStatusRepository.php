<?php

namespace App\Entities\IntentionStatuses\Repositories;

use App\Entities\IntentionStatuses\IntentionStatus;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class IntentionStatusRepository implements IntentionStatusRepositoryInterface
{
    private $columns = [];


    public function __construct(
        IntentionStatus $IntentionStatus
    ) {
        $this->model = $IntentionStatus;
    }

    public function createIntentionStatus($data): IntentionStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function countIntentionStatuses($from, $to)
    {
        try {
            return  $this->model->with('intentions')->select('NAME', DB::raw('count(*) as total'))
                ->groupBy('NAME')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
