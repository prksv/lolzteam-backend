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
     *
     * @return string User API Token
     */
    public function login(LoginData $loginData): string
    {
        $loggedIn = auth()->attempt($loginData->toArray());

        if (!$loggedIn) {
            throw new AuthenticationException();
        }

        $user = auth()->user();

        return $user->createToken('api')->plainTextToken;
    }
}
