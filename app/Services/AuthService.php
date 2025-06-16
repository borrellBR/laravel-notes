<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function register(array $data): array
    {
        $validator = Validator::make($data, User::registerRules());
        if ($validator->fails()) {
            return [
                'status' => 422,
                'errors' => $validator->errors(),
            ];
        }

        $user = User::create([
            'name'     => $data['name'],
            'lastname' => $data['lastname'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this-> login($data);
    }


  public function login(array $data): array
  {
      $validator = Validator::make($data, User::loginRules());
      if ($validator->fails()) {
          return [
              'status' => 422,
              'errors' => $validator->errors(),
          ];
      }

      if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
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
