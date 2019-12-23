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
            return $this->model->orderBy('channel', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
