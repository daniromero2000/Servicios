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
use App\Entities\Fosygas\Repositories\FosygaRepository;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use App\Entities\WebServices\Repositories\WebServiceRepository;
use App\Entities\WebServices\Repositories\Interfaces\WebServiceRepositoryInterface;
use App\Entities\Registradurias\Repositories\RegistraduriaRepository;
use App\Entities\Registradurias\Repositories\Interfaces\RegistraduriaRepositoryInterface;
use App\Entities\CommercialConsultations\Repositories\CommercialConsultationRepository;
use App\Entities\CommercialConsultations\Repositories\Interfaces\CommercialConsultationRepositoryInterface;
use App\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Entities\Employees\Repositories\EmployeeRepository;
use App\Entities\Punishments\Repositories\PunishmentRepository;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\CustomerVerificationCodes\Repositories\CustomerVerificationCodeRepository;
use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\UpToDateFinancialCifinRepository;
use App\Entities\CifinFinancialArrears\Repositories\CifinFinancialArrearRepository;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\CifinRealArrears\Repositories\CifinRealArrearRepository;
use App\Entities\CifinRealArrears\Repositories\Interfaces\CifinRealArrearRepositoryInterface;
use App\Entities\Tools\Repositories\ToolRepository;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\ExtintFinancialCifins\Repositories\ExtintFinancialCifinRepository;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\UpToDateRealCifins\Repositories\UpToDateRealCifinRepository;
use App\Entities\UpToDateRealCifins\Repositories\Interfaces\UpToDateRealCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\Interfaces\ExtintRealCifinRepositoryInterface;
use App\Entities\ExtintRealCifins\Repositories\ExtintRealCifinRepository;
use App\Entities\CifinBasicDatas\Repositories\CifinBasicDataRepository;
use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
use App\Entities\Ubicas\Repositories\UbicaRepository;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\FactoryRequestComments\Repositories\FactoryRequestCommentRepository;
use App\Entities\FactoryRequestComments\Repositories\Interfaces\FactoryRequestCommentRepositoryInterface;
use App\Entities\CustomerReferences\Repositories\CustomerReferenceRepository;
use App\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use App\Entities\IntentionStatuses\Repositories\IntentionStatusRepository;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Entities\DataIntentionsRequest\Repositories\DataIntentionsRequestRepository;
use App\Entities\Channels\Repositories\ChannelRepository;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\Services\Repositories\ServiceRepository;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\FactoryRequestStatusesLogRepository;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\LeadProducts\Repositories\LeadProductRepository;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadProductRepositoryInterface::class,
            LeadProductRepository::class
        );

        $this->app->bind(
            FactoryRequestStatusesLogRepositoryInterface::class,
            FactoryRequestStatusesLogRepository::class
        );

        $this->app->bind(
            ServiceRepositoryInterface::class,
            ServiceRepository::class
        );

        $this->app->bind(
            ChannelRepositoryInterface::class,
            ChannelRepository::class
        );

        $this->app->bind(
            DataIntentionsRequestRepository::class
        );

        $this->app->bind(
            IntentionStatusRepositoryInterface::class,
            IntentionStatusRepository::class
        );

        $this->app->bind(
            CustomerReferenceRepositoryInterface::class,
            CustomerReferenceRepository::class
        );

        $this->app->bind(
            FactoryRequestCommentRepositoryInterface::class,
            FactoryRequestCommentRepository::class
        );

        $this->app->bind(
            UbicaRepositoryInterface::class,
            UbicaRepository::class
        );

        $this->app->bind(
            CifinBasicDataRepositoryInterface::class,
            CifinBasicDataRepository::class
        );

        $this->app->bind(
            ExtintRealCifinRepositoryInterface::class,
            ExtintRealCifinRepository::class
        );

        $this->app->bind(
            UpToDateRealCifinRepositoryInterface::class,
            UpToDateRealCifinRepository::class
        );

        $this->app->bind(
            ExtintFinancialCifinRepositoryInterface::class,
            ExtintFinancialCifinRepository::class
        );

        $this->app->bind(
            ToolRepositoryInterface::class,
            ToolRepository::class
        );

        $this->app->bind(
            CifinRealArrearRepositoryInterface::class,
            CifinRealArrearRepository::class
        );

        $this->app->bind(
            CifinFinancialArrearRepositoryInterface::class,
            CifinFinancialArrearRepository::class
        );

        $this->app->bind(
            UpToDateFinancialCifinRepositoryInterface::class,
            UpToDateFinancialCifinRepository::class
        );

        $this->app->bind(
            CustomerVerificationCodeRepositoryInterface::class,
            CustomerVerificationCodeRepository::class
        );

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

        $this->app->bind(
            FosygaRepositoryInterface::class,
            FosygaRepository::class
        );

        $this->app->bind(
            WebServiceRepositoryInterface::class,
            WebServiceRepository::class
        );

        $this->app->bind(
            RegistraduriaRepositoryInterface::class,
            RegistraduriaRepository::class
        );

        $this->app->bind(
            CommercialConsultationRepositoryInterface::class,
            CommercialConsultationRepository::class
        );

        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            PunishmentRepositoryInterface::class,
            PunishmentRepository::class
        );
    }
}
