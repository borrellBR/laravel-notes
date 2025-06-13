<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\Web\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
      $this->userService = $userService;
    }

    public function editProfile()
    {
        return view('user.edit-profile', ['user' => auth()->user()]);
    }



    public function update(Request $request)
    {
        $this->userService->update($request, auth()->user()); // pásale el usuario logueado

        return redirect()->route('index')
                         ->with('message', 'Perfil actualizado correctamente');
    }

    public function changePassword(Request $request){
        $this->userService->changePassword($request);

        return back()->with('message', 'Contraseña cambiada correctamente');
    }


    public function destroy($id)
    {
        //
    }
}
