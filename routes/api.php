<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TournamentController;

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

Route::get('/players', [PlayerController::class, 'index']);
Route::post('/player', [PlayerController::class, 'store']);
Route::post('/player/{player}/update', [PlayerController::class, 'update']);

Route::get('/skills', [SkillController::class, 'byGender']);

Route::post('/tournament', [TournamentController::class, 'store']);
Route::post('/tournaments', [TournamentController::class, 'index']);
