<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\NoteController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\ForgotPasswordController;


// NO AUTHENTICATION

Route::get("login", function () {
    return view('auth.login');
})->name('login');

Route::get("register", function () {
    return view('auth.register');
})->name("register");

Route::get("forgot-password", function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get("reset-password/{token}", function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('reset-password');

Route::get("terms/", function () {
    return view('terms.terms');
})->name('terms');

Route::post("login", [AuthController::class, 'login']) ->name('login.post');
Route::post("register", [AuthController::class, 'register']) ->name('register.post');
Route::post("forgot-password", [ForgotPasswordController::class, 'sendResetLink']) ->name('forgot-password.post');
Route::post("reset-password", [ForgotPasswordController::class, 'resetPassword']) ->name('reset-password.post');


// AUTHENTICATION REQUIRED

Route::middleware('auth')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('index');

    Route::prefix('notes')->group(function () {

        Route::get('/create', [NoteController::class, 'create'])->name('notes.create'); //1
        Route::get('/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');//2
        Route::put('/{note}', [NoteController::class, 'update'])->name('notes.update');//2.1
        Route::delete('/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
        Route::get('/{note}', [NoteController::class, 'show'])->name('notes.show');//3
        Route::post('', [NoteController::class, 'store'])->name('notes.store');
        Route::put('/{note}/toggle-pin', [NoteController::class, 'togglePin']);

    });

        Route::delete('images/{image}', [ImageController::class,'destroy'])->name('image.destroy');

    Route::prefix('edit-profile')->group(function () {
        Route::put("/", [UserController::class, 'updateProfile']) ->name('edit-profile.put');
        Route::get("/", [UserController::class, 'editProfile'])->name('edit-profile.get');

    });

    Route::prefix('edit-password')->group(function () {
        Route::get("/", [UserController::class, 'editPassword'])->name('edit-password.get');
        Route::put("/", [UserController::class, 'updatePassword']) ->name('edit-password.put');
    });

    Route::get("/search", [NoteController::class, 'searchNoteName'])->name('notes.search');
    Route::get("/search-date", [NoteController::class, 'searchNoteDate'])->name('notes.search-date');



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
