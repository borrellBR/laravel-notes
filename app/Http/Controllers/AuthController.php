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
            'lastname' => $request->lastname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->route('index')->with('status', 'Login exitoso');


    }


public function login(Request $request)
{
    $request->validate(User::loginRules());

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('status', 'Credenciales inválidas');
    }

    auth()->login($user);

    return redirect()->route('index')->with('status', 'Login exitoso');
}
}
