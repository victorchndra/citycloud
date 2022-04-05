<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Transactions\CitizenController;
use App\Http\Controllers\UserController;

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
Route::resource("citizens", "App\Http\Controllers\Transactions\CitizenController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("users", "App\Http\Controllers\UserController")->middleware('auth');

Route::resource("rw", "App\Http\Controllers\Masters\RWController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("rt", "App\Http\Controllers\Masters\RTController")->middleware('auth');

Route::resource("assistance", "App\Http\Controllers\Masters\AssistanceController")->middleware('auth');

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
    Route::get("exportMoveCitizen", "App\Http\Controllers\Transactions\CitizenController@exportMoveCitizen")->name('exportMoveCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportDTKSCitizen", "App\Http\Controllers\Transactions\CitizenController@exportDtksCitizen")->name('exportDtksCitizen');
});

//import route
Route::post('/citizens/import', 'App\Http\Controllers\Transactions\CitizenController@importCitizen')->name('citizens.import');

Route::get('/move',[CitizenController::class, 'moveCitizens'])->middleware('auth');

Route::get('/citizendtks',[CitizenController::class, 'citizendtks'])->middleware('auth');


