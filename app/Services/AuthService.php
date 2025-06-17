<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'lastname' => $data['lastname'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $response = $this-> login($data);
        $response ['status'] = 201;
        return $response;
    }


  public function login(array $data): array
  {
      if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        return [
            'status'  => 401,
            'message' => 'Credenciales inválidas',
        ];
    }

    $user = Auth::user();
    $token = $user->createToken('MyApp')->accessToken; // api

      return [
          'status'       => 200,
          'message'      => 'Login exitoso',
          'user'         => $user,
          'access_token' => $token,
          'token_type'   => 'Bearer',
      ];
  }

  public function logout(): array
  {
    $user = auth()->user();

    if (! $user) {
        return [
            'status'  => 401,
            'message' => 'No autenticado',
        ];
    }

    $user->tokens()->delete();

    Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken(); //token csrf, nada que ver con user

    return [
        'status'  => 200,
        'message' => 'Logout exitoso',
    ];
  }

}
