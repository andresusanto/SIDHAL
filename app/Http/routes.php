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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');


Route::controllers([
    'pejabat' => 'PejabatController',
	'entry' => 'EntryController',
	'report' => 'ReportController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'rapat' => 'DaftarRapatController',
	'editRapat' => 'EditRapatController',
	'kehadiran' => 'KehadiranController',
	'user' => 'UserController',
	'instansi' => 'InstansiController',
]);
