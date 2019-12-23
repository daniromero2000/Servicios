<?php

namespace App\Entities\Services\Repositories;

use App\Entities\Services\Service;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ServiceRepository implements ServiceRepositoryInterface
{
    private $columns = [
        'id',
        'service',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        Service $service
    ) {
        $this->model = $service;
    }

    public function getAllServiceNames()
    {
        try {
            return $this->model->orderBy('service', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
