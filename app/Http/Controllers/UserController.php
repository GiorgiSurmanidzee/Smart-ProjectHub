<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginUserRequest;
use App\Http\Requests\registerUserRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    public function register(registerUserRequest $request)
    {
        $user = User::create($request->all());
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    public function login(loginUserRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt($request->all())) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $user = auth()->user();

            $roles = $user->getRoleNames();
            $permissions = $user->getAllPermissions()->pluck('name');

            $token = JWTAuth::claims([
                'roles' => $roles->toArray(),
                'permissions' => $permissions->toArray()
            ])->fromUser($user);

            return response()->json([
                'token' => $token,
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    public function getUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
