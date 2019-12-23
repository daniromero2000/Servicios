<?php

namespace App\Entities\Channels\Repositories;

use App\Entities\Channels\Channel;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ChannelRepository implements ChannelRepositoryInterface
{
    private $columns = [
        'id',
        'channel',
        'created_at',
        'updated_at',
    ];


    public function __construct(
        Channel $Channel
    ) {
        $this->model = $Channel;
    }

    public function getAllChannelNames()
    {
        try {
            return $this->model->where('PRINCIPAL', 1)->orderBy('CIUDAD', 'asc')->get(['CIUDAD']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getChannelCityByCode($code)
    {
        try {
            return $this->model->where('CODIGO', $code)->get(['CIUDAD'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function getChannelRiskZone($customerChannel)
    {
        try {
            return $this->model->where('CODIGO', $customerChannel)->get(['ZONA'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    private function getNameCiudadExp($city)
    {
        $queryCity = sprintf("SELECT `NOMBRE` FROM `CIUDADES` WHERE `CODIGO` = %s ", $city);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }

    public function listSubsidiares($totalView): Support
    {
        try {
            return  $this->model
                ->orderBy('CODIGO', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findChannelByIdFull(int $id): Channel
    {
        try {
            return $this->model
                ->with('factoryRequests')
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
