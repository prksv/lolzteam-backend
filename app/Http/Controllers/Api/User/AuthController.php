<?php

namespace App\Http\Controllers\Api\User;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterData;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Services\User\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public function __construct(
        protected AuthService $authService
    )
    {
    }

    public function register(Request $request)
    {
        $registerData = RegisterData::from($request);

        $user = $this->authService->register($registerData);

        return $this->okResponse(__('auth.register.success'), new UserResource($user));
    }

    public function login(Request $request)
    {
        $loginData = LoginData::from($request);

        try {
            $user = $this->authService->login($loginData);
            return $this->okResponse(__('auth.login.success'), new UserResource($user));
        } catch (ModelNotFoundException | AuthenticationException) {
            return $this->clientErrorResponse(__('auth.login.fail'));
        }
    }
}
