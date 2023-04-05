<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\Request;
class Projects extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $projects = Project::where('customer', $user->email)->get();
        return view('/home', ['projects' => $projects]);
    }
    
    
}
