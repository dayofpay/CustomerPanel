<?php

namespace App\Http\Controllers;

use App\Models\LogLogs as LoginLogsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginLogs extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $logs = LoginLogsModel::where('user', $user->email)->get();
        return view('settings', ['logs' => $logs]);

    }
}
