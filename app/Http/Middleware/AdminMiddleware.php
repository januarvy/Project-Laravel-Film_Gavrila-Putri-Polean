<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request. Only users with role "admin" may proceed.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->role_id != 2) {
            abort(403, 'Halaman ini hanya untuk administrator.');
        }

        return $next($request);
    }
}
