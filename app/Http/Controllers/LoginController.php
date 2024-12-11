<?php

namespace App\Http\Controllers;

use App\Exceptions\LockedOutException;
use App\Http\Requests\StoreLoginRequest;
use App\Services\AuthService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {
    }

    public function index()
    {
        return view('welcome');
    }

    public function store(StoreLoginRequest $request)
    {
        try {
            $data = $request->validated();

            $this->authService->login($data['username'], $data['password'], $request->ip());

            return redirect()->route('dashboard');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (LockedOutException $e) {
            event(new Lockout($request));

            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
