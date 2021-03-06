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

Route::controllers([
	'validacion' => 'Validacion\ValidacionController',
	'validado/fotos' => 'FotoController',
	'validado/albums' => 'AlbumController',
	'validado/usuario' => 'usuarioController',
	'validado' => 'InicioController',
	'/' => 'BienvenidaController'
]);
