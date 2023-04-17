<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\API\V1\AuthController;

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

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::apiResource('games', GameController::class)->except('update');
    Route::post('games/{id}', [GameController::class, 'update']);
    Route::get('countOfGames', [GameController::class, 'count']);


    Route::apiResource('servers', ServerController::class)->except('update');
    Route::post('servers/{id}', [ServerController::class, 'update']);
    Route::get('countOfServers', [ServerController::class, 'count']);



    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
