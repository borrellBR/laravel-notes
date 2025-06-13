<?php

namespace App\Services\Api;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class UserService
{

    public function update(Request $request, User $user): JsonResponse
    {
        $user = auth()->user();

        $data = $request->validate(User::updateRules());

        $user->update($data);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }


    public function destroy($id)
    {
        // no implementado por ahora
    }

    public function changePassword(Request $request)
    {
        $request->validate(User::changePasswordRules());

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'La contraseña actual es incorrecta'], 403);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return response()->json(['error' => 'La nueva contraseña no puede ser la misma que la actual'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
    }
}
