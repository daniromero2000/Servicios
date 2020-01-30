<?php

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
    // Route::namespace('Directors')->group(function () {
    //     Route::resource('director', 'DirectorController');
    // });

    Route::namespace('Subsidiaries')->group(function () {
        Route::get('/subsidiaries/cities', 'SubsidiaryController@getSubsidiariesCity');
    });

    Route::namespace('FactoryRequests')->group(function () {
        Route::resource('Administrator/factoryrequests', 'FactoryRequestController');
        Route::get('/api/canalDigital/assignAssesorDigitalToLead/{solicitud}', 'FactoryRequestController@assignAssesorDigitalToLead');
        Route::get('/Administrator/dashboard/factoryrequests', 'FactoryRequestController@dashboard')->name('factory_dashboard');
    });

    Route::namespace('Intentions')->group(function () {
        Route::resource('Administrator/intentions', 'IntentionController');
        Route::get('/Administrator/dashboard/intentions', 'IntentionController@dashboard')->name('intention_dashboard');
    });

    Route::namespace('IntentionAssessors')->group(function () {
        Route::resource('Administrator/intentions/assessors/web', 'IntentionAssessorController');
        Route::get('/Administrator/dashboard/intentions/assessors', 'IntentionAssessorController@dashboard');
    });

    /*Community Leads Resource*/
    Route::resource('communityleads', 'CommunityController');
    Route::get('/Administrator/dashboard/communitymanager', 'CommunityController@dashboard')->name('community_dashboard');

    Route::namespace('DigitalChannelLeads')->group(function () {
        Route::resource('Administrator/digitalchannelleads', 'DigitalChannelLeadController');
        Route::get('/getproducts/{id}', 'DigitalChannelLeadController@byProducts');
        Route::get('/getStatuses/{id}', 'DigitalChannelLeadController@byStatus');
        Route::get('/getAssessors/{id}', 'DigitalChannelLeadController@byAssessors');
        Route::get('/getServices/{id}', 'DigitalChannelLeadController@byService');
        Route::get('/Administrator/dashboard/digitalChannelLead', 'DigitalChannelLeadController@dashboard')->name('digitalchannelleads_dashboard');
    });

    Route::namespace('CallCenterLeads')->group(function () {
        Route::resource('Administrator/callcenterleads', 'CallCenterLeadController');
        Route::get('/Administrator/dashboard/CallCenterleads', 'CallCenterLeadController@dashboard')->name('CallCenterleads_dashboard');
    });

    Route::namespace('Customers')->group(function () {
        Route::resource('Administrator/customers', 'CustomerController');
        Route::get('/Administrator/dashboard/customers', 'CustomerController@dashboard')->name('customer_dashboard');
    });

    Route::namespace('CallCenter')->group(function () {
        Route::resource('/Administrator/callCenter', 'CallCenterController');
        Route::get('/Administrator/dashboard/callCenter', 'CallCenterController@dashboard')->name('callCenter_dashboard');
    });

    Route::get('/Administrator/profile/users', 'UserController@profile')->name('user.profile');
    Route::put('/Administrator/{user}/profile', 'UserController@updateProfile')->name('user.profile.update');

    Route::namespace('Directors')->group(function () {
        Route::resource('/Administrator/director', 'DirectorController');
        Route::get('/Administrator/dashboard/director', 'DirectorController@dashboard')->name('directors_dashboard');
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
});

/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {
    Route::namespace('Advances')->group(function () {
        Route::resource('avance', 'AdvanceController');
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

    Route::namespace('Motos')->group(function () {
        Route::resource('motos', 'MotosController');
    });

    Route::namespace('Travels')->group(function () {
        Route::resource('viajes', 'ViajesController');
    });
});