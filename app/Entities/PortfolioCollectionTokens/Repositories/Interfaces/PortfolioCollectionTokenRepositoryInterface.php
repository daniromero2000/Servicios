<?php

namespace App\Entities\PortfolioCollectionTokens\Repositories\Interfaces;

interface PortfolioCollectionTokenRepositoryInterface
{
    public function getPortfolioCollectionToken();

    public function createPortfolioCollectionToken($data);

    public function getAllPortfolioCollectionTokens();

    public function findPortfolioCollectionTokenById($id);

    public function updatePortfolioCollectionToken($data);

    public function deletePortfolioCollectionToken($id);

}