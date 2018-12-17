<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/

Route::get('/', function () {

	$sliders = collect([

		['img' => 'tarjetaCreditoOportuya.jpg', 'texto' => '<p class="sliderPrincipal-textSlider">Obtén beneficios que otros no tienen con <br /> nuestra tarjeta de crédito Oportuya</p>', 'textoBoton' => 'Solicita tu tarjeta ya', 'title' => 'Tarjeta Oportuya','color' => '#1d84c3', 'position_text' => 'bottom', 'enlace' => '/oportuya'],

		['img' => 'creditoMotos.jpg', 'texto' => '<h1 class="sliderPrincipal-titleSlider">Crédito <strong>Motos</strong></h1><p class="sliderPrincipal-textSlider">Te damos crédito para que pongas a rodar tus aventuras.</p>', 'textoBoton' => 'Obtener mi moto Ya', 'title' => 'Crédito Motos','color' => '#ec2d35', 'position_text' => 'left', 'enlace' => '/motos'],

		['img' => 'creditoLibranza.jpg', 'texto' => '<h1 class="sliderPrincipal-titleSlider">Crédito <strong>Libranza</strong></h1><p class="sliderPrincipal-textSlider">¡Porque es momento de disfrutar la vida!</p>', 'textoBoton' => 'Solicitar crédito', 'title' => 'Crédito Libranza','color' => '#fdbf3c', 'position_text' => 'left', 'enlace' => 'libranza'],

		['img' => 'seguros.jpg', 'texto' => '<p class="sliderPrincipal-textSlider">Asegura tu patrimonio y el bienestar <br /> de quienes están a tu lado</p>', 'textoBoton' => 'Asegúrate Ya', 'title' => 'Seguros','color' => '#2aace0', 'position_text' => 'bottom', 'enlace' => '/seguros']

	]);

    return view('index')
    		->with('sliderPrincipal', $sliders->all());
});

Route::get('/LIB_gracias_FRM', function(){
	return view('libranza.thankYouPage');
})->name('thankYouPageLibranza');

Route::get('/OP_gracias_FRM',function(){
	return view('oportuya.thankYouPage');
})->name('thankYouPageOportuya');

Route::get('/SG_gracias_FRM',function(){
	return view('seguros.thankYouPage');
})->name('thankYouPageSeguros');

Route::get('/MT_gracias_FRM',function(){
	return view('motos.thankYouPage');
})->name('thankYouPageMotos');

Route::get('/VJ_gracias_FRM',function(){
	return view('viajes.thankYouPage');
})->name('thankYouPageViajes');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

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

Route::group(['prefix'=>'/assessor/'],function(){

	Route::get('/dashboard','Admin\assessorsController@index');
	Route::get('/login','Assessor\LoginController@showLoginForm')->name('assessors.login');
	Route::post('/dashboard','Assessor\LoginController@login')->name('assessors.access');
	Route::post('/password/email','Assessor\ForgotPasswordController@sendResetLinkEmail')->name('assessors.password.email');
	Route::get('/password/reset','Assessor\ForgotPasswordController@showLinkRequestForm')->name('assessors.password.request');
	Route::post('/password/reset','Assessor\ResetPasswordController@reset');
	Route::get('/password/reset/{token}','Assessor\ResetPasswordController@showResetForm')->name('assessors.password.reset');
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::get('/step1', 'Admin\assessorsController@step1')->name('step1Assessor')->middleware(['auth:assessor']);
    
});





Route::get('/home', 'HomeController@index')->name('home');
Route::resource('pages','Admin\PageController');
Route::resource('oportuya','Admin\OportuyaV2Controller');
Route::resource('libranza','Admin\LibranzaController');
Route::resource('motos','Admin\MotosController');
Route::resource('leads','Admin\LeadsController');
Route::resource('seguros','Admin\SegurosController');
Route::resource('viajes','Admin\ViajesController');
Route::resource('dashboard','Admin\DashboardController');
Route::resource('users','Admin\UserController');
Route::resource('campaign','Admin\CampaignController');
Route::resource('Nuestras-tiendas','Admin\ourStoresController');
Route::resource('communityleads','Admin\CommunityController');
Route::resource('oportuyaV2','Admin\OportuyaV2Controller');
Route::resource('faqs','Admin\FaqsController');
Route::resource('brands','Admin\BrandsController');

Route::get('preguntas-frecuentes','Admin\FaqsController@indexPublic')->name('preguntas.frecuentes');

Route::get('api/encryptText/{string}','Admin\OportuyaV2Controller@encrypt');


Route::get('api/libranza/liquidator/{maxAmount}/{quota}', 'Admin\LibranzaController@liquidator');

// Pasos solictud credito


Route::get('/step1', 'Admin\OportuyaV2Controller@step1')->name('step1Oportuya');
Route::get('/step2/{numIdentification}', 'Admin\OportuyaV2Controller@step2')->name('step2Oportuya');
Route::get('/step3/{numIdentification}', 'Admin\OportuyaV2Controller@step3')->name('step3Oportuya');


/* Menu Items */
Route::get('/quienes-somos', function(){
	return view('menuItems.aboutUs');
})->name('aboutUs');

Route::get('/codigo-etica', function(){
	return view('menuItems.ethicsCode');
})->name('ethicsCode');

Route::get('/Proteccion-de-datos-personales', function(){
	return view('menuItems.personalInformation');
})->name('personalInformation');

Route::get('/Terminos-y-condiciones', function(){
	return view('menuItems.termsAndConditions');
})->name('termsAndConditions');

Route::get('/Cambios-devoluciones-y-atencion-de-garantias', function(){
	return view('menuItems.warranties');
})->name('warranties');

Route::get('/Por-que-comprar-con-nosotros', function(){
	return view('menuItems.buyWithUs');
})->name('buyWithUs');



Route::get('/googledd6db54bffdd55e4.html', function(){
	return view('autoridad.googledd6db54bffdd55e4');
})->name('termsAndConditions');

/* Admin Leads */
Route::get('api/leads/addComent/{idLead}/{comment}', 'Admin\LeadsController@addComent');
Route::get('api/leads/getComentsLeads/{idLead}', 'Admin\LeadsController@getComentsLeads');
Route::get('api/leads/cahngeStateLead/{idLead}/{comment}/{state}', 'Admin\LeadsController@cahngeStateLead');

/*Community routes*/
Route::get('community/viewCampaign/{lead}','Admin\CampaignController@show');
Route::post('community/addCampaign','Admin\CampaignController@store')->middleware('cors');
Route::post('community/deleteCampaign','Admin\CampaignController@deleteCampaign')->middleware('cors');
Route::post('community/updateCampaign','Admin\CampaignController@update')->middleware('cors');

/*Community Leads routes*/
Route::post('communityLeads/addCommunityLeads','Admin\LeadsController@addCommunityLeads');
Route::post('communityLeads/updateCommunityLeads','Admin\LeadsController@updateCommunityLeads');
Route::get('communityLeads/viewCommunityLeads/{idLead}','Admin\LeadsController@viewCommunityLeads');
Route::post('communityLeads/deleteCommunityLeads/{idLead}','Admin\LeadsController@deleteCommunityLeads');
//Route::get('communityLeads/viewCommunityLeads','Admin\CommunityController@index');


/* Apis */
Route::get('api/oportuya/getDataStep2/{identificationNumber}', 'Admin\OportuyaV2Controller@getDataStep2');
Route::get('api/oportuya/getDataStep3/{identificationNumber}', 'Admin\OportuyaV2Controller@getDataStep3');



Route::get("/canalDigital",function(){
	return view('leads.index');
});

Route::get("/communityLeads",function(){
	return view('communityLeads.index');
});

Route::get('/community',function(){
		return view('campaign.index');
	});

Route::get("/libranzaLeads",function(){
	return view('libranzaLeads.index');
});

Route::get("/fabricaLeads",function(){
	return view('fabricaLeads.index');
});


Route::group(['prefix'=>'/canalDigital/','middleware' => 'auth'],function(){

    Route::get('/leads', function(){
        return view('leads.leads');
    });
});

Route::group(['prefix'=>'/libranzaLeads/','middleware' => 'auth'],function(){

    Route::get('/leads', function(){
        return view('libranzaLeads.leads');
    });
});

Route::group(['prefix'=>'/fabricaLeads/','middleware' => 'auth'],function(){

    Route::get('/leads', function(){
        return view('fabricaLeads.leads');
    });
});


Route::group(['prefix'=>'/communityLeads/','middleware'=>'auth'],function(){

	Route::get('/leads',function(){
		return view('communityLeads.leads');
	});

});


Route::group(['prefix'=>'/community/','middleware' => 'auth'],function(){

    Route::get('/campaigns', function(){
        return view('campaign.campaign');
    });
});

Route::group(['prefix'=>'/preguntasFrecuentes/','middleware' => 'auth'],function(){

	Route::get("/",function(){
		return view('faqs.indexAngular');
	});

    Route::get('/admin', function(){
        return view('faqs.admin');
    });
});



Route::group(['prefix'=>'/Products/'],function(){

	Route::get("/",function(){
		return view('products.index');
	})->name('products');

    Route::get('/admin', function(){
        return view('products.admin');
    });
});

