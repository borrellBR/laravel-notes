<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate(User::registerRules());


        $user = User::create([
            'name'     => $request->name,
            'lastname' => 'required|string|max:255',
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token], 201);
    }


    public function login(Request $request)
    {
        $request->validate(User::loginRules());


        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
