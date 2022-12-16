<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => 'auth'], function () {
    // Public routes
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
  
    Route::group(['middleware' => 'auth:api'], function() {
        // Protected routes
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

});

Route::group(['middleware' => 'auth:api'], function() {    
    // Tournament - Protected routes
    Route::get('/players', [PlayerController::class, 'index']);
    Route::post('/player', [PlayerController::class, 'store']);
    Route::post('/player/{player}/update', [PlayerController::class, 'update']);    
    Route::get('/skills', [SkillController::class, 'byGender']);    
    Route::post('/tournament', [TournamentController::class, 'store']);
    Route::post('/tournaments', [TournamentController::class, 'index']);
});
