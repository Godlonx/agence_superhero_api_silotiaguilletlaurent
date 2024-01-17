<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\GuestController;


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;



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

Route::get('/guest', [GuestController::class,'index'])
    ->middleware('guest')
    ->name('guest');


Route::middleware(['web','auth:sanctum'])->group(function () {
    Route::get('/hero', [HeroController::class, 'index']);
    Route::get('/hero/{id}', [HeroController::class, 'show']);
    Route::post('/hero/create', [HeroController::class, 'store']);
    Route::delete('/hero/{id}/delete', [HeroController::class, 'destroy']);

    Route::get('/power', [PowerController::class,'index']);
    Route::get('/power/{id}', [PowerController::class,'show']);
    Route::post('/power/create', [PowerController::class,'store']);
    Route::delete('/power/{id}/delete', [PowerController::class,'destroy']);

    Route::get('/team', [TeamController::class,'index']);
    Route::get('/team/{id}', [TeamController::class,'show']);
    Route::post('/team/create', [TeamController::class,'store']);

    Route::get('/city', [CityController::class,'index']);
    Route::get('/city/{id}', [CityController::class,'show']);
    Route::get('/city/{id}/hero', [CityController::class,'showHero']);
    Route::post('/city/create', [CityController::class,'store']);
    Route::delete('/city/{id}/delete', [CityController::class,'destroy']);

    Route::get('/transport', [TransportController::class,'index']);
    Route::get('/transport/{id}', [TransportController::class,'show']);

});
Route::get('/endpoint', [ApiController::class, 'index']);






Route::middleware('web')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
                    ->middleware('guest')
                    ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest')
                    ->name('login');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.store');

    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                    ->middleware(['auth', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('logout');

});
