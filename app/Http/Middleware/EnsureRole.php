<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        $userRole = strtolower(trim(auth()->user()->role));

        if ($userRole !== strtolower(trim($role))) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}