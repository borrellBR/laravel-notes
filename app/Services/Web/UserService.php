<?php

namespace App\Services\Web;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{


    public function editProfile($user)
    {
        return view('user.edit-profile', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->update($data);

        return redirect()->route('index')->with('message', 'Perfil actualizado correctamente');
    }



    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password'     => 'required|string|min:6|confirmed',
        'new_password_confirmation' => 'required|string|min:6',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'La contraseña actual es incorrecta');
    }

    if (Hash::check($request->new_password, $user->password)) {
        return redirect()->back()->with('error', 'La nueva contraseña no puede ser la misma que la actual');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('message', 'Contraseña cambiada exitosamente');
}
}
