<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTraderRole
{
    /**
     * Handle an incoming request.
     * Ensure the user is authenticated and has trader role
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('frontend.sign-in');
        }

        $user = auth()->user();
        
        if ($user->role !== 'trader') {
            // If admin, redirect to admin dashboard
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // For other roles, redirect to home
            return redirect()->route('home');
        }

        return $next($request);
    }
}
