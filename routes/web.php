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

/*---------- RUTAS DE LOGIN ----------------*/
Route::get('/', function () {
  return view('login');
})->name('login');

Route::get('/registrate', function () {
  return view('register');
})->name('users.registrar');


//password reset
Route::get('/pass/reset','ResetController@index')->name('reset.index');
Route::post('/pass/resetsend','ResetController@reset')->name('reset.send');
Route::get('/pass/reset/{token}','ResetController@change')->name('reset.url');
Route::post('/pass/reset','ResetController@reset_password')->name('password.update');

Route::post('/users/invitation','UserController@store_invitacion')->name('users.storeInivitation');

Route::get('/register/partner/{id}','UserController@invitation')->name('users.invitar');

Route::get('/users/{token}/{id}/register','UserController@invitar')->name('users.invitar');

Route::post('/users/register','UserController@register')->name('users.regist');

Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');


/* Actas */
Route::resource('/actas','ActasController',['except' => ['store']]);
Route::get('actas/pdf/{id}','ActasController@pdf')->name('actas.pdf');
Route::get('actas/firma/{id}','ActasController@firma')->name('actas.firma');
Route::post('/actas/signature','ActasController@firmaSend')->name('actas.send');
Route::post('/invitacion','ActasController@invitacion')->name('actas.invitacion');


Route::group(['middleware' => 'auth'], function() { //middleware auth
  /* ---- Ruta para llamar al dashboard , modificarla si es necesario ----- */
	Route::get('dashboard', 'LoginController@index')->name('dashboard');
	/* --- Usuarios ---*/
	Route::resource('/users','UserController');

	/* -- ayudas --*/
	Route::resource('/ayudas','AyudasController');
	Route::get('/faq','AyudasController@viwers')->name('ayudas.viwers');

	
	//* --- Perfil --- */
	Route::get('/perfil', 'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');

	/* Empresas */
	Route::resource('/empresas','EmpresasController');
	Route::post('empresas/sendmail','UserController@sendEmail')->name('empresas.mail');

	/* Proveedores */
	Route::resource('/clientes','ClientesController');
	Route::post('/updatecliente','ClientesController@update_status')->name('update.cliente');

	/* actas*/
	Route::resource('/actas','ActasController');
	Route::get('actas/sign/{id}','ActasController@signature')->name('actas.sign');

	/* Planes */
	Route::resource('/planes','PlanesController');


	/* Guia Despacho */
	Route::resource('/guiadespacho','GuiaDespachoController');
	Route::post('/guiaDespacho/empresa','GuiaDespachoController@empresa')->name('guiadespacho.empresa');
	Route::get('/guiad/pdf/{id}','GuiaDespachoController@pdf')->name('guiadespacho.pdf');
	Route::post('/mail/guiad','GuiaDespachoController@sendEmail')->name('guiadespacho.mail');

	/* Guia Entrega*/
	Route::resource('/guiaentrega','GuiaEntregaController');
	Route::post('/guiaEnrega/empresa','GuiaEntregaController@empresa')->name('guiaentrega.empresa');
	Route::get('/guiae/pdf/{id}','GuiaEntregaController@pdf')->name('guiaentrega.pdf');
	Route::post('/mail/guiae','GuiaEntregaController@sendEmail')->name('guiaentrega.mail');

	/* Recibo De Gastos */
	Route::resource('/recibogastos','ReciboGastosController');
	Route::get('/recibog/pdf/{id}','ReciboGastosController@pdf')->name('recibogastos.pdf');
	Route::post('/mail/recibog','ReciboGastosController@sendEmail')->name('recibogastos.mail');

	
});

	
