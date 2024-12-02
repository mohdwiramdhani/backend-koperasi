<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user || $user->roles->name !== $role)
        {
            return response()->json(['errors' => 'Akses ditolak'], 403);
        }
        return $next($request);
    }
}
