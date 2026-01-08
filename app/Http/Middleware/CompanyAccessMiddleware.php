<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = Auth::user();

        // Allow super admin even without company_id
        if ($user->role_id == 1) {
            return $next($request);
        }

        // Block users without company
        if (!$user->company_id) {
            abort(403, "This account is not associated with any company.");
        }

        return $next($request);
    }
}
