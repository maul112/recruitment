<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wawancara;
use App\Models\Lamaran;
use Illuminate\Validation\ValidationException;

class WawancaraController extends Controller
{
    // List semua wawancara
    public function index()
    {
        $wawancara = Wawancara::with('lamaran.pelamar', 'lamaran.lowongan')->get();
        return view('admin.wawancara.index', compact('wawancara'));
    }

    // Form buat wawancara baru
    public function create()
    {
        $lamaran = Lamaran::where('status', 'psikotes')
        ->whereDoesntHave('wawancara')
        ->get();
        return view('admin.wawancara.create', compact('lamaran'));
    }

    // Simpan wawancara
    public function store(Request $request)
    {
        // dd($request->all());
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
        $wawancara = Wawancara::with('lamaran.pelamar', 'lamaran.lowongan')->findOrFail($id);

        // Aspek yang dinilai
        $aspek = 
        [
            "komunikasi",
            "pengetahuan_teknis",
            "pengalaman_kerja",
            "problem_solving",
            "sikap_etika_kerja",
            "kepercayaan_diri",
            "adaptabilitas"
        ];

        $deskripsi = [
            "Kejelasan, cara menjawab, bahasa tubuh",
            "Pemahaman terkait posisi yang dilamar",
            "Relevansi dan kedalaman pengalaman",
            "Kemampuan memecahkan masalah",
            "Motivasi, disiplin, kerja sama",
            "Pembawaan diri saat wawancara",
            "Kemampuan menyesuaikan diri",
        ];

        return view('admin.wawancara.show', compact('wawancara','aspek', 'deskripsi'));
    }

    // Update penilaian wawancara
    public function update(Request $request, $id)
    {
        $wawancara = Wawancara::findOrFail($id);

        $kriteria = [
            'nilai_komunikasi',
            'nilai_pengetahuan_teknis',
            'nilai_pengalaman_kerja',
            'nilai_problem_solving',
            'nilai_sikap_etika_kerja',
            'nilai_kepercayaan_diri',
            'nilai_adaptabilitas'
        ];

        
        $data_kriteria = $request->only($kriteria);
        $nilai_kriteria = collect($data_kriteria)->map(function ($nilai) {
            return (int) $nilai;
        });
        $nilai_rata_rata = collect($nilai_kriteria)->avg();
        $request->merge(['nilai' => (int) round($nilai_rata_rata)]);
        try{
            $request->validate([
                'nilai_komunikasi' => 'required|integer|min:10|max:100',
                'nilai_pengetahuan_teknis' => 'required|integer|min:10|max:100',
                'nilai_pengalaman_kerja' => 'required|integer|min:10|max:100',
                'nilai_problem_solving' => 'required|integer|min:10|max:100',
                'nilai_sikap_etika_kerja' => 'required|integer|min:10|max:100',
                'nilai_kepercayaan_diri' => 'required|integer|min:10|max:100',
                'nilai_adaptabilitas' => 'required|integer|min:10|max:100',
                'nilai' => 'required|integer|min:10|max:100',
                'komentar' => 'nullable|string'
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('admin.wawancara.show',$wawancara->id)->with('error','Terjadi kesalahan saat update penilaian wawancara.');
        }

        $wawancara->update($request->all());

        // Update status lamaran
        $lamaran = $wawancara->lamaran;
        if ($nilai_rata_rata > 75) {
            $lamaran->update(['status' => 'lulus']);
        } else {
            $lamaran->update(['status' => 'ditolak_akhir']);
        }

        // Update nilai wawancara
        $lamaran->update(['nilai_wawancara' => $nilai_rata_rata]);

        return redirect()->route('admin.wawancara.show',$wawancara->id)->with('success','Penilaian wawancara berhasil disimpan.');
    }
}
