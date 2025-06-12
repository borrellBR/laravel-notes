<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthService
{
  public function register(array $data): JsonResponse
  {

    $user = User::create([
      'name' => $data['name'],
      'lastname' => $data['lastname'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    $token = $user->createToken('MyApp')->accessToken;

    return response()->json([
      'message' => 'Registro exitoso',
      'user' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer',
    ], 201);
  }

  public function login(array $data): JsonResponse
  {
    $user = User::where('email', $data['email'])->first();

    if (!$user || !Hash::check($data['password'], $user->password)) {
      return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $tokenResult = $user->createToken('MyApp');
    $token = $tokenResult->accessToken;

    return response()->json([
      'message' => 'Login exitoso',
      'user' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer',
    ]);
  }

  public function logout(): JsonResponse
  {
      $user = auth()->user();

      if (!$user) {
          return response()->json(['error' => 'No autenticado'], 401);
      }

      $user->tokens->each->revoke();

      return response()->json(['message' => 'Logout exitoso'], 200);
  }

}
