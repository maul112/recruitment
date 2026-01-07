<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Psikotes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(!Auth::check() || Auth::user()->role != 'admin'){
            return redirect('/login')->with('error','Akses ditolak!');
        }
        
        $totalPelamar = User::where('role', 'pelamar')->count();
        $lowonganAktif = Lowongan::where([
            ['status', '=', 'published'],
            ['tanggal_tutup', '>=', now()],
            ['tanggal_buka', '<=', now()],
        ])->count();
        $sudahTes = Psikotes::count();
        $diterima = User::where('role', 'pelamar')
            ->whereHas('pelamar.lamarans', function ($query) {
                $query->where('status', 'lulus');
            })
            ->count();

        return view('admin.dashboard', compact('totalPelamar', 'lowonganAktif', 'sudahTes', 'diterima'));
    }
}
