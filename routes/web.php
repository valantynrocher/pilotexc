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

// Redirect for root path
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Auth::routes();

Route::get('tableau-de-bord', 'DashboardController@index')->name('dashboard.index');

Route::get('utilisateurs', 'UsersController@index')->name('users.index');

// Attention : les changements d'URL sur ces routes pètent les appels Ajax
Route::get('comptabilite-analytique', 'AnalyticAccountsController@index')->name('analyticAccounts.index');
Route::post('comptabilite-analytique', 'AnalyticAccountsController@store')->name('analyticAccounts.store');
Route::patch('comptabilite-analytique/edit/{id}', 'AnalyticAccountsController@update')->name('analyticAccounts.update');
Route::post('comptabilite-analytique/activate', 'AnalyticAccountsController@activate')->name('analyticAccounts.activate');
Route::post('comptabilite-analytique/desactivate', 'AnalyticAccountsController@desactivate')->name('analyticAccounts.desactivate');
// Attention : les changements d'URL sur ces routes pètent les appels Ajax
Route::get('comptabilite-generale', 'GeneralAccountsController@index')->name('generalAccounts.index');
Route::post('comptabilite-generale', 'GeneralAccountsController@store')->name('generalAccounts.store');
Route::patch('comptabilite-generale/edit/{id}', 'GeneralAccountsController@update')->name('generalAccounts.update');
Route::post('comptabilite-generale/activate', 'GeneralAccountsController@activate')->name('generalAccounts.activate');
Route::post('comptabilite-generale/desactivate', 'GeneralAccountsController@desactivate')->name('generalAccounts.desactivate');


Route::get('paramètres', 'ParametersController@index')->name('parameters.index');

Route::get('ecritures', 'ScripturesController@index')->name('scriptures.index');

