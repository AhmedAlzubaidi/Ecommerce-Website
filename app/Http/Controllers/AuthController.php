<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        Log::info('AuthController->register');
        
        $user = new User();
        $user->name      = $request->input('name');
        $user->role_id   = null;
        $user->email     = $request->input('email');
        $user->password  = Hash::make($request->input('password'));
        $user->full_name = $request->input('full_name');
        $user->save();
        $accessToken     = $user->createToken('authToken')->accessToken;

        return ['user' => $user, 'access_token' => $accessToken];
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');
        $data['password'] = Hash::make($data['password']);

        if (!Auth::attempt($data)) {
            return response(['message' => 'The given credentials were invalid'], 401);
        }

        $user        = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return ['user' => $user, 'access_token' => $accessToken];
    }
}
