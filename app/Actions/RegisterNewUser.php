<?php

namespace App\Actions;

use App\Dtos\CreateUserDto;
use App\Models\User;

class RegisterNewUser
{
    public function handler(CreateUserDto $userDto): User
    {
       return User::query()->create($userDto->toArray());
    }

}
