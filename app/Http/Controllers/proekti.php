<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\dataProjects;
use App\Models\ChangeLogP;
class proekti extends Controller
{
    public function show($userId, $projectId)
    {
        $user = Auth::user();
        $projectData = Project::where('customer_id', $user->id)->where('id', $projectId)->first();
        $cData = Project::where('id', $projectId)->first();
        $changeLogData = ChangeLogP::where('project_id', $cData->id)->get();    

        if (!$projectData) {
            return redirect('/');
        }
    
        return view('projects', ['changeLogData' => $changeLogData, 'projectData' => $projectData]);
    }
    
    
    
}
