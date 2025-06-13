<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\Request;

class UserService
{

    public function update(Request $request, User $user): User
    {
        $this->requireOwner($user);

        $data = $request->validate(User::updateRules());
        $user->update($data);

        return $user;
    }



    public function destroy($id)
    {
        // no implementado por ahora
    }

    public function changePassword(Request $request)
    {
        $request->validate(User::changePasswordRules());

        $user = auth()->user();

        if (! Hash::check($request->current_password, $user->password)) {
            throw new AuthorizationException('La contraseña actual es incorrecta');
        }

        if (Hash::check($request->new_password, $user->password)) {
            throw new AuthorizationException('La nueva contraseña no puede ser la misma que la actual');
        }

        $user->update(['password' => Hash::make($request->new_password)]);
    }

    private function requireOwner(User $user): void
    {
        if ($user->id !== auth()->id()) {
            throw new AuthorizationException('Unauthorized');
        }
    }
}
