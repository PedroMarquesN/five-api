<?php

namespace App\Http\Controllers\Auth;

use App\Actions\CreateUserToken;
use App\Actions\RegisterNewUser;
use App\Dtos\CreateUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(
        StoreRegisterRequest $request,
        RegisterNewUser $registerNewUser,
        CreateUserToken $createUserToken
    ): JsonResponse
    {

        $data = $request->validated();
        $userDto = new CreateUserDto($data['name'], $data['email'], $data['password']);
        $user  =  $registerNewUser->handler($userDto);
        $token =  $createUserToken->handler($user);

        Auth::login($user);

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
