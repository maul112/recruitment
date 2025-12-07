<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    // Menampilkan daftar lowongan aktif
    public function index()
    {
        $lowongans = Lowongan::where('tanggal_tutup', '>=', now())
                              ->orderBy('tanggal_buka', 'desc')
                              ->get();

        return view('pelamar.lowongan', compact('lowongans'));
    }

    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $pelamar = auth()->user()->pelamar;
    
        // Cek profil dasar
        if(!$pelamar || !$pelamar->nama_lengkap || !$pelamar->nik || !$pelamar->tanggal_lahir || !$pelamar->alamat){
            return redirect()->route('pelamar.profile')
                ->with('error','Harap lengkapi profil dasar Anda terlebih dahulu!');
        }
    
        // Dokumen yang diminta admin, misal tersimpan di kolom JSON 'required_documents'
        // Contoh: ["cv_path","pas_foto_path","transkrip_path"]
        $requiredDocuments = $lowongan->required_documents ? json_decode($lowongan->required_documents) : [];
    
        return view('pelamar.lowongan_detail', compact('lowongan','pelamar','requiredDocuments'));
    }

    // Mengajukan lamaran
    public function apply($lowonganId)
    {
        $user = auth()->user();

        // Pastikan profil pelamar ada
        if (!$user->pelamar) {
            return redirect()->route('pelamar.profile')->with('error', 'Lengkapi profil pelamar terlebih dahulu.');
        }

        // Cek duplikasi lamaran
        $exists = Lamaran::where('pelamar_id', $user->pelamar->id)
                        ->where('lowongan_id', $lowonganId)
                        ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah melamar lowongan ini.');
        }

        Lamaran::create([
            'pelamar_id' => $user->pelamar->id,
            'lowongan_id' => $lowonganId,
            'status' => 'terkirim'
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    public function riwayat()
    {
        $pelamar = auth()->user()->pelamar;

        if (!$pelamar) {
            return redirect()->route('pelamar.profile')
                ->with('error','Lengkapi profil terlebih dahulu untuk melihat riwayat lamaran.');
        }

        // Ambil semua lamaran beserta lowongan terkait
        $lamarans = $pelamar->lamarans()->with('lowongan')->orderBy('created_at','desc')->get();

        return view('pelamar.riwayat_lamaran', compact('lamarans'));
    }

    public function detail($id)
    {
        $lamaran = Lamaran::with('lowongan', 'pelamar')->findOrFail($id);

        // Pastikan hanya pemilik lamaran yang bisa mengakses
        if ($lamaran->pelamar->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pelamar.lamaran_detail', compact('lamaran'));
    }

}
