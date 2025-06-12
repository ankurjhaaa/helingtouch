<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!Auth::guard('web')->check() || !Auth::user()->role) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Normalize roles to lowercase to avoid case sensitivity issues
        $userRole = strtolower(Auth::user()->role);
        $allowedRoles = array_map('strtolower', $roles);

        // ✅ Allow admin to access all routes
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Check if user has one of the allowed roles
        if (!in_array($userRole, $allowedRoles)) {
            Log::warning('Unauthorized access attempt by user ID: ' . Auth::id() . ' to roles: ' . implode(',', $roles));
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
