<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();

        if ($user->role_id != $role) {
            return abort(403); // Redirect to home or some other page if the user does not have the required role
        }
        return $next($request);
    }
}
