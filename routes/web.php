<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\DashboardController;


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


Auth::routes();

Route::get('/', function () {
    return redirect('home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::resource('games', GamesController::class);

    Route::resource('servers', ServerController::class);
    
    Route::post('servers/search', [ServerController::class , 'search'])->name('look-for-server');

    Route::get('Game/{game_id}/servers', [GamesController::class, 'showServers'])->name('Game-s-servers');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
