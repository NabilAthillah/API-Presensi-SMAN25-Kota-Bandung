<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function() {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/login/parent', 'loginParent');
    });
});

Route::prefix('data')->group(function() {
    Route::prefix('get')->group(function() {
        Route::controller(DataController::class)->group(function () {
            Route::post('/user', 'getUser');
        });
    });
    
    Route::prefix('store')->group(function() {
        Route::controller(DataController::class)->group(function () {
            Route::post('/student', 'setStudent');
        });
    });
});