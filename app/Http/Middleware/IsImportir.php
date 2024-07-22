<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class IsImportir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $level = Auth::user()->user_level->id_user_level;

        if($level != 13 && $level != 15 && $level != 17 && $level != 18) {
            return redirect('/dashboard')->with('error', 'Oupss... You are not authorized to access this page');
        }

        return $next($request);
    }
}
