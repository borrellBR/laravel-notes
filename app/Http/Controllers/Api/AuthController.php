<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function __construct(private AuthService $authService)
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
}
