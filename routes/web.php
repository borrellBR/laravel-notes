<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\NoteController;
use App\Http\Controllers\Web\ImageController;

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



Route::get("login", function () {
    return view('auth.login');
})->name('login');

Route::post("login", [AuthController::class, 'login']) ->name('login.post');


Route::get("register", function () {
    return view('auth.register');
})->name("register");

Route::post("register", [AuthController::class, 'register']) ->name('register.post');



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
