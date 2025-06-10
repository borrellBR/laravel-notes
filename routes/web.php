<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\NoteController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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



Route::post("login", [AuthController::class, 'login']) ->name('login.post');
Route::post("register", [AuthController::class, 'register']) ->name('register.post');
Route::post("forgot-password", [ForgotPasswordController::class, 'sendResetLink']) ->name('forgot-password.post');
Route::post("reset-password", [ForgotPasswordController::class, 'resetPassword']) ->name('reset-password.post');

Route::get("reset-password/{token}", function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('reset-password');

// AUTHENTICATION REQUIRED

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home.index');
    })->name('index');

    Route::post('/logout', function (Request $request) {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Sesión cerrada correctamente');
    })->name('logout');

});
