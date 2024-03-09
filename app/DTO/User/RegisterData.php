<?php

namespace App\DTO\User;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class RegisterData extends Data
{
    public function __construct(
        public string $email,
        public string $username,
        public string $password,
    )
    {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'email' => ['required', 'email'],
            'username' => ['required', 'min:5', 'max:25', 'unique:users,username'],
            'password' => ['required', 'min:6', 'max:100']
        ];
    }
}
