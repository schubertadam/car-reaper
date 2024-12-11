<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

class LogoutController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {
    }

    public function __invoke()
    {
        $this->authService->logout();

        return redirect()->route('login');
    }
}
