<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Leads\Repositories\leadRepository;
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
use App\Entities\CifinScores\Repositories\CifinScoreRepository;
use App\Entities\CifinScores\Repositories\Interfaces\CifinScoreRepositoryInterface;
use App\Entities\CreditCards\Repositories\CreditCardRepository;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\FactoryRequestRepository;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;

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

        $this->app->bind(
            CifinScoreRepositoryInterface::class,
            CifinScoreRepository::class
        );

        $this->app->bind(
            CreditCardRepositoryInterface::class,
            CreditCardRepository::class
        );

        $this->app->bind(
            FactoryRequestRepositoryInterface::class,
            FactoryRequestRepository::class
        );

        $this->app->bind(
            IntentionRepositoryInterface::class,
            IntentionRepository::class
        );
    }
}
