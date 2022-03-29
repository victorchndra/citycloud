<?php

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

Route::get('/', function () {
    return view('home');
});


//jika penggunaan resource, path harus lengkap
Route::resource("citizens", "App\Http\Controllers\Transactions\CitizenController");

//jika penggunaan resource, path harus lengkap
Route::resource("users", "App\Http\Controllers\UserController");

//jika penggunaan resource, path harus lengkap
Route::resource("assistance", "App\Http\Controllers\AssistanceController");