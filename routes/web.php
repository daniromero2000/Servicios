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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('pages','Admin\PageController');
Route::resource('oportuya','Admin\OportuyaController');
Route::resource('libranza','Admin\LibranzaController');
Route::resource('motos','Admin\MotosController');
Route::resource('leads','Admin\LeadsController');
Route::resource('seguros','Admin\SegurosController');
Route::resource('viajes','Admin\ViajesController');
Route::resource('dashboard','Admin\DashboardController');
Route::resource('users','Admin\UserController');

Route::get('api/libranza/liquidator/{maxAmount}/{quota}', 'Admin\LibranzaController@liquidator');

Route::get("/canalDigital",function(){
	return view('leads.index');
});

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
Route::post('api/leads/addComent', 'Admin\LeadsController@addComent');
Route::group(array('prefix'=>'/canalDigital/'),function(){

    Route::get('/leads', function(){
        return view('leads.leads');
    });
});