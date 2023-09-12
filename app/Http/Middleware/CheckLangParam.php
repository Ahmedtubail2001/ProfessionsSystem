<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLangParam
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
        app()->setlocale('en');
        if (in_array($request->lang, ['ar'])) {
            if ($request->query->has('lang') && $request->lang == 'ar') {
                app()->setlocale('ar');
            } else {
                return response()->json([
                    "message" => "Undefined language Please select the language"
                ], 404);
            }
        }



        return $next($request);
    }
}
