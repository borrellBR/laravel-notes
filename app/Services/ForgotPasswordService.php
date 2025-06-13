<?php

namespace App\Services;

use Illuminate\Http\Request;
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
                throw ValidationException::withMessages([
                    'token' => 'Token inválido o expirado.',
                ]);
            }


        $user = User::where('email', $email)->first();
        $user->update(['password' => Hash::make($password)]);

        DB::table('password_resets')->where('email', $email)->delete();

    }
}
