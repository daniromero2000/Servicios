<?php

namespace App\Entities\Definitions\Repositories;

use App\Entities\Definitions\Definition;
use Illuminate\Database\QueryException;

class DefinitionRepository implements DefinitionRepositoryInterface
{
    public function __construct(
        Definition $definition
    ) {
        $this->model = $definition;
    }

    public function listDefinitions()
    {
        try {
            return $this->model->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
