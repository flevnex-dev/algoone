<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    /**
     * Handle an incoming request.
     * Ensure the user is authenticated and has admin role
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('frontend.sign-in');
        }

        $user = auth()->user();
        
        if ($user->role !== 'admin') {
            // If trader, redirect to progress page
            if ($user->role === 'trader') {
                return redirect()->route('frontend.progress');
            }
            // For other roles, redirect to home
            return redirect()->route('home');
        }

        return $next($request);
    }
}
