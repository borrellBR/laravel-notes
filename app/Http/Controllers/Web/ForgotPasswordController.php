<?php
// app/Http/Controllers/Api/ForgotPasswordController.php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use App\Services\Web\ForgotPasswordService;

class ForgotPasswordController extends Controller
{
    protected $ForgotPasswordService;

    public function __construct(ForgotPasswordService $ForgotPasswordService)
    {
      $this->ForgotPasswordService = $ForgotPasswordService;
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(User::emailRules());

       $this->ForgotPasswordService->sendResetLink($request->email);

        return redirect()->back()->with('status', 'Enlace de restablecimiento de contraseña enviado a tu correo electrónico.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(User::resetPasswordRules());

        $this->ForgotPasswordService->resetPassword($request->email, $request->token, $request->password);

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida correctamente. Ahora puedes iniciar sesión con tu nueva contraseña.');
    }
}
