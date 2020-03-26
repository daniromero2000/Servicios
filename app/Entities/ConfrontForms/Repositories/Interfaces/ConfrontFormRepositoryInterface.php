<?php

namespace App\Entities\ConfrontForms\Repositories\Interfaces;

interface ConfrontFormRepositoryInterface
{
    public function createConfrontForm($data);

    public function getAllConfrontForms();
}
