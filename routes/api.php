<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\UserController;

Route::post('/users/auth', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/profile', function (Request $request) {
        return auth()->user();
    });
    Route::get('/player', [PlayerController::class, 'index']);
    Route::delete('/player/{id}', [PlayerController::class, 'delete']);
    Route::put('/player/{id}', [PlayerController::class, 'update']);
    Route::get('/player/{id}', [PlayerController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
});
