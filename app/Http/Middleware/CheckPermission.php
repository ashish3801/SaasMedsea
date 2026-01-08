<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // return $next($request);
        $user = Auth::user();
        
       if ((int) $user->role_id === 1) {
            return $next($request);
        }
            
        $permissions = json_decode($user->permissions ?? '[]', true);
        if (!in_array($permission, $permissions)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
