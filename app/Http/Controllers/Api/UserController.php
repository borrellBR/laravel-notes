<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\Api\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
      $this->userService = $userService;
    }

    public function update(Request $request, User $user)
    {
        return $this->userService->update($request, $user);
    }

    public function changePassword(Request $request){
        return $this->userService->changePassword($request);
    }

    public function destroy($id)
    {
        // por si quiero boton de eliminar cuenta
    }
}
