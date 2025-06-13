<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ForgotPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;

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
        return response()->json(['message' => 'Correo de recuperación enviado.'], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(User::resetPasswordRules());

        $this->ForgotPasswordService->resetPassword($request->email, $request->token, $request->password);

        return response()->json(['message' => 'Contraseña actualizada correctamente.']);
    }
}
