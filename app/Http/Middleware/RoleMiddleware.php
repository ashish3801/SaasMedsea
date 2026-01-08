<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission = null): Response
    {
        // return $next($request);
        $user = Auth::user();

        // Super admin (role_id = 1) bypasses everything
        if ((int) $user->role_id === 1) {
            return $next($request);
        }

        // If no permission was passed → allow route
        if (!$permission) {
            return $next($request);
        }

        // Get assigned permissions
        $permissions = json_decode($user->permissions ?? '[]', true);

        // Check if permission exists for this user
        if (!in_array($permission, $permissions)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
