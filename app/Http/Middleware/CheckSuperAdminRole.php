<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // First check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if role is NOT 3 (note the correction in the comparison)
        if (Auth::user()->role !== 3) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 403); // Using 403 Forbidden instead of 401 Unauthorized
            }
            
            // For web routes, redirect back with an error message
            return redirect()->route('login');
        }

        return $next($request);
    }
}