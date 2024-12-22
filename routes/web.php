<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DHTController;
use App\Http\Controllers\HujanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('api-sensor', ApiController::class);
Route::resource('dht-sensor', DHTController::class);
Route::resource('hujan-sensor',HujanController::class);