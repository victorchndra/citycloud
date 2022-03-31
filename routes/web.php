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

Route::get('/', function () {
    return view('home');
});

Route::get('/',[CitizenController::class, 'index'])->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("citizens", "App\Http\Controllers\Transactions\CitizenController");

//jika penggunaan resource, path harus lengkap
Route::resource("users", "App\Http\Controllers\UserController");

Route::resource("rw", "App\Http\Controllers\Masters\RWController");

//jika penggunaan resource, path harus lengkap
Route::resource("rt", "App\Http\Controllers\Masters\RTController");

Route::resource("assistance", "App\Http\Controllers\Masters\AssistanceController");

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

// cek route jika blank pas export exel diroute nya bermaslaah
Route::controller(CitizenController::class)->group(function(){
    Route::get('citizens', 'index');
    Route::get('citizens-export', 'export')->name('citizens.export');
});

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});