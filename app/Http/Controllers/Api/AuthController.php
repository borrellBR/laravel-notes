<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

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
    return $this->authService->register($data);
  }

  public function login(Request $request)
  {
    $data = $request->validate(User::loginRules());
    return $this->authService->login($data);
  }
    public function logout(Request $request)
    {
        return $this->authService->logout();
    }
}
