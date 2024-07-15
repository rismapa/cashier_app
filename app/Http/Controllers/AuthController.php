<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // if ( Auth::user()->role_id == 1 ) {
            //     return redirect()->intended('/dashboard');
            // }

            return redirect()->intended('/dashboard');
        }

        return back()->with('failed', 'Login Failed');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
