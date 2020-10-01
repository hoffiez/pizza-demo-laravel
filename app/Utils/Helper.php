<?php

use Illuminate\Contracts\Auth\Guard;

if (! function_exists('_token_payload')) {
    /**
     * Get the token bearer payload.
     *
     * @param string $authToken
     *
     * @param Guard $guard
     * @return array
     */
    function _token_payload(string $authToken, Guard $guard) : array
    {
        return [
            'auth_token' => $authToken,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60
        ];
    }
}