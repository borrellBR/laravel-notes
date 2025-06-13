<?php

namespace App\Services\Api;

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

        Auth::login($user);
        $token = $user->createToken('MyApp')->accessToken;

        return [
            'status'       => 201,
            'message'      => 'Registro exitoso',
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ];
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

      $user = User::where('email', $data['email'])->first();
      if (!$user || !Hash::check($data['password'], $user->password)) {
          return [
              'status'  => 401,
              'message' => 'Credenciales inválidas',
          ];
      }

      Auth::login($user);                                // web
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

    return [
        'status'  => 200,
        'message' => 'Logout exitoso',
    ];
  }

}
