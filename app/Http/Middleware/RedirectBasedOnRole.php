<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // If user is trying to access the default dashboard and is an admin
            if ($request->routeIs('dashboard') && $user->hasRole('Admin')) {
                return redirect()->route('filament.admin.pages.dashboard');
            }
        }

        return $next($request);
    }
}