<?php

namespace App\Providers;

use App\Entities\AppErrors\Repositories\Interfaces\AppErrorRepositoryInterface;
use App\Entities\AppErrors\Repositories\AppErrorRepository;
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
use App\Entities\CifinCtaExts\Repositories\CifinCtaExtRepository;
use App\Entities\CifinCtaExts\Repositories\Interfaces\CifinCtaExtRepositoryInterface;
use App\Entities\CifinCtaVigens\Repositories\CifinCtaVigenRepository;
use App\Entities\CifinCtaVigens\Repositories\Interfaces\CifinCtaVigenRepositoryInterface;
use App\Entities\CustomerProfessions\Repositories\CustomerProfessionRepository;
use App\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use App\Entities\Services\Repositories\ServiceRepository;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Entities\FactoryRequestStatusesLogs\Repositories\FactoryRequestStatusesLogRepository;
use App\Entities\FactoryRequestStatusesLogs\Repositories\Interfaces\FactoryRequestStatusesLogRepositoryInterface;
use App\Entities\Kinships\Repositories\Interfaces\KinshipRepositoryInterface;
use App\Entities\Kinships\Repositories\KinshipRepository;
use App\Entities\LeadProducts\Repositories\LeadProductRepository;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use App\Entities\LeadStatuses\Repositories\LeadStatusRepository;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use App\Entities\LeadPrices\Repositories\LeadPriceRepository;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use App\Entities\TemporaryCustomers\Repositories\TemporaryCustomerRepository;
use App\Entities\Codebtors\Repositories\Interfaces\CodebtorRepositoryInterface;
use App\Entities\Codebtors\Repositories\CodebtorRepository;
use App\Entities\ConfrontFormAnswers\Repositories\ConfrontFormAnswerRepository;
use App\Entities\ConfrontFormAnswers\Repositories\Interfaces\ConfrontFormAnswerRepositoryInterface;
use App\Entities\ConfrontFormOptions\Repositories\ConfrontFormOptionRepository;
use App\Entities\ConfrontFormOptions\Repositories\Interfaces\ConfrontFormOptionRepositoryInterface;
use App\Entities\ConfrontFormQuestions\Repositories\ConfrontFormQuestionRepository;
use App\Entities\ConfrontFormQuestions\Repositories\Interfaces\ConfrontFormQuestionRepositoryInterface;
use App\Entities\ConfrontForms\Repositories\ConfrontFormRepository;
use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
use App\Entities\ConfrontQuestions\Repositories\ConfrontQuestionRepository;
use App\Entities\ConfrontQuestions\Repositories\Interfaces\ConfrontQuestionRepositoryInterface;
use App\Entities\ConfrontResults\Repositories\ConfrontResultRepository;
use App\Entities\ConfrontResults\Repositories\Interfaces\ConfrontResultRepositoryInterface;
use App\Entities\Departments\Repositories\DepartmentRepository;
use App\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Entities\Ruafs\Repositories\Interfaces\RuafRepositoryInterface;
use App\Entities\Ruafs\Repositories\RuafRepository;
use App\Entities\Factors\Repositories\FactorRepository;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Entities\ProductLists\Repositories\ProductListRepository;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ListProducts\Repositories\ListProductRepository;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\ListGiveAwayRepository;
use App\Entities\SecondCodebtors\Repositories\Interfaces\SecondCodebtorRepositoryInterface;
use App\Entities\SecondCodebtors\Repositories\SecondCodebtorRepository;
use App\Entities\UbicaAddresses\Repositories\Interfaces\UbicaAddressRepositoryInterface;
use App\Entities\UbicaAddresses\Repositories\UbicaAddressRepository;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\UbicaCellPhoneRepository;
use App\Entities\Brands\Repositories\BrandRepository;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Products\Repositories\ProductRepository;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Policies\Repositories\PolicyRepository;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;
use App\Entities\OportuyaTurns\Repositories\OportuyaTurnRepository;
use App\Entities\OportuyaTurns\Repositories\Interfaces\OportuyaTurnRepositoryInterface;
use App\Entities\DatosClientes\Repositories\DatosClienteRepository;
use App\Entities\DatosClientes\Repositories\Interfaces\DatosClienteRepositoryInterface;
use App\Entities\Turnos\Repositories\TurnRepository;
use App\Entities\Turnos\Repositories\Interfaces\TurnRepositoryInterface;
use App\Entities\FosygaTemps\Repositories\FosygaTempRepository;
use App\Entities\FosygaTemps\Repositories\Interfaces\FosygaTempRepositoryInterface;
use App\Entities\Analisis\Repositories\AnalisisRepository;
use App\Entities\Analisis\Repositories\Interfaces\AnalisisRepositoryInterface;
use App\Entities\AssessorQuotations\Repositories\AssessorQuotationRepository;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use App\Entities\CreditBusiness\Repositories\CreditBusinesRepository;
use App\Entities\CreditBusiness\Repositories\Interfaces\CreditBusinesRepositoryInterface;
use App\Entities\CreditBusinesDetails\Repositories\Interfaces\CreditBusinesDetailRepositoryInterface;
use App\Entities\CreditBusinesDetails\Repositories\CreditBusinesDetailRepository;
use App\Entities\FactorsOportudata\Repositories\FactorsOportudataRepository;
use App\Entities\FactorsOportudata\Repositories\Interfaces\FactorsOportudataRepositoryInterface;
use App\Entities\Plans\Repositories\PlanRepository;
use App\Entities\Plans\Repositories\Interfaces\PlanRepositoryInterface;
use App\Entities\ConfrontaResults\Repositories\ConfrontaResultRepository;
use App\Entities\ConfrontaResults\Repositories\Interfaces\ConfrontaResultRepositoryInterface;
use App\Entities\ConfrontaSelects\Repositories\ConfrontaSelectRepository;
use App\Entities\ConfrontaSelects\Repositories\Interfaces\ConfrontaSelectRepositoryInterface;
use App\Entities\UbicaEmails\Repositories\UbicaEmailRepository;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use App\Entities\CurrentCredits\Repositories\CurrentCreditRepository;
use App\Entities\CurrentCredits\Repositories\Interfaces\CurrentCreditRepositoryInterface;
use App\Entities\CustomerTypes\Repositories\CustomerTypeRepository;
use App\Entities\CustomerTypes\Repositories\Interfaces\CustomerTypeRepositoryInterface;
use App\Entities\ExpiredCredits\Repositories\ExpiredCreditRepository;
use App\Entities\ExpiredCredits\Repositories\Interfaces\ExpiredCreditRepositoryInterface;
use App\Entities\Obligations\Repositories\ObligationRepository;
use App\Entities\Obligations\Repositories\Interfaces\ObligationRepositoryInterface;
use App\Entities\SummaryCredits\Repositories\SummaryCreditRepository;
use App\Entities\SummaryCredits\Repositories\Interfaces\SummaryCreditRepositoryInterface;
use App\Entities\AssessorQuotationValues\Repositories\Interfaces\AssessorQuotationValueRepositoryInterface;
use App\Entities\AssessorQuotationValues\Repositories\AssessorQuotationValueRepository;
use App\Entities\AssessorQuotationDiscounts\Repositories\Interfaces\AssessorQuotationDiscountRepositoryInterface;
use App\Entities\AssessorQuotationDiscounts\Repositories\AssessorQuotationDiscountRepository;
use App\Entities\CustomerComments\Repositories\CustomerCommentRepository;
use App\Entities\CustomerComments\Repositories\Interfaces\CustomerCommentRepositoryInterface;
use App\Entities\EconomicSectors\Repositories\EconomicSectorRepository;
use App\Entities\EconomicSectors\Repositories\Interfaces\EconomicSectorRepositoryInterface;
use App\Entities\PaymentTimeCustomers\Repositories\Interfaces\PaymentTimeCustomerRepositoryInterface;
use App\Entities\PaymentTimeCustomers\Repositories\PaymentTimeCustomerRepository;
use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use App\Entities\PortfolioCollections\Repositories\PortfolioCollectionRepository;
use App\Entities\PortfolioCollectionTokens\Repositories\Interfaces\PortfolioCollectionTokenRepositoryInterface;
use App\Entities\PortfolioCollectionTokens\Repositories\PortfolioCollectionTokenRepository;
use App\Entities\StatusManagements\Repositories\Interfaces\StatusManagementRepositoryInterface;
use App\Entities\StatusManagements\Repositories\StatusManagementRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PaymentTimeCustomerRepositoryInterface::class,
            PaymentTimeCustomerRepository::class
        );

        $this->app->bind(
            AssessorQuotationDiscountRepositoryInterface::class,
            AssessorQuotationDiscountRepository::class
        );

        $this->app->bind(
            AssessorQuotationValueRepositoryInterface::class,
            AssessorQuotationValueRepository::class
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            PlanRepository::class
        );

        $this->app->bind(
            UbicaEmailRepositoryInterface::class,
            UbicaEmailRepository::class
        );

        $this->app->bind(
            ConfrontaSelectRepositoryInterface::class,
            ConfrontaSelectRepository::class
        );

        $this->app->bind(
            ConfrontaResultRepositoryInterface::class,
            ConfrontaResultRepository::class
        );

        $this->app->bind(
            FactorsOportudataRepositoryInterface::class,
            FactorsOportudataRepository::class
        );

        $this->app->bind(
            CreditBusinesDetailRepositoryInterface::class,
            CreditBusinesDetailRepository::class
        );

        $this->app->bind(
            CreditBusinesRepositoryInterface::class,
            CreditBusinesRepository::class
        );

        $this->app->bind(
            AssessorQuotationRepositoryInterface::class,
            AssessorQuotationRepository::class
        );

        $this->app->bind(
            AnalisisRepositoryInterface::class,
            AnalisisRepository::class
        );

        $this->app->bind(
            FosygaTempRepositoryInterface::class,
            FosygaTempRepository::class
        );

        $this->app->bind(
            TurnRepositoryInterface::class,
            TurnRepository::class
        );

        $this->app->bind(
            DatosClienteRepositoryInterface::class,
            DatosClienteRepository::class
        );

        $this->app->bind(
            OportuyaTurnRepositoryInterface::class,
            OportuyaTurnRepository::class
        );


        $this->app->bind(
            PolicyRepositoryInterface::class,
            PolicyRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->bind(
            ListGiveAwayRepositoryInterface::class,
            ListGiveAwayRepository::class
        );

        $this->app->bind(
            ListProductRepositoryInterface::class,
            ListProductRepository::class
        );

        $this->app->bind(
            ProductListRepositoryInterface::class,
            ProductListRepository::class
        );

        $this->app->bind(
            FactorRepositoryInterface::class,
            FactorRepository::class
        );

        $this->app->bind(
            UbicaCellPhoneRepositoryInterface::class,
            UbicaCellPhoneRepository::class
        );


        $this->app->bind(
            UbicaAddressRepositoryInterface::class,
            UbicaAddressRepository::class
        );

        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class
        );

        $this->app->bind(
            CifinCtaExtRepositoryInterface::class,
            CifinCtaExtRepository::class
        );

        $this->app->bind(
            CifinCtaVigenRepositoryInterface::class,
            CifinCtaVigenRepository::class
        );

        $this->app->bind(
            ConfrontResultRepositoryInterface::class,
            ConfrontResultRepository::class
        );

        $this->app->bind(
            ConfrontQuestionRepositoryInterface::class,
            ConfrontQuestionRepository::class
        );

        $this->app->bind(
            ConfrontFormRepositoryInterface::class,
            ConfrontFormRepository::class
        );

        $this->app->bind(
            ConfrontFormQuestionRepositoryInterface::class,
            ConfrontFormQuestionRepository::class
        );

        $this->app->bind(
            ConfrontFormOptionRepositoryInterface::class,
            ConfrontFormOptionRepository::class
        );

        $this->app->bind(
            ConfrontFormAnswerRepositoryInterface::class,
            ConfrontFormAnswerRepository::class
        );

        $this->app->bind(
            RuafRepositoryInterface::class,
            RuafRepository::class
        );

        $this->app->bind(
            SecondCodebtorRepositoryInterface::class,
            SecondCodebtorRepository::class
        );

        $this->app->bind(
            CodebtorRepositoryInterface::class,
            CodebtorRepository::class
        );

        $this->app->bind(
            KinshipRepositoryInterface::class,
            KinshipRepository::class
        );

        $this->app->bind(
            CustomerProfessionRepositoryInterface::class,
            CustomerProfessionRepository::class
        );

        $this->app->bind(
            TemporaryCustomerRepositoryInterface::class,
            TemporaryCustomerRepository::class
        );

        $this->app->bind(
            AppErrorRepositoryInterface::class,
            AppErrorRepository::class
        );

        $this->app->bind(
            LeadPriceRepositoryInterface::class,
            LeadPriceRepository::class
        );

        $this->app->bind(
            LeadStatusRepositoryInterface::class,
            LeadStatusRepository::class
        );

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

        $this->app->bind(
            CurrentCreditRepositoryInterface::class,
            CurrentCreditRepository::class
        );

        $this->app->bind(
            CustomerTypeRepositoryInterface::class,
            CustomerTypeRepository::class
        );

        $this->app->bind(
            ExpiredCreditRepositoryInterface::class,
            ExpiredCreditRepository::class
        );

        $this->app->bind(
            ObligationRepositoryInterface::class,
            ObligationRepository::class
        );

        $this->app->bind(
            SummaryCreditRepositoryInterface::class,
            SummaryCreditRepository::class
        );

        $this->app->bind(
            AssessorQuotationValueRepositoryInterface::class,
            AssessorQuotationValueRepository::class
        );

        $this->app->bind(
            EconomicSectorRepositoryInterface::class,
            EconomicSectorRepository::class
        );

        $this->app->bind(
            StatusManagementRepositoryInterface::class,
            StatusManagementRepository::class
        );

        $this->app->bind(
            CustomerCommentRepositoryInterface::class,
            CustomerCommentRepository::class
        );

        $this->app->bind(
            PortfolioCollectionRepositoryInterface::class,
            PortfolioCollectionRepository::class
        );

        $this->app->bind(
            PortfolioCollectionTokenRepositoryInterface::class,
            PortfolioCollectionTokenRepository::class
        );
    }
}
