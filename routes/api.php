<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->group(function(){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');
});

Route::middleware('auth:sanctum')->group(function(){

    Route::prefix('posts')->group(function(){
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{id}', [PostController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('/{id}', [PostController::class, 'destroy'])->where('id', '[0-9]+');
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);