<?php

namespace App\Http\Controllers\Web;
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

    public function editProfile()
    {
        return view('user.edit-profile', ['user' => auth()->user()]);
    }



    public function update(Request $request, User $user)
    {
        $data = $request->validate(User::updateRules());
        $user = auth()->user();
        $this->userService->update($user, $data);


        $this->userService->update($user, $data);
        return redirect()->route('index')
                         ->with('message', 'Perfil actualizado correctamente');
    }

    public function changePassword(Request $request){
        $data =  $request->validate(User::changePasswordRules());

        $this->userService->changePassword(Auth::user(),$data);

        return back()->with('message', 'Contraseña cambiada correctamente');
    }

    public function destroy($id)
    {
        //
    }
}
