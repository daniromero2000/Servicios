<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//libranza routes
Route::resource('libranzaV2', 'Admin\LibranzaV2Controller');

Route::group(['prefix' => '/creditoLibranza/'], function () {
    Route::get('/step1', 'Admin\LibranzaV2Controller@step1')->name('step1Libranza');
    Route::get('/getDataStep1', 'Admin\LibranzaV2Controller@getDataStep1');
    Route::get('/getDataStep2/{numIdentification}', 'Admin\LibranzaV2Controller@getDataStep2');
    Route::get('/getDataStep3/{numIdentification}', 'Admin\LibranzaV2Controller@getDataStep3');
    Route::post('/saveStep1', 'Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::post('/saveStep2', 'Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::get('/step2/{numIdentification}', 'Admin\LibranzaV2Controller@step2')->name('libranzaStep2');
    Route::get('/decryptText/{string}', 'Admin\LibranzaV2Controller@decrypt');
    Route::get('/step2Data/{numIdentification}', 'Admin\LibranzaV2Controller@getIDStep2');
    Route::get('/step3/{numIdentification}', 'Admin\LibranzaV2Controller@step3')->name('libranzaStep3');
    Route::get('/encryptText/{string}', 'Admin\LibranzaV2Controller@encrypt');
    Route::get('/cities', 'Admin\LibranzaV2Controller@cities')->name('step1Cities');
});

Route::group(['prefix' => '/libranza-principal/'], function () {
    Route::get('/', function () {
        return view('libranza.index');
    });
    Route::get('/simulador', function () {
        return view('libranza.simulador');
    });

    Route::get('/templateDialog', function () {
        return view('libranza.template');
    });

    Route::get('/templateDialogLI', function () {
        return view('libranza.templateLI');
    });

    Route::get('/resumen', function () {
        return view('libranza.resumen');
    });

    Route::get('/libranza-lines', function () {
        return view('libranza.libranza');
    });
});

Route::get('/Terminos-y-condiciones-simulador', function () {
    return view('menuItems.termsLibranza');
})->name('termsAndConditionsLibranza');

Route::resource('simulator', 'Admin\SimulatorController');
Route::get('simulador/getDataSimulador', 'Admin\SimulatorController@getData');
Route::delete('/deletePagaduria/{idPagaduria}', 'Admin\SimulatorController@deletePagaduria');
Route::delete('/deleteProfileLibranza/{idProfile}', 'Admin\SimulatorController@deleteProfile');
Route::post('/createPagaduria', 'Admin\SimulatorController@addPagaduria');
Route::post('/createProfileLibranza', 'Admin\SimulatorController@addProfile');
Route::put('/updatePagaduria/{idPagaduria}', 'Admin\SimulatorController@updatePagaduria');
Route::get('/OPN_gracias_newsletter', function () {
    return view('newsletter.index');
})->name('thankYouPageNewsletter');

Route::group(['prefix' => '/motos/solicitud/'], function () {

    Route::get('/step1', function () {
        return view('motos.step1');
    });

    Route::get('/thankYouPage', function () {
        return view('motos.thankYouPage');
    });
    Route::get('/step2/{numIdentification}', 'Front\Motos\MotosController@step2')->name('step2Motos');
    Route::get('/step3/{numIdentification}', 'Front\Motos\MotosController@step3')->name('step3Motos');
    Route::get('getDataMotoStep1', 'Front\Motos\MotosController@getDataStep1');
    Route::get('getDataMotoStep2/{identificationNumber}', 'Front\Motos\MotosController@getDataStep2');
    Route::get('getDataMotoStep3/{identificationNumber}', 'Front\Motos\MotosController@getDataStep3');
    Route::get('getNumLead/{identificationNumber}', 'Front\Motos\MotosController@getNumLead');
    Route::get('validationLead/{identificationNumber}', 'Front\Motos\MotosController@validationLead');
    Route::get('getCodeVerification/{identificationNumber}/{celNumber}/{type}', 'Front\Motos\MotosController@getCodeVerificationOportudata');
    Route::get('verificationCode/{code}/{identificationNumber}', 'Front\Motos\MotosController@verificationCode');
    Route::post('saveMotoLead', 'Front\Motos\MotosController@storeData');
    Route::get('encryptText/{string}', 'Front\Motos\MotosController@encrypt');
});

Route::group(['prefix' => '/motos/simulador/'], function () {

    Route::get('getData/{idMoto}', 'Front\Motos\MotosController@getDataLiquidator');
});

Route::resource('adminMotos', 'Admin\MotosAdminController');

Route::group(['prefix' => '/admin/motos/'], function () {
    Route::get('/', function () {
        return view('motos.adminMotos.index');
    });
    Route::get('/leads', function () {
        return view('motos.adminMotos.leads');
    });

    Route::put('addImage/{idMoto}', 'Admin\MotosAdminController@storeImageMoto');
});

Route::group(['prefix' => '/assessor/'], function () {
    Route::group(['prefix' => '/api/'], function () {
        Route::get('getInfoLead/{identificationNumber}', 'Admin\assessorsController@getInfoLead');
    });
});

// Administrator
Route::group(['prefix' => '/Administrator', 'middleware' => 'auth'], function () {
    // Gestion de Leads
    Route::group(['prefix' => '/director/', 'middleware' => 'auth'], function () {
        Route::get('/', function () {
            if (Auth::guest()) {
                return view('auth.login');
            }
            return view('director.index');
        });
        Route::get('/leads', function () {
            return view('director.leads');
        });
    });
});

/**
 * Admin routes
 */
Route::namespace('Admin')->group(function () {

    Route::namespace('CustomerTypes')->group(function () {
        Route::get('/Administrator/parametros', 'CreditController@index')->name('inicio');
        Route::get('/Administrator/wscartera', 'WsCarteraController@wscartera')->name('wscartera');
        Route::get('/Administrator/currentcredits/{identificationNumber}', 'CurrentCreditController@show')->name('current');
    });

    Route::namespace('Subsidiaries')->group(function () {
        Route::get('/subsidiaries/cities', 'SubsidiaryController@getSubsidiariesCity');
        Route::get('/api/subsidiaries/', 'SubsidiaryController@getSubsidiaries');
    });

    Route::namespace('FactoryRequests')->group(function () {
        Route::resource('Administrator/factoryrequests', 'FactoryRequestController');
        Route::get('/api/canalDigital/assignAssesorDigitalToLead/{solicitud}', 'FactoryRequestController@assignAssesorDigitalToLead');
        Route::get('/Administrator/dashboard/factoryrequests', 'FactoryRequestController@dashboard')->name('factory_dashboard');
    });

    Route::namespace('FactoryRequestTurns')->group(function () {
        Route::resource('Administrator/factoryrequestTurns', 'FactoryRequesTurnController');
        Route::get('/Administrator/dashboard/factoryrequestTurns', 'FactoryRequesTurnController@dashboard')->name('factoryTurns_dashboard');
    });

    Route::namespace('Intentions')->group(function () {
        Route::resource('Administrator/intentions', 'IntentionController');
        Route::get('/Administrator/dashboard/intentions', 'IntentionController@dashboard')->name('intention_dashboard');
    });

    Route::namespace('IntentionAssessors')->group(function () {
        Route::resource('Administrator/intentions/assessors/web', 'IntentionAssessorController');
        Route::get('/Administrator/dashboard/intentions/assessors', 'IntentionAssessorController@dashboard')->name('intention_assessor_dashboard');
    });

    Route::namespace('IntentionDirectors')->group(function () {
        Route::resource('Administrator/intentions/directors/web', 'IntentionDirectorController');
        Route::get('/Administrator/dashboard/intentions/directors', 'IntentionDirectorController@dashboard')->name('intentions_director_dashboard');
    });

    /*Community Leads Resource*/
    Route::resource('communityleads', 'CommunityController');
    Route::get('/Administrator/dashboard/communitymanager', 'CommunityController@dashboard')->name('community_dashboard');

    Route::namespace('DigitalChannelLeads')->group(function () {
        Route::resource('Administrator/digitalchannelleads', 'DigitalChannelLeadController');
        Route::get('/getproducts/{id}', 'DigitalChannelLeadController@byProducts');
        Route::get('/getLead/{telephone}', 'DigitalChannelLeadController@getLead');
        Route::get('/getStatuses/{id}', 'DigitalChannelLeadController@byStatus');
        Route::get('/getAssessors/{id}', 'DigitalChannelLeadController@byAssessors');
        Route::get('/getServices/{id}', 'DigitalChannelLeadController@byService');
        Route::get('/getLeadNotifications/{id}', 'DigitalChannelLeadController@byLeadNotifications');
        Route::get('/Administrator/dashboard/digitalChannelLead', 'DigitalChannelLeadController@dashboard')->name('digitalchannelleads_dashboard');
    });
    Route::namespace('LandingInsurances')->group(function () {
        Route::resource('Insurancesleads', 'InsurancesleadController');
    });

    Route::namespace('CallCenterLeads')->group(function () {
        Route::resource('Administrator/callcenterleads', 'CallCenterLeadController');
        Route::get('/Administrator/dashboard/CallCenterleads', 'CallCenterLeadController@dashboard')->name('CallCenterleads_dashboard');
        Route::get('Administrator/dashboard/lead/subsidiary', 'CallCenterLeadController@dashboardSubsidiary');
        Route::get('Administrator/leadSubsidiary', 'CallCenterLeadController@listLeadsSubsidiary')->name('leadSubsidiary.index');
    });

    Route::namespace('DigitalChannelLeadSlopes')->group(function () {
        Route::resource('Administrator/DigitalChannelLeadSlopes', 'DigitalChannelLeadSlopeController');
    });

    Route::namespace('LeadAssessors')->group(function () {
        Route::resource('Administrator/leadAssessors', 'LeadsAssessorsController');
        Route::get('Administrator/leads/director', 'LeadsAssessorsController@listLeadsDirector');
    });

    Route::namespace('DebtorInsurances')->group(function () {
        Route::resource('Administrator/DebtorInsuranceController', 'DebtorInsuranceController');
    });

    Route::namespace('AssessorQuotations')->group(function () {
        Route::resource('Administrator/assessorquotations', 'AssesorQuotationController');
    });

    Route::namespace('DebtorInsurancesOportuya')->group(function () {
        Route::resource('Administrator/DebtorInsuranceOportuya', 'DebtorOportuyaController');
    });

    Route::namespace('Customers')->group(function () {
        Route::resource('Administrator/customers', 'CustomerController');
        Route::get('/Administrator/dashboard/customers', 'CustomerController@dashboard')->name('customer_dashboard');
        Route::get('/Administrator/Insurance/Policy/Debtors', 'CustomerController@updatePoliceDebtors');
        Route::get('/Administrator/customer/execFosygaConsultation/{identificationNumber}', 'CustomerController@execFosygaConsultation')->name('customer_fosygaConsult');
        Route::get('/Administrator/customer/execRegistraduriaConsultation/{identificationNumber}', 'CustomerController@execRegistraduriaConsultation')->name('customer_registraduriaConsult');
        Route::get('/Administrator/customer/CodeVerification', 'CustomerController@codeVerification');
        Route::get('/api/customer/CodeVerification/{identification}', 'CustomerController@getCodeVerification');
        Route::get('/getPoliceDebtors/{id}', 'CustomerController@getPoliceDebtors');
        Route::get('/searchCustomer/{id}', 'CustomerController@searchCustomer');
        Route::get('/getPoliceDebtorOportuyas/{id}', 'CustomerController@getPoliceDebtorOportuyas');
    });

    Route::namespace('CallCenter')->group(function () {
        Route::resource('/Administrator/callCenter', 'CallCenterController');
        Route::get('/Administrator/dashboard/callCenter', 'CallCenterController@dashboard')->name('callCenter_dashboard');
    });

    Route::namespace('CreditLiquidator')->group(function () {
        Route::resource('/Administrator/creditLiquidator', 'CreditLiquidatorController');
        Route::get('/api/liquidator/getTerms/{term}', 'CreditLiquidatorController@getDate');
        Route::get('/api/liquidator/getPlans', 'CreditLiquidatorController@getPlans');
        Route::get('/api/liquidator/getLists', 'CreditLiquidatorController@getLists');
        Route::get('/api/liquidator/getFactors', 'CreditLiquidatorController@getFactors');
        Route::get('/api/liquidator/validationLead/{identificationNumber}', 'CreditLiquidatorController@validationLead');
        Route::get('/api/liquidator/getProduct/{id}/{list}', 'CreditLiquidatorController@getProduct');
        Route::get('/api/liquidator/getGift/{id}', 'CreditLiquidatorController@getGift');
        Route::get('/api/liquidator/createRequest/{id}/{city}', 'CreditLiquidatorController@addSolicFab');
    });

    Route::get('/Administrator/profile/users', 'UserController@profile')->name('user.profile');
    Route::put('/Administrator/{user}/profile', 'UserController@updateProfile')->name('user.profile.update');

    Route::namespace('Directors')->group(function () {
        Route::resource('/Administrator/director', 'DirectorController');
        Route::get('/Administrator/dashboard/director', 'DirectorController@dashboard')->name('directors_dashboard');
        Route::get('/Administrator/dashboard/directorZona1', 'DirectorController@dashboardZona1')->name('directors_dashboardZona1');
        Route::get('/Administrator/director/zona/1', 'DirectorController@directorZona1');
    });
    //asesores
    Route::resource('Administrator/assessors', 'assessorsController');
    Route::get('/Administrator/dashboard/assessors', 'assessorsController@dashboard')->name('assessors.dashboard');

    Route::namespace('Comments')->group(function () {
        Route::resource('Comments', 'CommentController');
    });

    Route::namespace('LeadPrices')->group(function () {
        Route::resource('leadPrices', 'LeadPriceController');
    });

    Route::get('/api/canalDigital/assignAssesorDigitalToLeadCM/{lead}', 'LeadsController@assignAssesorDigitalToLeadCM');

    //Panel Garantias

    Route::namespace('LeadWarranties')->group(function () {
        Route::resource('Administrator/LeadWarranties', 'LeadWarrantyController');
    });

    //Panel Cartera

    Route::namespace('LeadWallets')->group(function () {
        Route::resource('Administrator/LeadWallets', 'LeadWalletController');
    });

    //Panel Oportuya
    Route::namespace('LeadOportuyas')->group(function () {
        Route::resource('Administrator/LeadsOportuya', 'LeadOportuyaController');
    });

    //Panel Libranza
    Route::namespace('LeadLibranzas')->group(function () {
        Route::resource('Administrator/LeadsLibranzas', 'LeadLibranzaController');
    });

    //Panel Juridica
    Route::namespace('LeadJuridicals')->group(function () {
        Route::resource('Administrator/LeadsJuridical', 'LeadJuridicalController');
    });

    // Panel AdvancedUnit
    Route::namespace('LeadAdvancedUnits')->group(function () {
        Route::resource('Administrator/LeadsAdvancedUnit', 'LeadAdvancedUnitController');
    });

    // Panel Ecommerce
    Route::namespace('LeadEcommerces')->group(function () {
        Route::resource('Administrator/LeadsEcommerce', 'LeadEcommerceController');
    });

    // Panel Seguros
    Route::namespace('LeadInsurances')->group(function () {
        Route::resource('Administrator/LeadsInsurance', 'LeadInsuranceController');
    });
});

/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {
    Route::namespace('Advances')->group(function () {
        Route::resource('avance', 'AdvanceController');
    });

    Route::namespace('CovidData')->group(function () {
        Route::resource('covid', 'CovidDataController');
    });

    Route::namespace('payPse')->group(function () {
        Route::resource('payPse', 'payPseController');
    });


    Route::namespace('Newsletters')->group(function () {
        Route::resource('newsletter', 'newsletterController');
    });

    Route::namespace('Insurances')->group(function () {
        Route::get('/api/seguros/credito/getInfoForm', 'SegurosController@getInfoForm');
        Route::resource('seguros', 'SegurosController', [
            'except' => ['show']
        ]);

        Route::get('seguros/credito', function () {
            return view('seguros.credito.index');
        });
    });

    Route::namespace('ConfrontaCustomers')->group(function () {
        Route::resource('change-customer-data', 'ConfrontaCustomerController');
    });

    Route::namespace('Motos')->group(function () {
        Route::resource('motos', 'MotosController');
    });

    Route::namespace('Travels')->group(function () {
        Route::resource('viajes', 'ViajesController');
    });
});