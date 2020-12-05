<?php

namespace App\Entities\PortfolioCollections\Repositories\Interfaces;

interface PortfolioCollectionRepositoryInterface
{
    public function listPortfolioCollection();

    public function createPortfolioCollection($data);

    public function findPortfolioCollectionById($id);

    public function updatePortfolioCollection($data);

    public function deletePortfolioCollection($id);

    public function sendPortfolioCollection($data);

}