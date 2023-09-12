<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkautheVirwSpecificProject
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

        $slug = $request->route('slug');
        $user = Auth::user();
        if ($slug) {
            $project = Project::where('slug', $slug)->first();
            if ($user->role != 1 && $user->id != $project->user_id) {
                abort(404, 'You do not have permission to login to this page');
            } else {
                return $next($request);
            }
        } else {
            if ($user->role != 1) {
                abort(404, 'You do not have permission to login to this page');
            } else {
                return $next($request);
            }
        }
    }
}
