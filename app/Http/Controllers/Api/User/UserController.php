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

class UserController extends ApiController
{
    public function index(Request $request)
    {
        return $this->okResponse('OK', new UserResource($request->user()));
    }
}
