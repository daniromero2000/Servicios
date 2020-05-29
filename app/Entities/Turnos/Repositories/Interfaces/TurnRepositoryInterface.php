<?php

namespace App\Entities\Turnos\Repositories\Interfaces;


interface TurnRepositoryInterface
{
    public function addTurn($data);

    public function getListAnalysts($data);
}