<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\loginUserRequest;
use App\Http\Requests\registerUserRequest;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(registerUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function login(loginUserRequest $request)
    {
        try {
            if (! $token = JWTAuth::attempt($request->validated())) {
                return ApiResponseClass::sendError('Invalid credentials', 401);
            }
            $user = auth()->user();
            $user->load('roles.permissions');

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        } catch (JWTException $e) {
            return ApiResponseClass::sendError("'Could not create token", 500);
        }
    }

    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return ApiResponseClass::sendError('User not found', 404);
            }
        } catch (JWTException $e) {
            return ApiResponseClass::sendError('Invalid token', 400);
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return ApiResponseClass::sendError('Successfully logged out', 204);
    }
}
