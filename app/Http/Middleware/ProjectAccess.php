<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectId = $request->route('projectId');
        $projectData = Project::where('customer_id', Auth::user()->id)->where('id', $projectId)->first();

        if (!$projectData) {
            return redirect('/');
        }
        $request->attributes->add(['projectData' => $projectData]);

        return $next($request);
    }
}
