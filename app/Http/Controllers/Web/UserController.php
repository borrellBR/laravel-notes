<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\Web\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
      $this->userService = $userService;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
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
        //
    }
}
