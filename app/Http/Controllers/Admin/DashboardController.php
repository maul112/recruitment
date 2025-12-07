<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(!Auth::check() || Auth::user()->role != 'admin'){
            return redirect('/login')->with('error','Akses ditolak!');
        }

        return view('admin.dashboard');
    }
}
