<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\API\AdminPanel\FilmController;
use App\Http\Controllers\API\AdminPanel\HallController;
use App\Http\Controllers\API\AdminPanel\FilmSessionController;
use App\Http\Controllers\API\AdminPanel\InitialAdminPanelController;
use App\Http\Controllers\API\AdminPanel\HallPlaceTypePriceController;

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

// User routes
Route::get('film-sessions', [FilmSessionController::class, 'index']);
Route::get('film-sessions/{id}', [FilmSessionController::class, 'show']);
Route::post('ticket', [TicketController::class, 'store']);
Route::get('ticket/{sessionId}', [TicketController::class, 'show']);
Route::get('init', [InitialAdminPanelController::class, 'index']);
Route::get('films', [FilmController::class, 'index']);
Route::get('films/{id}', [FilmController::class, 'show']);
Route::get('hall', [HallController::class, 'index']);
Route::get('hall/{id}', [HallController::class, 'show']);


// Public Admins routes
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Private Admins routes
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

    Route::get('auth', [AuthController::class, 'auth']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('film-sessions', [FilmSessionController::class, 'store']);

    Route::post('films', [FilmController::class, 'store']);
    Route::delete('films/{id}', [FilmController::class, 'destroy']);

    Route::post('hall', [HallController::class, 'store']);
    Route::put('hall/{id}', [HallController::class, 'update']);
    Route::delete('hall/{id}', [HallController::class, 'destroy']);

    Route::put('hall-place-type-price', [HallPlaceTypePriceController::class, 'update']);
});
