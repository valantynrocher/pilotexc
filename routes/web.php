<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Redirection
Route::permanentRedirect('/', '/tableau-de-bord');
Route::permanentRedirect('/home', '/tableau-de-bord');

// Authentication
Auth::routes();

// Views routes
Route::get('tableau-de-bord', 'DashboardController@index')->name('dashboard');
Route::get('ecritures', 'ScripturesController@index')->name('scriptures');
Route::group(['prefix' => 'parametres'], function () {
    Route::redirect('', 'parametres/exercices-comptables');
    Route::get('exercices-comptables', 'ParametersController@fiscalYears')->name('parameters.fiscalYears');
    Route::get('plan-comptes-general', 'ParametersController@generalAccounts')->name('parameters.generalAccounts');
    Route::get('plan-compte-analytique', 'ParametersController@analyticAccounts')->name('parameters.analyticAccounts');
});
