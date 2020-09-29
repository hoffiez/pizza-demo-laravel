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
        $request->validate(
            [
                'email' => "required|email|unique:users,email",
                'password' => 'required|confirmed|min:8|max:50',
                'name' => 'required',
                'pd_agreement' => 'required'
            ],
            [
                'email.unique' => 'E-mail is already used'
            ]
        );

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