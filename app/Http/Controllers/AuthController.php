<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle user login request.
     *
     * Validates the request data, checks the user's credentials
     * using Laravel's Auth system, and generates a new Sanctum token
     * if authentication is successful.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * POST /api/login
     * {
     *   "email": "user@example.com",
     *   "password": "password123"
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token
        ]);
    }

    /**
     * Logout from the current session.
     *
     * Deletes the access token associated with the current request,
     * effectively logging out the user from the current device/session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * POST /api/logout
     * Authorization: Bearer {token}
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out from current session']);
    }

    /**
     * Logout from all active sessions.
     *
     * Deletes all API tokens associated with the authenticated user,
     * logging them out from every device/session where they were signed in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * POST /api/logout-all
     * Authorization: Bearer {token}
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out from all sessions'
        ], 200);
    }
}
