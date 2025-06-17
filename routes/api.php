<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ForgotPasswordController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);


Route::middleware('auth:api')->group(function () {

    Route::prefix('notes')->group(function () {
        Route::get('/', [NoteController::class, 'index']);
        Route::post('/', [NoteController::class, 'store']);
        Route::get('/{note}', [NoteController::class, 'show']);
        Route::put('/{note}', [NoteController::class, 'update']);
        Route::delete('/{note}', [NoteController::class, 'destroy']);
    });

    Route::prefix('notes/{note}/images')->group(function () {
        Route::post('/', [ImageController::class, 'store']);
        Route::get('/', [ImageController::class, 'index']);
    });


    Route::get('/user', [UserController::class,'getUserId']);
    Route::put('/users/{user}', [UserController::class, 'update']);

    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);


});



