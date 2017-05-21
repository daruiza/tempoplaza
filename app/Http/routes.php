<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
	'uses' => 'WelcomeController@index',
	'as' => 'home'
]);

Route::get('ingreso',[
	'uses' => 'Auth\LoginController@getLogin',
	'as' => 'keylogin'
]);
Route::get('registro',[
	'uses' => 'Auth\RegisterController@getRegistry',
	'as' => 'registry'
]);
Route::get('recuperarcontraseña',[
	'uses' => 'Auth\LoginController@getRecoverPassword',
	'as' => 'recoverpasword'
]);
Route::get('recuperarcontraseñaemail/{user}/{psw}',[
	'uses' => 'Auth\LoginController@getRecoverPasswordEmail',
	'as' => 'recoverpaswordemail'
]);
Route::get('cambiarcontraseña/',[
	'uses' => 'Auth\LoginController@getChangePassword',
	'as' => 'changepasword'
]);

Route::get('modal/{data}/{metadata}',[
	'uses' => 'WelcomeController@getModal',
	'as' => 'modal'
]);

Route::get('/{data}',[
	'uses' => 'WelcomeController@getFind',
	'as' => 'search'
]);

Route::group(['middleware' => 'guest'], function () {
	
	Route::get('salida/{id}',[
		'uses' => 'Auth\LoginController@getLogout',
		'as' => 'keylogout'
	]);
	Route::get('perfil/{id}',[
		'uses' => 'Security\UserController@getPerfil',
		'as' => 'userperfil'
	]);
	//debe ser post para que pueda reconocer las imagenes
	Route::post('editarperfil',[
		'uses' => 'Security\UserController@postEditarPerfil',
		'as' => 'editperfil'
	]);
	
	Route::get('buzon/{id}',[
		'uses' => 'Security\UserController@getBuzon',
		'as' => 'UserMailBox'
	]); 

});

Route::controllers([
	//'auth' => 'Auth\AuthController',
	'user' => 'Security\UserController',
	//'usuario' => 'Security\UsuarioController',
	//'rol' => 'Security\RolController',
	//'aplicacion' => 'Security\AplicacionController',
	//'modulo' => 'Security\ModuloController',
	//'opcion' => 'Security\OpcionController',
	//'permiso' => 'Security\PermisoController'	
	'mistiendas' => 'ComprarJuntos\StoreController',
	'welcome' => 'WelcomeController',
	
]);


