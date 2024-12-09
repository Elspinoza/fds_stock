<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse {

        $user = User::create($request->validated());

        $token = $user-> createToken($request->name);

        return response()->json([
            'message' => 'You have successfully registered ',
            'name' => $user->name,
            'token' => $token->plainTextToken,
        ],
            201
        );
    }


    public function login(LoginRequest $request) : JsonResponse {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'],
                401
            );
        }

        $token = $user-> createToken($user->name);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);

    }


    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Your are now logged out.'
        ];
    }
}
