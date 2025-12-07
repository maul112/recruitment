<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email','password')))
        {
            if(auth()->user()->role == 'admin'){
                return redirect('/admin/dashboard');
            }

            if(auth()->user()->role == 'pelamar'){
                return redirect('/pelamar/dashboard');
            }
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
