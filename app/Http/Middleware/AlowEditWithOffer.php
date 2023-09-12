<?php

namespace App\Http\Middleware;

use App\Models\Offer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlowEditWithOffer
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
        $slug = $request->route('offer');
        $offer = Offer::where('slug', $slug)->first();

        if (!$offer || $offer->user_id != Auth::user()->id) {
            abort(404, "unAuthorized with Edit");
        }
        return $next($request);
    }
}
