<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        if (!Auth::user()->tokenCan($routeName) && Auth::id() != 1) {
            return response()->json([
                'message' => 'Access denied.',
                'errors' => ['permissions' => 'Access denied.']
            ], 401);
        }

        return $next($request);
    }
}
