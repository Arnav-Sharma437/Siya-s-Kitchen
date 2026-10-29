<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_authenticated', false)) {
            if ($request->expectsJson() || $request->is('admin/api/*')) {
                return response()->json(['error' => 'Unauthorized admin access'], 401);
            }
            return redirect()->route('admin.login')->with('warning', 'Please sign in to access the restaurant management portal.');
        }

        return $next($request);
    }
}
