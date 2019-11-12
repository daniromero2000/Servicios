<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\leads\Repositories\leadRepository;
use App\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Assessors\Repositories\AssessorRepository;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\Users\Repositories\UserRepository;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\Campaigns\Repositories\CampaignRepository;
use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Comments\Repositories\CommentRepository;
use App\Entities\Comments\Repositories\Interfaces\CommentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadRepositoryInterface::class,
            leadRepository::class
        );

        $this->app->bind(
            SubsidiaryRepositoryInterface::class,
            SubsidiaryRepository::class
        );

        $this->app->bind(
            AssessorRepositoryInterface::class,
            AssessorRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            CampaignRepositoryInterface::class,
            CampaignRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
    }
}
