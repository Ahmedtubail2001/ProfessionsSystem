<?php

namespace App\Http\Middleware;

use App\Models\Worker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class check_if_owner_profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if ($role == 'worker') {
            $slug = $request->route('slug');
            $worker = Worker::where('slug', $slug)->first();
            if ($user->id != $worker->user_id) {
                abort(403, 'Unauthorized action.');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
