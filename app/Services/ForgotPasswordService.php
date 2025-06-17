<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Validation\ValidationException;

class ForgotPasswordService
{
    public function sendResetLink(string $email): void
    {
        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($email)->send(new ResetPasswordMail($token));

    }

    public function resetPassword(string $email, string $token, string $password): void
    {

        $ok = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

            if (! $ok) {
                abort(403,'Token inválido o expirado.');

            }
            $user = User::where('email', $email)->first();

            $this -> checkForDifferentPassword($user, $password);

        $user = User::where('email', $email)->first();
        $user->update(['password' => Hash::make($password)]);

        DB::table('password_resets')->where('email', $email)->delete();

    }

    private function checkForDifferentPassword(User $user, string $newPassword): void
    {
        if (Hash::check($newPassword, $user->password)) {
            abort(403, 'La nueva contraseña no puede ser la misma que la actual');
        }
    }

}

//aqui, verificando que la contraseña nueva que pone el usuario no sea igual que la que tiene ahora mismo
