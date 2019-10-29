<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
if (Session::has('locale')) App::setLocale(Session::get('locale'));

//RUTA INDEX
Route::get('/','IndexController@getIndex');


	//Ruta de pagina de inicio
	Route::get('inicio', array('as' => 'inicio', 'uses' => 'InicioController@Inicio'));

	//Ruta para salir del sistema
	Route::get('exit', array('as' => 'exit', 'uses' => 'ExitController@getExit'));

	Route::controller('comercial', 'ComercialController');

//});
