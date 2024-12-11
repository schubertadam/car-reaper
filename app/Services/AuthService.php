<?php

namespace App\Services;

use App\Exceptions\LockedOutException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthService
{
    const int MAX_LOGIN_ATTEMPTS = 5;

    /**
     * Logs in the user with the provided credentials and IP address
     * @param string $username
     * @param string $password
     * @param string $ip
     * @param bool $remember
     * @return void
     * @throws LockedOutException if the user has reached the maximum login attempts
     */
    public function login(string $username, string $password, string $ip, bool $remember = false): void
    {
        $throttleKey = $ip; // if needed later can be change

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_LOGIN_ATTEMPTS - 1)) {
            throw new LockedOutException($throttleKey);
        }

        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        if (!auth()->attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
                'custom' => 'Attempts left: ' . RateLimiter::retriesLeft($throttleKey, self::MAX_LOGIN_ATTEMPTS)
            ]);
        }

        RateLimiter::clear($throttleKey); // in case of successful login, reset the rate limiter
    }
}
