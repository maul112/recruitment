<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wawancara;
use App\Models\Lamaran;

class WawancaraController extends Controller
{
    // List semua wawancara
    public function index()
    {
        $wawancara = Wawancara::with('lamaran.pelamar')->get();
        return view('admin.wawancara.index', compact('wawancara'));
    }

    // Form buat wawancara baru
    public function create()
    {
        $lamaran = Lamaran::where('status', 'psikotes')->get();
        return view('admin.wawancara.create', compact('lamaran'));
    }

    // Simpan wawancara
    public function store(Request $request)
    {
        $request->validate([
            'lamaran_id' => 'required|exists:lamarans,id',
            'tipe' => 'required|in:HRD,Kepala Sekolah,Microteaching',
            'jadwal' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'nilai' => 'nullable|integer|min:10|max:100',
            'komentar' => 'nullable|string'
        ]);

        Wawancara::create($request->all());
        return redirect()->route('admin.wawancara.index')->with('success', 'Wawancara berhasil dibuat.');
    }

    // Detail & Penilaian Wawancara
    public function show($id)
    {
        $wawancara = Wawancara::with('lamaran.pelamar')->findOrFail($id);

        // Aspek yang dinilai
        $aspek = [
            'Komunikasi',
            'Pengetahuan Teknis',
            'Pengalaman Kerja',
            'Problem Solving',
            'Sikap & Etika Kerja',
            'Kepercayaan Diri',
            'Adaptabilitas'
        ];

        return view('admin.wawancara.show', compact('wawancara','aspek'));
    }

    // Update penilaian wawancara
    public function update(Request $request, $id)
    {
        $wawancara = Wawancara::findOrFail($id);

        $request->validate([
            'nilai' => 'required|integer|min:10|max:100',
            'komentar' => 'nullable|string'
        ]);

        $wawancara->update($request->only('nilai','komentar'));

        return redirect()->route('admin.wawancara.show',$wawancara->id)->with('success','Penilaian wawancara berhasil disimpan.');
    }
}
