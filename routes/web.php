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

Route::get("reset-password/{token}", function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('reset-password');



Route::post("login", [AuthController::class, 'login']) ->name('login.post');
Route::post("register", [AuthController::class, 'register']) ->name('register.post');
Route::post("forgot-password", [ForgotPasswordController::class, 'sendResetLink']) ->name('forgot-password.post');
Route::post("reset-password", [ForgotPasswordController::class, 'resetPassword']) ->name('reset-password.post');



// AUTHENTICATION REQUIRED

Route::middleware('auth')->group(function () {

    Route::get('/', [NoteController::class, 'index'])->name('index');
    Route::get('notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::get('notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::get('notes/{note}', [NoteController::class, 'show'])->name('notes.show');

    Route::patch('notes/{note}/pin', [NoteController::class, 'pin'])->name('notes.pin');


Route::post('notes', [NoteController::class, 'store'])->name('notes.store');

    Route::put("edit-profile", [UserController::class, 'update']) ->name('edit-profile.put');


Route::get("edit-profile", [UserController::class, 'editProfile'])->name('edit-profile.get');



    Route::post('/logout', function (Request $request) {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Sesión cerrada correctamente');
    })->name('logout');

});
