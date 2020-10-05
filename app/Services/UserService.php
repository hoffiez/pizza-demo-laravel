<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param Request $request
     * @return User
     */
    public function signUpUser(Request $request)
    {
        $inputData = $request->only(['email', 'password', 'name']);
        $inputData['password'] = Hash::make($inputData['password']);
        $user = User::create($inputData);

        return $user;
    }

    /**
     * @param User $user
     * @param Guard $guard
     * @return mixed
     */
    public function loginUser(User $user, Guard $guard)
    {
        return $guard->login($user);
    }

    /**
     * @param $authToken
     * @param Guard $guard
     * @return array
     */
    public function getTokenPayload($authToken, Guard $guard)
    {
        return _token_payload($authToken, $guard);
    }

}