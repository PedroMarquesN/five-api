<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/photos', [PhotoController::class, 'store']);
    Route::get('/photos', [PhotoController::class, 'index']);
    Route::patch('/photos/{photo}/approve', [PhotoController::class, 'approve'])->middleware('can:update,photo');
    Route::patch('/photos/{photo}/reject', [PhotoController::class, 'reject'])->middleware('can:update,photo');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->middleware('can:update,photo');
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
