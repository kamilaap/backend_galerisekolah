<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek jika pengguna memiliki role yang sesuai
        if (Auth::user()->role !== $role) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }
}
