<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;
use Symfony\Component\HttpFoundation\Response;

class TrimStrings extends Middleware
{
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
}
