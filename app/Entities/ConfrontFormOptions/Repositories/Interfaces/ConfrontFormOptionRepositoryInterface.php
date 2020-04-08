<?php

namespace App\Entities\ConfrontFormOptions\Repositories\Interfaces;

interface ConfrontFormOptionRepositoryInterface
{
    public function createConfrontFormOption($data);

    public function getAllConfrontFormOptions();
}
