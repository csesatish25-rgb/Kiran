<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->must_change_password && ! $request->routeIs('admin.password.*')) {
            return redirect()
                ->route('admin.password.edit')
                ->with('status', 'Please change the default password before continuing.');
        }

        return $next($request);
    }
}
