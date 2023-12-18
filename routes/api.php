<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CityController;

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

Route::get('/power', [PowerController::class,'index']);
Route::get('/power/{id}', [PowerController::class,'show']);

Route::get('/team', [TeamController::class,'index']);
Route::get('/team/{id}', [TeamController::class,'show']);

Route::get('/city', [CityController::class,'index']);
Route::get('/city/{id}', [CityController::class,'show']);

Route::get('/city/{id}/hero', [CityController::class,'showHero']);

