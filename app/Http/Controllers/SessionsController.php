<?php
/**
 * Copyright (c) 2020. Alexander Chuvakov (alex.chuvakov@gmail.com). All rights reserved.
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class SessionsController extends Controller
{
    /** @var UserService */
    protected $userService;

    /**
     * SessionsController constructor.
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }


    /**
     * Authenticate the user and give the token data.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function signin(Request $request) : JsonResponse
    {
        $request->validate(
            [
                'email' => "required|exists:users,email",
                'password' => 'required|min:8'
            ],
            [
                'email.exists' => 'User not found',
                'password.required' => 'Password is required',
                'password.min' => 'Password min length is 8 symbols'
            ]
        );


        if ($token = $this->attempt($request)) {
            $tokenPayload = $this->userService->getTokenPayload($token, $this->guard());
            return $this->respondWithToken($tokenPayload);
        }

        throw ValidationException::withMessages([
            'password' => [trans('Incorrect password')]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function signup(Request $request)
    {
        $user = $this->userService->signUpUser($request);
        $authToken = $this->userService->loginUser($user, $this->guard());
        $tokenPayload = $this->userService->getTokenPayload($authToken, $this->guard());

        return $this->respondWithToken($tokenPayload);
    }

    /**
     * Try to authenticate the user.
     *
     * @param Request $request
     * @return string/null
     */
    protected function attempt(Request $request) : ?string
    {
        return $this->guard()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
    }


    /**
     * Get the authenticated user's Id.
     *
     * @param $tokenPayload
     * @return JsonResponse
     */
    protected function respondWithToken($tokenPayload) : JsonResponse
    {
//        JWTAuth::setToken($authToken)->toUser();
        return response()->json($tokenPayload);
    }


    /**
     * Refresh the token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Sign the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function signout() : JsonResponse
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully signed out']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    protected function guard() : Guard
    {
        return Auth::guard('api');
    }
}
