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
    Route::post('/appointment/add', [\App\Http\Controllers\API\AppointmentController::class, 'addAppointment']);
    Route::get('/appointment/list', [\App\Http\Controllers\API\AppointmentController::class, 'getAppointments']);
    Route::get('/appointment/get/{id}', [\App\Http\Controllers\API\AppointmentController::class, 'getAppointment']);
    Route::post('/appointment/{id}/update', [\App\Http\Controllers\API\AppointmentController::class, 'updateAppointment']);
});
