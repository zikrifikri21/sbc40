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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $level = Auth::user()->user_level->id_user_level;

        if ($level != 1 && $level != 11) {
            return redirect('/dashboard')->with('error', 'Oupss... You are not authorized to access this page');
        }

        return $next($request);
    }
}
