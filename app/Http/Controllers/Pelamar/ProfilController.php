<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $pelamar = auth()->user()->pelamar;
        return view('pelamar.profile', compact('pelamar'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validasi
        $request->validate([
            'nik' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:500',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'prodi' => 'nullable|string|max:255',
            'universitas' => 'nullable|string|max:255',
            'cv_path' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah_path' => 'nullable|file|mimes:pdf|max:2048',
            'transkrip_path' => 'nullable|file|mimes:pdf|max:2048',
            'pas_foto_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'sertifikat_path' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Ambil pelamar existing atau buat baru
        $pelamar = Pelamar::firstOrNew(['user_id' => $user->id]);
        
        // Set data
        $pelamar->nama_lengkap = $user->name; // otomatis dari user
        $user->name = $request->nama_lengkap;
        $pelamar->nik = $request->nik;
        $pelamar->tanggal_lahir = $request->tanggal_lahir;
        $pelamar->jenis_kelamin = $request->jenis_kelamin;
        $pelamar->alamat = $request->alamat;
        $pelamar->pendidikan_terakhir = $request->pendidikan_terakhir;
        $pelamar->prodi = $request->prodi;
        $pelamar->universitas = $request->universitas;
    
        // Upload file jika ada
        $files = ['cv_path','ijazah_path','transkrip_path','pas_foto_path','sertifikat_path'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                if ($pelamar->$file && Storage::disk('public')->exists($pelamar->$file)) {
                    Storage::disk('public')->delete($pelamar->$file);
                }
                $pelamar->$file = $request->file($file)->store('pelamars', 'public');
            }
        }
    
        $pelamar->save(); // ✅ Insert atau update
        $user->save();
    
        return redirect()->route('pelamar.profile')->with('success','Profil berhasil diperbarui!');
    }
}
