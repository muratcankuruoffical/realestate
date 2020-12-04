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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [\App\Http\Controllers\API\UserController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\API\UserController::class, 'login']);
    Route::get('/refresh', [\App\Http\Controllers\API\UserController::class, 'refresh']);
    Route::get('/logout', [\App\Http\Controllers\API\UserController::class, 'logout']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'appointment'
], function ($router) {
    Route::post('/add', [\App\Http\Controllers\API\AppointmentController::class, 'addAppointment']);
    Route::get('/list', [\App\Http\Controllers\API\AppointmentController::class, 'getAppointments']);
    Route::get('/get/{id}', [\App\Http\Controllers\API\AppointmentController::class, 'getAppointment']);
    Route::post('/{id}/update', [\App\Http\Controllers\API\AppointmentController::class, 'updateAppointment']);
});
