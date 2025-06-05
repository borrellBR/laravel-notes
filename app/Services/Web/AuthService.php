<?php

namespace App\Services\Web;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthService
{
  public function register(array $data): RedirectResponse
  {
    $user = User::create([
      'name' => $data['name'],
      'lastname' => $data['lastname'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect()
      ->route('index')
      ->with('status', 'Registro exitoso');
  }

  public function login(array $data): RedirectResponse
  {
    $user = User::where('email', $data['email'])->first();

    if (!$user || !Hash::check($data['password'], $user->password)) {
      return back()->with('status', 'Credenciales inválidas');
    }

    Auth::login($user);

    return redirect()
      ->route('index')
      ->with('status', 'Login exitoso');
  }
}
