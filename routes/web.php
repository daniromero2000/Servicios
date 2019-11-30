<?php
/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
    $sliders = collect([
        ['img' => 'tarjetaCreditoOportuya.jpg', 'texto' => '<p class="sliderPrincipal-textSlider">Obtén beneficios que otros no tienen con <br /> nuestra tarjeta de crédito Oportuya</p>', 'textoBoton' => 'Solicita tu tarjeta ya', 'title' => 'Tarjeta Oportuya', 'color' => '#1d84c3', 'position_text' => 'bottom', 'enlace' => '/oportuya'],
        ['img' => 'creditoMotos.jpg', 'texto' => '<h1 class="sliderPrincipal-titleSlider">Crédito <strong>Motos</strong></h1><p class="sliderPrincipal-textSlider">Te damos crédito para que pongas a rodar tus aventuras.</p>', 'textoBoton' => 'Obtener mi moto Ya', 'title' => 'Crédito Motos', 'color' => '#ec2d35', 'position_text' => 'left', 'enlace' => '/motos'],
        ['img' => 'creditoLibranza.jpg', 'texto' => '<h1 class="sliderPrincipal-titleSlider">Crédito <strong>Libranza</strong></h1><p class="sliderPrincipal-textSlider">¡Porque es momento de disfrutar la vida!</p>', 'textoBoton' => 'Solicitar crédito', 'title' => 'Crédito Libranza', 'color' => '#fdbf3c', 'position_text' => 'left', 'enlace' => 'libranza'],
        ['img' => 'seguros.jpg', 'texto' => '<p class="sliderPrincipal-textSlider">Asegura tu patrimonio y el bienestar <br /> de quienes están a tu lado</p>', 'textoBoton' => 'Asegúrate Ya', 'title' => 'Seguros', 'color' => '#2aace0', 'position_text' => 'bottom', 'enlace' => '/seguros']
    ]);

    return view('index')
        ->with('sliderPrincipal', $sliders->all());
})->name('start');

Route::get('/LIB_gracias_FRM', function () {
    return view('libranza.thankYouPage');
})->name('thankYouPageLibranza');

Route::get('/OP_gracias_FRM', function () {
    return view('oportuya.thankYouPage');
})->name('thankYouPageOportuya');

Route::get('/Employed', function () {
    return view('advance.pageEmployed');
})->name('pageEmployed');

Route::get('/UsuarioPendiente', function () {
    return view('advance.pageUserExist');
})->name('usuarioPendiente');

Route::get('/UsuarioMoroso', function () {
    return view('advance.pageUserDefault');
})->name('usuarioMoroso');

Route::get('/SG_gracias_FRM', function () {
    return view('seguros.thankYouPage');
})->name('thankYouPageSeguros');

Route::get('/MT_gracias_FRM', function () {
    return view('motos.thankYouPage');
})->name('thankYouPageMotos');

Route::get('/VJ_gracias_FRM', function () {
    return view('viajes.thankYouPage');
})->name('thankYouPageViajes');

Route::get('/AD_gracias_FRM', function () {
    return view('advance.thankYouPage');
})->name('thankYouPageAvance');

Route::get('/OPNTR_gracias_denied', 'Admin\OportuyaV2Controller@getPageDeniedTr');
Route::get('/OPNAL_gracias_denied', 'Admin\OportuyaV2Controller@getPageDeniedAl');
Route::get('/OPNSH_gracias_denied', 'Admin\OportuyaV2Controller@getPageDeniedSh');
Route::get('/OPN_gracias_denied', 'Admin\OportuyaV2Controller@getPageDenied')->name('pageDeniedLead');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...

if ($options['register'] ?? true) {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
if ($options['verify'] ?? false) {
    Route::emailVerification();
}

//Assessor Auth
Route::group(['prefix' => '/assessor/'], function () {
    Route::get('/dashboard', 'Admin\assessorsController@index')->name('assessors.dashboard');
    Route::get('/login', 'Assessor\LoginController@showLoginForm')->name('assessors.login');
    Route::post('/dashboard', 'Assessor\LoginController@login')->name('assessors.access');
    Route::post('/password/email', 'Assessor\ForgotPasswordController@sendResetLinkEmail')->name('assessors.password.email');
    Route::get('/password/reset', 'Assessor\ForgotPasswordController@showLinkRequestForm')->name('assessors.password.request');
    Route::post('/password/reset', 'Assessor\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Assessor\ResetPasswordController@showResetForm')->name('assessors.password.reset');
    Route::post('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('assessor.logout');
    Route::group(['prefix' => '/forms/'], function () {
        Route::get('crearCliente/', 'Admin\assessorsController@getFormVentaContado')->name('assessorsVentaContado');
        Route::get('analisis/', function () {
            return view('assessors.forms.analisis');
        })->name('assessorAnalisis');
    });
    Route::group(['prefix' => '/api/'], function () {
        Route::get('ventaContado/getInfoVentaContado', 'Admin\assessorsController@getInfoVentaContado');
        Route::get('ventaContado/getinfoLeadVentaContado/{CEDULA}', 'Admin\assessorsController@getinfoLeadVentaContado');
        Route::post('ventaContado/addVentaContado', 'Admin\assessorsController@store');
    });
    Route::get('/LaPipa/assesor', function () {
        return view('assessors.convenios.pipa');
    })->name('laPipa');
});

Route::get('/validateEmails', 'Admin\OportuyaV2Controller@validateEmail');

// All resource routes

Route::resource('pages', 'Admin\PageController');
Route::resource('oportuya', 'Admin\OportuyaV2Controller');
Route::resource('libranza', 'Admin\LibranzaController');

Route::resource('leads', 'Admin\LeadsController');


Route::resource('Nuestras-tiendas', 'Admin\ourStoresController');
Route::resource('oportuyaV2', 'Admin\OportuyaV2Controller');
Route::resource('faqs', 'Admin\FaqsController');
Route::resource('brands', 'Admin\BrandsController');
Route::resource('lines', 'Admin\LinesController');
Route::resource('profiles', 'Admin\ProfilesController');
Route::resource('products', 'Admin\ProductsController');
Route::get('preguntas-frecuentes', 'Admin\FaqsController@indexPublic')->name('preguntas.frecuentes');
Route::get('api/encryptText/{string}', 'Admin\OportuyaV2Controller@encrypt');
Route::get('api/libranza/liquidator/{maxAmount}/{quota}', 'Admin\LibranzaController@liquidator');
// Pasos solictud credito
Route::get('/step1', 'Admin\OportuyaV2Controller@step1')->name('step1Oportuya');
Route::get('/step2/{numIdentification}', 'Admin\OportuyaV2Controller@step2')->name('step2Oportuya');
Route::get('/step3/{numIdentification}', 'Admin\OportuyaV2Controller@step3')->name('step3Oportuya');
Route::get('api/oportuya/validationLead/{identificationNumber}', 'Admin\OportuyaV2Controller@validationLead');
Route::get('api/oportuya/getCode/{identificationNumber}/{celNumber}', 'Admin\OportuyaV2Controller@getCodeVerification');
Route::get('api/oportuya/verificationCode/{code}/{identificationNumber}', 'Admin\OportuyaV2Controller@verificationCode');
Route::get('api/oportuya/getNumLead/{identificationNumber}', 'Admin\OportuyaV2Controller@getNumLead');
Route::post('api/oportuya/validateFormConfronta', 'Admin\OportuyaV2Controller@validateFormConfronta');
// Pasos solictud cupo
Route::get('/avance/step1', 'Admin\OportuyaV2Controller@advanceStep1')->name('step1Avance');
Route::get('/avance/step2/{numIdentification}', 'Admin\OportuyaV2Controller@advanceStep2')->name('step2Avance');
Route::get('/avance/step3/{numIdentification}', 'Admin\OportuyaV2Controller@advanceStep3')->name('step3Avance');

/* Menu Items */
Route::get('/quienes-somos', function () {
    return view('menuItems.aboutUs');
})->name('aboutUs');

Route::get('/codigo-etica', function () {
    return view('menuItems.ethicsCode');
})->name('ethicsCode');

Route::get('/Proteccion-de-datos-personales', function () {
    return view('menuItems.personalInformation');
})->name('personalInformation');

Route::get('/Terminos-y-condiciones', function () {
    return view('menuItems.termsAndConditions');
})->name('termsAndConditions');

Route::get('/Cambios-devoluciones-y-atencion-de-garantias', function () {
    return view('menuItems.warranties');
})->name('warranties');

Route::get('/Por-que-comprar-con-nosotros', function () {
    return view('menuItems.buyWithUs');
})->name('buyWithUs');

Route::get('/googledd6db54bffdd55e4.html', function () {
    return view('autoridad.googledd6db54bffdd55e4');
})->name('termsAndConditions');

/* Admin Leads */
Route::get('api/leads/getComentsLeads/{idLead}', 'Admin\LeadsController@getComentsLeads');
Route::get('/api/leads/getFactoryRequestComments/{solicitud}', 'Admin\LeadsController@getFactoryRequestComments');

/* Apis */
Route::group(['prefix' => 'api/'], function () {
    // Oportuya paso a paso
    Route::get('oportuya/getDataStep1/', 'Admin\OportuyaV2Controller@getDataStep1');
    Route::get('oportuya/getContactData/{identificationNumber}', 'Admin\OportuyaV2Controller@getContactData');
    Route::get('oportuya/getDataStep2/{identificationNumber}', 'Admin\OportuyaV2Controller@getDataStep2');
    Route::get('oportuya/getDataStep3/{identificationNumber}', 'Admin\OportuyaV2Controller@getDataStep3');
    Route::get('oportuya/execConsultasLead/{identificationNumber}/{nomRefPer}/{telRefPer}/{nomRefFam}/{telRefFam}', 'Admin\OportuyaV2Controller@execConsultasleadAsesores');
    Route::get('oportuya/deniedLeadForFecExp/{identificationNumber}/{typeDenied}', 'Admin\OportuyaV2Controller@deniedLeadForFecExp');
    // Administrador de politicas de credito
    Route::post('AdminCreditPolicy/addCredit', 'Admin\CreditPolicyController@store');

    // Dashboard
    Route::get('dashBoard/getModules', 'Admin\DashboardController@getModulesDashboard');
});


/**
 **Proyecto: SERVICIOS FINANCIEROS
 **Caso de Uso: Administrador de leads - Canal dígital
 **Autor: Robert García
 **Email: desarrollo1@lagobo.com
 **Fecha: 6/12/2018
 **/

/*Community Leads Resource*/

Route::resource('communityleads', 'Admin\CommunityController');

/*Community Leads routes*/
Route::post('communityLeads/addCommunityLeads', 'Admin\LeadsController@addCommunityLeads');
Route::get('api/execCreditPolicy/{identificationNumber}', 'Admin\OportuyaV2Controller@execCreditPolicy');
Route::post('api/simulateCreditPolicy/', 'Admin\CreditPolicyController@simulateCreditPolicy');
Route::post('communityLeads/updateCommunityLeads', 'Admin\LeadsController@updateCommunityLeads');
Route::get('communityLeads/viewCommunityLeads/{idLead}', 'Admin\LeadsController@viewCommunityLeads');
Route::post('communityLeads/deleteCommunityLeads/{idLead}', 'Admin\LeadsController@deleteCommunityLeads');

/**
 **Proyecto: SERVICIOS FINANCIEROS
 **Caso de Uso: Administrador de campañas
 **Autor: Robert García
 **Email: desarrollo1@lagobo.com
 **Fecha: 13/12/2018
 **/

/*Campaign resource*/

Route::resource('campaign', 'Admin\CampaignController');

/*Community routes*/

Route::get('community/viewCampaign/{lead}', 'Admin\CampaignController@show');
Route::post('community/addCampaign', 'Admin\CampaignController@store')->middleware('cors');
Route::post('community/deleteCampaign', 'Admin\CampaignController@deleteCampaign')->middleware('cors');
Route::post('community/updateCampaign', 'Admin\CampaignController@update')->middleware('cors');
Route::post('community/addImage', 'Admin\CampaignController@storeImage')->middleware('cors');

Route::get('/community', function () {
    if (Auth::guest()) {
        return view('auth.login');
    }
    return view('campaign.index');
});

Route::group(['prefix' => '/community/', 'middleware' => 'auth'], function () {

    Route::get('/campaigns', function () {
        return view('campaign.campaign');
    });
});

Route::resource('customers', 'Assessor\ClientesController');

Route::get('/solicitudesAsessores', function () {
    return view('assessors.customers.index');
})->name('solicitudes.clientes');

Route::group(['prefix' => '/solicitudesAsessores/'], function () {
    //Route::get('/dataCustomer','Assessor\ClientesController@index');

    Route::get('/clientes', function () {
        return view('assessors.customers.customers');
    });
});


/**
 **Proyecto: SERVICIOS FINANCIEROS
 **Caso de Uso: Administrador de Usuarios
 **Autor: Robert García
 **Email: desarrollo1@lagobo.com
 **Fecha: 20/12/2018
 **/
Route::get('/api/canalDigital/checkLeadProcess/{idLead}', 'Admin\LeadsController@checkLeadProcess');

Route::resource('creditPolicy', 'Admin\CreditPolicyController');

Route::resource('users', 'Admin\UserController');

Route::group(['prefix' => '/adminUsers/', 'middleware' => 'auth'], function () {

    Route::get('/', function () {
        if (Auth::guest()) {
            return view('auth.login');
        }
        return view('users.index');
    });

    Route::get('/users', function () {
        return view('users.users');
    });
});
/*Assessors profile*/

Route::post('/profileAssessor', 'Admin\UserController@addAssessorProfile')->middleware('cors');
Route::get('/getAssessors', 'Admin\UserController@getAllAssessor');

// Administrator
Route::group(['prefix' => '/Administrator', 'middleware' => 'auth'], function () {
    Route::get('/crearCliente', 'Admin\assessorsController@getFormVentaContado')->name('assessorsVentaContado');
    Route::get('/analisis', function () {
        return view('assessors.forms.analisis');
    })->name('assessorAnalisis');

    Route::get("/libranzaLeads", function () {
        if (Auth::guest()) {
            return view('auth.login');
        }
        return view('libranzaLeads.index');
    });


    Route::group(['prefix' => '/libranzaLeads/', 'middleware' => 'auth'], function () {
        Route::get('/leads', function () {
            return view('libranzaLeads.leads');
        });
    });

    Route::group(['prefix' => '/simulador/'], function () {

        Route::get('/', 'Admin\SimulatorController@index');

        Route::get('/pagaduria', function () {
            return view('simulator.pagaduria.pagaduria');
        });
        Route::get('/parametros', function () {
            return view('simulator.parameters.parameters');
        });
    });


    // Módulo Catálogo
    Route::group(['prefix' => '/Catalog'], function () {
        Route::get("/", function () {
            return view('catalog.index');
        })->name('catalogo');

        Route::get("/Products", function () {
            return view('catalog.products.index');
        })->name('products');

        Route::get("/edtProduct", function () {
            return view('catalog.products.edt');
        })->name('productsEdt');

        Route::get("/Lines", function () {
            return view('catalog.lines.index');
        })->name('lines');

        Route::get("/Brands", function () {
            return view('catalog.brands.index');
        })->name('brands');

        //store products images
        Route::post('images', 'Admin\ProductsController@images');
        //update the images position
        Route::post('imagesUpdate', 'Admin\ProductsController@imagesUpdate');
        //delete products images
        Route::get('deleteImage/{id}', 'Admin\ProductsController@deleteImage');
    });

    // Gestion de Leads
    Route::group(['prefix' => '/canalDigital/', 'middleware' => 'auth'], function () {
        Route::get('/', function () {
            if (Auth::guest()) {
                return view('auth.login');
            }
            return view('leads.index');
        });
        Route::get('/leads', function () {
            return view('leads.leads');
        });
    });


    // Administrador de politicas de credito
    Route::group(['prefix' => '/AdminCreditPolicy'], function () {
        Route::get('/', function () {
            if (Auth::guest()) {
                return view('auth.login');
            }
            return view('creditPolicy.index');
        });

        Route::get('/creditPolicy', function () {
            return view('creditPolicy.creditPolicy');
        });

        Route::get('/edtCreditPolicy', function () {
            return view('creditPolicy.edt');
        });
    });
    // Dashboard
    Route::resource('dashboard', 'Admin\DashboardController')->except(['show']);

    // Administrador de usuarios
    Route::group(['prefix' => '/adminUsers/'], function () {
        Route::get('/', function () {
            if (Auth::guest()) {
                return view('auth.login');
            }
            return view('users.index');
        });

        Route::get('/users', function () {
            return view('users.users');
        });
    });

    // Administrador de preguntas frecuentes
    Route::group(['prefix' => '/preguntasFrecuentes/'], function () {

        Route::get("/", function () {
            return view('faqs.indexAngular');
        })->name("preguntasFrecuentes");

        Route::get('/admin', function () {
            return view('faqs.admin');
        });
    });

    // Administrador de perfiles
    Route::group(['prefix' => '/Profiles/'], function () {

        Route::get("/", function () {
            return view('profilesAdmin.index');
        });

        Route::get('/admin', function () {
            return view('profilesAdmin.admin');
        });
    });

    // Community leads
    Route::group(['prefix' => '/communityLeads/'], function () {

        Route::get("/", function () {
            if (Auth::guest()) {
                return view('auth.login');
            }
            return view('communityLeads.index');
        });

        Route::get('/leads', function () {
            return view('communityLeads.leads');
        });
    });

    // Administrador de modulos
    /*Route::resource('modules', 'Admin\ModulesController');
    Route::group(['prefix'=>'/Modules/'],function(){
        Route::get('/', function(){
            return view('modules.index');
        });

        Route::get('/Modules', function(){
            return view('modules.modules');
        });
    });*/

    // Administrador Lista de Empleados
    Route::group(['prefix' => '/ListaEmpleados'], function () {
        Route::get('/', function () {
            return view('listaEmpleados.index');
        });

        Route::get('/ListaEmpleados', function () {
            return view('listaEmpleados.listaEmpleados');
        });
    });
});

Route::resource('listaEmpleados', 'Admin\ListaEmpleadosController');

Route::resource('libranzaV2', 'Admin\LibranzaV2Controller');
Route::group(['prefix' => '/libranza'], function () {
    Route::get('/step1', 'Admin\LibranzaV2Controller@step1')->name('step1Libranza');
});

// Servicios Oportudata
Route::get('/api/oportudata/getCodeVerification/{identificationNumber}/{celNumber}', 'Admin\OportuyaV2Controller@getCodeVerificationOportudata');
Route::get('/api/oportudata/getCodeVerification/{identificationNumber}/{celNumber}/{type}', 'Admin\OportuyaV2Controller@getCodeVerificationOportudata');

// Campañas Marketing
Route::group(['prefix' => '/campaigns'], function () {
    Route::get('/experiencia-auteco', function () {
        return view('campaignsMarketing.campaignAuteco1');
    });

    Route::get('/renovacion-auteco', function () {
        return view('campaignsMarketing.campaignAuteco2');
    });
});

Route::get('/campaigns/auteco2');
include "web2.php";
include "web3.php";
