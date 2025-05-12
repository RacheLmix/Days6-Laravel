<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check both possible admin columns
        if (!Auth::check() || (!Auth::user()->is_admin && Auth::user()->admin !== 'admin')) {
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
