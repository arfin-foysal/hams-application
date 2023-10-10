<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AuthService;


class AuthController extends Controller
{
   protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = new AuthService();
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
       
    }

    public function login (Request $request)
    {
        return $this->authService->login($request);

    }

    public function clientLogin(Request $request)
    {
        return $this->authService->clientLogin($request);
    }

    public function passwordChange(Request $request)
    {
        return $this->authService->passwordChange($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    
}
