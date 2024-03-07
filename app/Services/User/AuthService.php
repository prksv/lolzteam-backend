<?php

namespace App\Services\User;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterData;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(RegisterData $userData): User
    {
        $userData->password = Hash::make($userData->password);

        return User::create($userData->toArray());
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginData $loginData): User
    {
        $user = User::where('username', $loginData->username)->firstOrFail();

        $loggedIn = Auth::attempt($loginData->toArray());

        if (!$loggedIn) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
