<?php

namespace App\Services\Api;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class UserService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->update($data);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password'     => 'required|string|min:6|confirmed',
        'new_password_confirmation' => 'required|string|min:6',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['error' => 'La contraseña actual es incorrecta'], 403);
    }

    if (Hash::check($request->new_password, $user->password)) {
        return response()->json(['error' => 'La nueva contraseña no puede ser la misma que la actual'], 400);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
}
}
