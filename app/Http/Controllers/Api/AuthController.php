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

    $response = $this->authService->register($data);

    return response()->json($response, $response['status']);
    }

  public function login(Request $request)
  {
    $data = $request->validate(User::loginRules());
    $response = $this->authService->login($data);

    return response()->json($response, $response['status']);
  }

    public function logout(Request $request)
    {
        $response = $this->authService->logout();

        return response()->json(
            ['message' => $response['message']],
            $response['status']
        );
    }
}
