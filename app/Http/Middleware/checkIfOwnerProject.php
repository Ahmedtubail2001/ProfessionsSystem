<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class checkIfOwnerProject
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
        $project = Project::where('slug', $slug)->first();

        if (!$project) {
            // Project not found, return a response indicating it doesn't exist
            return response()->json(['message' => 'Project not found.'], 404);
        }
        if ($request->user()->id != $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
