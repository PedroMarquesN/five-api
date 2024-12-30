<?php

namespace App\Actions;

use App\Models\User;

class CreateUserToken
{
    public function handler(User $user): string
    {
        return $user->createToken('token-name')->plainTextToken;
    }

}
