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
        $updated = $this->userService->update($request, $user);

        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $updated,
        ]);
    }

    public function changePassword(Request $request){
        $this->userService->changePassword($request);
        return response()->json([
            'message' => 'Password changed successfully',
        ]);
    }

    public function destroy($id)
    {
        // por si quiero boton de eliminar cuenta
    }
}
