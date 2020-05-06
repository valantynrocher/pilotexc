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
Route::get('render-data/{id}', 'DashboardController@renderChart')->name('dashboard.renderChart');
Route::get('chart-data/{id}', 'DashboardController@chartApi')->name('dashboard.chartApi');

Route::get('utilisateurs', 'UsersController@index')->name('users.index');

// Attention : les changements d'URL sur ces routes pètent les appels Ajax
Route::get('comptabilite-analytique', 'AnalyticAccountsController@index')->name('analyticAccounts.index');
Route::post('comptabilite-analytique', 'AnalyticAccountsController@store')->name('analyticAccounts.store');
Route::patch('comptabilite-analytique/edit/{id}', 'AnalyticAccountsController@update')->name('analyticAccounts.update');
Route::delete('comptabilite-analytique/destroy/{id}', 'AnalyticAccountsController@destroy')->name('analyticAccounts.destroy');
Route::post('comptabilite-analytique/affect', 'AnalyticAccountsController@affect')->name('analyticAccounts.affect');
Route::post('comptabilite-analytique/activate', 'AnalyticAccountsController@activate')->name('analyticAccounts.activate');
Route::post('comptabilite-analytique/desactivate', 'AnalyticAccountsController@desactivate')->name('analyticAccounts.desactivate');
Route::get('getSectors', 'AnalyticAccountsController@getSectors')->name('analyticAccounts.getSectors');
Route::get('getServices', 'AnalyticAccountsController@getServices')->name('analyticAccounts.getServices');

// Attention : les changements d'URL sur ces routes pètent les appels Ajax
Route::get('comptabilite-generale', 'GeneralAccountsController@index')->name('generalAccounts.index');
Route::post('comptabilite-generale', 'GeneralAccountsController@store')->name('generalAccounts.store');
Route::patch('comptabilite-generale/edit/{id}', 'GeneralAccountsController@update')->name('generalAccounts.update');
Route::delete('comptabilite-generale/destroy/{id}', 'GeneralAccountsController@destroy')->name('generalAccounts.destroy');
Route::post('comptabilite-generale/affect', 'GeneralAccountsController@affect')->name('generalAccounts.affect');
Route::post('comptabilite-generale/activate', 'GeneralAccountsController@activate')->name('generalAccounts.activate');
Route::post('comptabilite-generale/desactivate', 'GeneralAccountsController@desactivate')->name('generalAccounts.desactivate');
Route::get('getCerfa1Lines', 'GeneralAccountsController@getCerfa1Lines')->name('generalAccounts.getCerfa1Lines');


Route::get('paramètres', 'ParametersController@index')->name('parameters.index');
Route::post('storeFiscalYear', 'ParametersController@storeFiscalYear')->name('parameters.storeFiscalYear');

Route::get('ecritures', 'ScripturesController@index')->name('scriptures.index');
Route::get('import', 'ScripturesController@import')->name('scriptures.import');

