<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use App\Models\Pelamar;

class PelamarsController extends Controller
{
    // Daftar semua pelamar
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status');
    
        $query = Pelamar::with('user')->has('lamarans'); // include relasi user jika perlu
    
        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('nama_lengkap', 'like', "%{$q}%")
                    ->orWhere('nik', 'like', "%{$q}%")
                    ->orWhere('pendidikan_terakhir', 'like', "%{$q}%");
            });
        }
    
        if ($status && in_array($status, ['pending','valid','tidak_valid'])) {
            $query->where('status_verifikasi', $status);
        }
    
        // urut terbaru
        $pelamars = $query->orderBy('created_at','desc')->paginate(10)->withQueryString();
    
        return view('admin.pelamar.index', compact('pelamars','q','status'));
    }

    // Tampilkan detail pelamar
    public function show($id) {
        $pelamar = Pelamar::with('user', 'lamarans.lowongan')->findOrFail($id);
        $lowonganPertama = $pelamar->lamarans->first()->lowongan ?? null;
        return view('admin.pelamar.show', compact('pelamar', 'lowonganPertama'));
    }

    // Ubah status verifikasi
    public function updateStatus(Request $request, $id) {
        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status_verifikasi = $request->status;
        $pelamar->save();
        $lamaran = Lamaran::where('pelamar_id', $id)->first();

        // Update status lamaran
        if ($request->status == 'valid') {
            $lamaran->update(['status' => 'verifikasi']);
        } else if ($request->status == 'tidak_valid') {
            $lamaran->update(['status' => 'ditolak_adm']);
        } else {
            $lamaran->update(['status' => 'terkirim']);
        }

        return redirect()->route('admin.pelamar.index')->with('success', 'Status verifikasi berhasil diperbarui');
    }

    // Hapus pelamar
    public function destroy($id) {
        $pelamar = Pelamar::findOrFail($id);
        $pelamar->delete();

        return redirect()->back()->with('success', 'Pelamar berhasil dihapus');
    }
}
