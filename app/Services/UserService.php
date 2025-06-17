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

    public function updateProfile(User $user, array $data): User
    {
        $this->requireOwner($user);

        $user->update($data);

        return $user;
    }

    public function destroy($id)
    {
        // no implementado por ahora
    }

    public function updatePassword(User $user, array $data): void
    {

        $this -> checkCurrentPassword($user, $data);
        $this -> checkForDifferentPassword($user, $data);

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

    private function checkCurrentPassword(User $user, array $data){
        if (! Hash::check($data['current_password'], $user->password)) {
            abort(403,'La contraseña actual es incorrecta.');
        }
    }

    private function checkForDifferentPassword(User $user, array $data){
        if ($data['current_password'] === $data['new_password']) {
            abort(403,'La nueva contraseña no puede se la misma que la actual');
        }
    }
}
