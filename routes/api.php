<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->prefix('email')->group(function () {
    Route::post('/', [EmailController::class, 'store']);
    Route::get('/{id}', [EmailController::class, 'show']);
    Route::put('/{id}', [EmailController::class, 'update']);
    Route::get('/', [EmailController::class, 'index']);
    Route::delete('/{id}', [EmailController::class, 'destroy']);
});

