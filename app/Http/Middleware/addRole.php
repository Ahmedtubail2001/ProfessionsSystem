<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class addRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::guard('higher_admin'));

        if (Auth::guard('admin')->user()->role_name == 'hight level admin') {
            Auth::guard('admin')->user()->assignRole('hight level admin');
        } elseif (Auth::guard('admin')->user()->role_name == 'normal admin') {
            Auth::guard('admin')->user()->assignRole('normal admin');
        }
        return $next($request);
    }
}
