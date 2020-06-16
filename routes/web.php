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
    Route::get('generalites', 'ParametersController@index')->name('parameters');
    Route::get('plan-comptes-general', 'ParametersController@generalAccounts')->name('generalAccounts');
    Route::get('plan-compte-analytique', 'ParametersController@analyticAccounts')->name('analyticAccounts');
});

// API routes
Route::group(['prefix' => 'api'], function () {
    // Api\\Cerfa1Controller
    // endpoint : /api/cerfa1/...
    Route::group(['prefix' => 'cerfa1'], function () {
        Route::get('group/{Cerfa1Group}/lines', 'Api\\Cerfa1Controller@linesByGroup')->name('api.cerfa1.getLines');
        Route::get('groups', 'Api\\Cerfa1Controller@groups')->name('api.cerfa1.getGroups');
    });

    // Api\\GeneralAccountsController
    // endpoint : /api/generalAccounts/...
    Route::group(['prefix' => 'generalAccounts'], function () {
        Route::get('', 'Api\\GeneralAccountsController@index')->name('api.generalAccounts');
        Route::post('', 'Api\\GeneralAccountsController@store')->name('api.generalAccounts.store');
        Route::get('edit/{id}', 'Api\\GeneralAccountsController@edit')->name('api.generalAccounts.edit');
        Route::patch('update/{id}', 'Api\\GeneralAccountsController@update')->name('api.analyticAccounts.update');
        Route::delete('destroy/{generalAccount}', 'Api\\GeneralAccountsController@destroy')->name('api.generalAccounts.destroy');
        Route::post('activate', 'Api\\GeneralAccountsController@activate')->name('api.generalAccounts.activate');
        Route::post('desactivate', 'Api\\GeneralAccountsController@desactivate')->name('api.generalAccounts.desactivate');
        Route::post('affect', 'Api\\GeneralAccountsController@affect')->name('api.generalAccounts.affect');
    });

    // Api\\AnalyticAccountsController
    // endpoint : /api/analyticAccounts/...
    Route::group(['prefix' => 'analyticAccounts'], function () {
        Route::get('', 'Api\\AnalyticAccountsController@index')->name('api.analyticAccounts');
        Route::post('', 'Api\\AnalyticAccountsController@store')->name('api.analyticAccounts.store');
        Route::get('edit/{id}', 'Api\\AnalyticAccountsController@edit')->name('api.analyticAccounts.edit');
        Route::patch('update/{id}', 'Api\\AnalyticAccountsController@update')->name('api.analyticAccounts.update');
        Route::delete('destroy/{id}', 'Api\\AnalyticAccountsController@destroy')->name('api.analyticAccounts.destroy');
        Route::post('activate', 'Api\\AnalyticAccountsController@activate')->name('api.analyticAccounts.activate');
        Route::post('desactivate', 'Api\\AnalyticAccountsController@desactivate')->name('api.analyticAccounts.desactivate');
        Route::post('affect', 'Api\\AnalyticAccountsController@affect')->name('api.analyticAccounts.affect');
    });

    // Api\\SectorsController
    // endpoint : /api/sectors/...
    Route::group(['prefix' => 'sectors'], function () {
        Route::get('folder/{Folder}', 'Api\\SectorsController@sectorsByFolder')->name('api.sectors.byFolder');
    });

    // Api\\ServicesController
    // endpoint : /api/services/...
    Route::group(['prefix' => 'services'], function () {
        Route::get('sector/{Sector}', 'Api\\ServicesController@servicesBySector')->name('api.services.getServices');
    });

    // Api\\StructuresController
    // endpoint : /api/structures/...
    Route::group(['prefix' => 'structures'], function () {
        Route::get('', 'Api\\StructuresController@index')->name('api.structures');
    });

    // Api\\FoldersController
    // endpoint : /api/folders/...
    Route::group(['prefix' => 'folders'], function () {
        Route::get('', 'Api\\FoldersController@index')->name('api.folders');
    });
});
