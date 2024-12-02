<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = new User($data);
        $user->role_id = 2;
        $user->password = Hash::make($data['password']);
        $user->save();

        $user->profile()->create([]);

        $role = $user->roles->name;
        
        return response()->json([
            'message' => 'Pengguna berhasil didaftarkan',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'role_id' => $role,
            ],
        ], 201);
    }
    
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'error' => 'Username atau password salah',
            ], 401);
        }
    
        // $user = JWTAuth::user();
        $user = auth()->user();
    
        return response()->json([
            'message' => 'Login berhasil',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->roles->name,
                'token' => $token,
            ],
        ], 200);
    }
}
