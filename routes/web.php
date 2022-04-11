<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Masters\AgeRangeController;
use App\Http\Controllers\Transactions\CitizenController;
use App\Models\Masters\ageRange;

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

Route::get('/',[CitizenController::class, 'index'])->middleware('auth');


//jika penggunaan resource, path harus lengkap
Route::resource("profiles", "App\Http\Controllers\ProfileController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("citizens", "App\Http\Controllers\Transactions\CitizenController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("users", "App\Http\Controllers\UserController")->middleware('auth');

Route::resource("rw", "App\Http\Controllers\Masters\RWController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("rt", "App\Http\Controllers\Masters\RTController")->middleware('auth');

Route::resource('information', "App\Http\Controllers\InformationController")->middleware('auth');

Route::resource("assistance", "App\Http\Controllers\Masters\AssistanceController")->middleware('auth');

Route::resource('log', LogController::class)->middleware('auth');

Route::resource('agerange', "App\Http\Controllers\Masters\AgeRangeController")->middleware('auth');
// Route::resource('ageRange', AgeRangeController::class)->middleware('auth');


Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('citizens-export', [CitizenController::class, 'export'])->name('citizens.export');

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index')->name('users.index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

//export route
Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportCitizen", "App\Http\Controllers\Transactions\CitizenController@exportCitizen")->name('exportCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportFamilyCitizen", "App\Http\Controllers\Transactions\CitizenController@exportFamilyCitizen")->name('exportFamilyCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportMoveCitizen", "App\Http\Controllers\Transactions\CitizenController@exportMoveCitizen")->name('exportMoveCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportDeathCitizen", "App\Http\Controllers\Transactions\CitizenController@exportDeathCitizen")->name('exportDeathCitizen');
});


Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportDTKSCitizen", "App\Http\Controllers\Transactions\CitizenController@exportDtksCitizen")->name('exportDtksCitizen');
});

//import route
Route::post('/citizens/import', 'App\Http\Controllers\Transactions\CitizenController@importCitizen')->name('citizens.import');
// Route::get('/citizens/{citizens:uuid}', [CitizenController::class, 'deathCheck'])->middleware('auth');

Route::get('/family',[CitizenController::class, 'familyCitizens'])->middleware('auth');


Route::get('/dtks',[CitizenController::class, 'citizendtks'])->middleware('auth');
Route::get('/dtks/{citizens:uuid}', [CitizenController::class, 'rollBackDtks'])->middleware('auth');

Route::get('/move',[CitizenController::class, 'moveCitizens'])->middleware('auth');
Route::get('/move/{citizens:uuid}', [CitizenController::class, 'rollBackMoveDate'])->middleware('auth');
// Route::get('/citizens/{citizens:uuid}', [CitizenController::class, 'moveUpdateCitizen'])->name('citizens.moveUpdateCitizen')->middleware('auth');
// Route::post('/citizens/{citizens:uuid}', 'App\Http\Controllers\Transactions\CitizenController@moveUpdateCitizen')->name('citizens.moveUpdateCitizen');

Route::get('/death',[CitizenController::class, 'deathCitizens'])->middleware('auth');
Route::get('/death/{citizens:uuid}', [CitizenController::class, 'rollBackDeathDate'])->middleware('auth');

// Route::get('/ageRange',[AgeRangeController::class, 'index'])->middleware('auth');

