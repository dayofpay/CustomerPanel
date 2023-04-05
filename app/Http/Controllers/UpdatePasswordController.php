<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();


        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors([
                'old_password' => 'Старата парола е невярна.'
            ]);
        }

 
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

 
        Auth::logout();


        return redirect()->route('login')->withSuccess('Паролата ви беше сменена');
    }
}
