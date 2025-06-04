<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthService
{
  /* ---------- REGISTRO ---------- */
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

  /* ---------- LOGIN ------------- */
  public function login(array $data): JsonResponse
  {
    $user = User::where('email', $data['email'])->first();

    if (!$user || !Hash::check($data['password'], $user->password)) {
      return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $token = $user->createToken('MyApp')->accessToken;

    return response()->json([
      'message' => 'Login exitoso',
      'user' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer',
    ]);
  }
}
