<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'V1'], function () {

    //=================Authentification======================
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);


    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);


        //=================Games======================
        Route::apiResource('games', GameController::class)->except('update');
        Route::post('games/{id}', [GameController::class, 'update']);

        //=================Servers======================
        Route::apiResource('servers', ServerController::class)->except('update');
        Route::post('servers/{id}', [ServerController::class, 'update']);

        //==============Counts====================
        Route::get('countOfGames', [GameController::class, 'count']);
        Route::get('countOfUsers', [UserController::class, 'count']);
        Route::get('countOfServers', [ServerController::class, 'count']);
    });
});
