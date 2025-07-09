<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            Log::warning('[AuthController@register] Validation failed', $validator->errors()->toArray());
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        Log::info('[AuthController@register] User registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip()
        ]);

        return response()->json(compact('user', 'token'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            Log::warning('[AuthController@login] Login failed', [
                'email' => $credentials['email'],
                'ip' => $request->ip()
            ]);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        Log::info('[AuthController@login] User logged in', [
            'email' => $credentials['email'],
            'ip' => $request->ip()
        ]);

        return response()->json(compact('token'));
    }

    public function me(Request $request)
    {
        $user = auth()->user();

        Log::info('[AuthController@me] Fetching current user', [
            'user_id' => $user->id ?? null,
            'ip' => $request->ip()
        ]);

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        Log::info('[AuthController@logout] User logged out', [
            'user_id' => $user->id ?? null,
            'ip' => $request->ip()
        ]);

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}


