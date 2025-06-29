<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'lastname',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public static function registerRules(): array
{
    return [
        'name'     => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email'    => 'required|string|email|unique:users',
        'password' => 'required|string|min:6',
        'terms'    => 'accepted'
    ];
}

public static function loginRules(): array
{
    return [
        'email'    => 'required|email',
        'password' => 'required',
    ];
}

    public static function updateRules(): array
    {
        return [
        'name'     => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email'    => 'required|string|email|unique:users,email,' . auth()->id(),
        'password' => 'nullable|string|min:6'
        ];
    }

    public static function emailRules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }

    public static function resetPasswordRules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
    }

    public static function updatePasswordRules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|string|min:6',
        ];
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
