<?php

namespace App\Entities\DataIntentionsRequest\Repositories\Interfaces;

interface DataIntentionsRequestRepositoryInterface
{
    public function countDataIntentionsForTypedevice($from, $to);
}