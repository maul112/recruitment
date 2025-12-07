<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // ambil user login
        $lamarans = Lamaran::where('pelamar_id', $user->pelamar->id ?? 0)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('pelamar.dashboard', compact('lamarans'));
    }
}
