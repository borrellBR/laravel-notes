<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserService
{

    public function getUserId(User $user) {
        $user = auth() -> user();

       return $user;

    }

    public function update(User $user, array $data): User
    {
        $this->requireOwner($user);

        $user->update($data);

        return $user;
    }

        public function destroy($id)
        {
            // no implementado por ahora
        }

    public function changePassword(User $user, array $data): void
    {

            if (!Hash::check($data['current_password'], $user->password)) {
                abort(403,'La contraseña actual es incorrecta.');
            }


            if ($data['current_password'] === $data['new_password']) {
                abort(403,'La nueva contraseña no peude se la misma que la actual');
            }

            $user->update([
                'password' => Hash::make($data['new_password']),
            ]);

    }

    private function requireOwner(User $user): void
    {
        if ($user->id !== auth()->id()) {
            abort(403,'Unauthorized');
        }
    }
}
