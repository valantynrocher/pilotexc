<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
    Route::get('', 'Api\\SectorsController@index')->name('api.sectors');
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

// Api\\FiscalYearsController
// endpoint : /api/fiscalYears/...
Route::group(['prefix' => 'fiscalYears'], function () {
    Route::get('', 'Api\\FiscalYearsController@index')->name('api.fiscalYears');
    Route::post('', 'Api\\FiscalYearsController@store')->name('api.fiscalYears.store');
    Route::get('edit/{id}', 'Api\\FiscalYearsController@edit')->name('api.fiscalYears.edit');
    Route::patch('update/{id}', 'Api\\FiscalYearsController@update')->name('api.fiscalYears.update');
    Route::get('inProgress', 'Api\\FiscalYearsController@getInProgress')->name('api.fiscalYears.inProgress');
    Route::get('getLastFive', 'Api\\FiscalYearsController@getLastFive')->name('api.fiscalYears.getLastFive');
});

// Api\\ScripturesController
// endpoint: /api/scriptures/...
Route::group(['prefix' => 'scriptures'], function () {
    Route::get('', 'Api\\ScripturesController@index')->name('api.scriptures');
    Route::get('countExistingScriptures/{fiscalYear}', 'Api\\ScripturesController@countExistingScriptures')->name('api.scriptures.countExistingScriptures');
    Route::post('checkImportAmount', 'Api\\ScripturesController@checkImportAmount')->name('api.scriptures.checkImportAmount');
    Route::get('truncateTempScriptures', 'Api\\ScripturesController@truncateTempScriptures')->name('api.scriptures.truncateTempScriptures');
    Route::post('import', 'Api\\ScripturesController@import')->name('api.scriptures.import');
});

// Api\\ReportsController
// endpoint: /api/reports/...
Route::group(['prefix' => 'reports'], function () {
    Route::get('analyticalEvolutionChart/sector/{sector}', 'Api\\ReportsController@analyticalEvolutionChart')->name('api.reports.analyticalEvolutionChart');
    Route::get('productsDivisionChart/fiscalYear/{fiscalYear}', 'Api\\ReportsController@productsDivisionChart')->name('api.reports.productsDivisionChart');
    Route::get('chargesDivisionChart/fiscalYear/{fiscalYear}', 'Api\\ReportsController@chargesDivisionChart')->name('api.reports.chargesDivisionChart');
    Route::get('analyticalSectorDivisionChart/fiscalYear/{fiscalYear}', 'Api\\ReportsController@analyticalSectorDivisionChart')->name('api.reports.analyticalSectorDivisionChart');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page introuvable. Si l\'erreur persiste, contactez le support Pilotexc.'], 404);
    });
