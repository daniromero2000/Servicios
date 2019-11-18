<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Leads\Repositories\LeadRepository;
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
use App\Entities\Customers\Repositories\CustomerRepository;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\ConfirmationMessages\Repositories\ConfirmationMessageRepository;
use App\Entities\ConfirmationMessages\Repositories\Interfaces\ConfirmationMessageRepositoryInterface;
use App\Entities\Cities\Repositories\CityRepository;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\CustomerCellPhoneRepository;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\ConsultationValidities\Repositories\ConsultationValidityRepository;
use App\Entities\ConsultationValidities\Repositories\Interfaces\ConsultationValidityRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadRepositoryInterface::class,
            LeadRepository::class
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

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            ConfirmationMessageRepositoryInterface::class,
            ConfirmationMessageRepository::class
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            CityRepository::class
        );

        $this->app->bind(
            CustomerCellPhoneRepositoryInterface::class,
            CustomerCellPhoneRepository::class
        );

        $this->app->bind(
            ConsultationValidityRepositoryInterface::class,
            ConsultationValidityRepository::class
        );
    }
}
