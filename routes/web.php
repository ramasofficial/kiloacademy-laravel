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
    return view('welcome');
});

Route::get('/test', App\Http\Controllers\TestController::class);
Route::get('/scrap', App\Http\Controllers\ScrapController::class);

Route::get('/csharp', App\Http\Controllers\CSharpController::class);
