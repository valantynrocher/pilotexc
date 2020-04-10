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
    return redirect()->route('app.dashboard.index');
});

Auth::routes();

Route::get('/tableau-de-bord', 'PilotexcApp\DashboardController@index')->name('app.dashboard.index');

Route::get('/utilisateurs', 'PilotexcApp\UsersController@index')->name('app.users.index');

Route::get('/ecritures', 'PilotexcApp\ScripturesController@index')->name('app.scriptures.index');

Route::get('/paramètres', 'PilotexcApp\ParametersController@index')->name('app.parameters.index');
Route::post('/paramètres/import-comptabilite-analytique', 'PilotexcApp\ParametersController@analyticImport')->name('app.parameters.analytic.import');

// Route::namespace('PilotexcApp')->prefix('app')->name('app.')->group(function () {

// });

// Route::namespace('PilotexcAdmin')->prefix('admin')->name('admin.')->group(function () {

// });
