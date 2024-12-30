<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/photos', [PhotoController::class, 'store']);
    Route::get('/photos', [PhotoController::class, 'index']);
    Route::patch('/photos/{photo}/approve', [PhotoController::class, 'approve'])->middleware('can:update,photo');
    Route::patch('/photos/{photo}/reject', [PhotoController::class, 'reject'])->middleware('can:update,photo');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->middleware('can:update,photo');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users/{user}/activate', [UserController::class, 'activate']);
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate']);
});
