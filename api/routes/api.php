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

Route::prefix('/v1')->group(function() {
    Route::post('/authenticate', 'AuthController@authenticate');

    Route::get('/sms', 'SmsController@home');

    Route::middleware('auth:sanctum')->group(function() {
        Route::prefix('transfer')->group(function() {
            Route::post('/initiate', 'TransferController@initiateTransfer');
            Route::post('finalize', 'TransferController@finalize');
            Route::post('/send', 'TransferController@transfer');
        });

        Route::prefix('sms')->group(function() {
            Route::post('/send', 'SmsController@send');
        });
    });

});
