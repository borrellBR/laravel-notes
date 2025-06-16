<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ForgotPasswordController;


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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/users/{user}', [UserController::class, 'update']);


Route::middleware('auth:api')->post('/change-password', [UserController::class, 'changePassword']);




Route::middleware('auth:api')->post('/notes', [NoteController::class, 'store']);
Route::middleware('auth:api')->get('/notes', [NoteController::class, 'index']);
Route::middleware('auth:api')->get('/notes/{note}', [NoteController::class, 'show']);
Route::middleware('auth:api')->put('/notes/{note}', [NoteController::class, 'update']);
Route::middleware('auth:api')->delete('/notes/{note}', [NoteController::class, 'destroy']);
Route::middleware('auth:api')->post('/notes/{note}/images', [ImageController::class, 'store']);
Route::middleware('auth:api')->get('/notes/{note}/images', [ImageController::class, 'index']);

Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
