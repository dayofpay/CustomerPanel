<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function changePassword(Request $request)
    {
        $user = Auth::user();
    
        // Validate the old password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors([
                'old_password' => 'The old password is incorrect.'
            ]);
        }
    
        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
    
        // Log the user out
        Auth::logout();
    
        // Redirect the user to the login page
        return redirect()->route('login')->withSuccess('Your password has been changed.');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return view('home');
        }
    }
}
