<?php

namespace App\Http\Middleware\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUsersLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (!$request->session()->has('users')) {
            return redirect('login')->with('resp_msg', 'Your session has expired');
        }
        if (in_array(session('users')[0]['id_role'], $role)) {
            return $next($request);
        }
        // dd($request, session('users')[0]['id_role']); 
        return redirect('login');
        
    }
}
