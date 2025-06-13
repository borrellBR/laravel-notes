<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Web\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
        protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $data = $request->validate(User::registerRules());

        $response = $this->authService->register($data);

        if ($response['status'] !== 201) {
            return back()->withErrors($response['errors'] ?? [])->withInput();
        }

        return redirect()
          ->route('index')
          ->with('status', 'Registro exitoso');
      }


    public function login(Request $request)
    {
        $data = $request->validate(User::loginRules());
        $response = $this->authService->login($data);

        if ($response['status'] !== 200) {
            return back()->with('status', $response['message'] ?? 'Error');
        }
        return redirect()
            ->route('index')
            ->with('token', $response['access_token']);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('status', $response['message']);
    }

}
