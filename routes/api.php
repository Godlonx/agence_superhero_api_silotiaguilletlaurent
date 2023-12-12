<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HeroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/endpoint', [ApiController::class, 'index']);

Route::get('/hero', [HeroController::class, 'index']);
Route::get('/hero/{id}', [HeroController::class, 'show']);

Route::get('/hero/{id}/power', [HeroController::class, 'showPower']);
Route::get('/hero/{id}/team', [HeroController::class, 'showTeam']);
Route::get('/hero/{id}/city', [HeroController::class, 'showCity']);

Route::get('/power', [HeroController::class,'index']);
Route::get('/power/{id}', [HeroController::class,'show']);

Route::get('/team', [HeroController::class,'index']);
Route::get('/team/{id}', [HeroController::class,'show']);

Route::get('/city', [HeroController::class,'index']);
Route::get('/city/{id}', [HeroController::class,'show']);

Route::get('/city/{id}/hero', [HeroController::class,'showHero']);

