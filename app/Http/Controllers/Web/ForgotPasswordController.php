<?php
// app/Http/Controllers/Api/ForgotPasswordController.php

namespace App\Http\Controllers\Api;
use App\Services\Api\ForgotPasswordService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{

    protected $forgotPasswordService;
  public function __construct(ForgotPasswordService $forgotPasswordService)
  {
    $this->forgotPasswordService = $forgotPasswordService;
  }

    public function sendResetLink(Request $request)
    {
        return $this->forgotPasswordService->sendResetLink($request);

    }

    public function resetPassword(Request $request)
    {
        return $this->forgotPasswordService->resetPassword($request);

    }
}
