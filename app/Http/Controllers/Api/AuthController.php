<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate(User::registerRules());

        $user = User::create([
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MyApp')->accessToken;

        return response()->json([
            'message' => 'Registro exitoso',
            'user'    => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
    $request->validate(User::loginRules());

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('status', 'Credenciales inválidas');
    }
    $user  = Auth::user();
    $token = $user->createToken('MyApp')->accessToken;

    return response()->json([
        'message' => 'Login exitoso',
        'user'    => $user,
        'access_token' => $token,
        'token_type'   => 'Bearer',
    ]);
}
}
