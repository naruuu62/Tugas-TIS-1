<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('movies')->group(function () {
        Route::post('/', [MovieController::class, 'createMovies']);
        Route::get('/', [MovieController::class, 'getMovies']);
        Route::get('/{id}', [MovieController::class, 'getMoviesById']);
        Route::put('/{id}', [MovieController::class, 'updateMovies']);
        Route::delete('/{id}', [MovieController::class, 'deleteMovies']);
    });
});