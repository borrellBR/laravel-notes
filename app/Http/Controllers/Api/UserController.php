<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
      $this->userService = $userService;
    }

    public function getUserId(User $user){
        $user = $this->userService->getUserId($user);

        return response()->json([
            'message' => 'User id succesfully obtained',
            'user'    => $user,
        ]);
    }

    public function updateProfile(Request $request, User $user)
    {
        $data = $request->validate(User::updateRules());
        $user = auth()->user();

        $updated = $this->userService->updateProfile($user, $data);

        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $updated,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $data =  $request->validate(User::updatePasswordRules());

        $this->userService->updatePassword(Auth::user(),$data);

        return response()->json([
            'message' => 'Password changed successfully',
        ]);
    }

    public function destroy($id)
    {
        // por si quiero boton de eliminar cuenta
    }

}
