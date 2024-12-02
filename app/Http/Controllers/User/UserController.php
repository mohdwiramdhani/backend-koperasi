<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getCurrentUser(): JsonResponse
    {
        $user = auth()->user();
    
        return response()->json([
            'message' => 'Pengguna berhasil ditemukan',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->roles->name,
            ],
        ], 200);
    }

    public function getAllUsers(): JsonResponse
    {
        $users = User::with('roles')->get();

        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->roles->name,
            ];
        });
    
        return response()->json([
            'message' => 'Semua Pengguna berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    public function updateCurrentUser(UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = auth()->user();

        if (isset($data['username'])) {
            $user->username = $data['username'];
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
    
        return response()->json([
            'message' => 'Pengguna berhasil diperbarui',
            'data' => [
                'id' => $user->id,
                'username' => $user->username
            ],
        ], 200);
    }
    
    public function deleteUser($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        if ($user->roles->name === 'admin') {
            return response()->json([
                'message' => 'Pengguna tidak bisa dihapus'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'Pengguna berhasil dihapus'
        ], 200);
    }

}