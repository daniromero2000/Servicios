<?php

namespace App\Entities\ListGiveAways\Repositories\Interfaces;

interface ListGiveAwayRepositoryInterface
{
    public function createListGiveAway($data);

    public function getAllListGiveAways();

    public function findListGiveAwayById($id);

    public function updateListGiveAway($data);

    public function deleteListGiveAway($id);
}