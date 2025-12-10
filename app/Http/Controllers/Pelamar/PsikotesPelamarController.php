<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalPsikotes;
use App\Models\Psikotes;
use App\Models\JawabanPsikotes;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PsikotesPelamarController extends Controller
    {
        /**
         * Menampilkan daftar soal psikotes untuk pelamar.
         */
    public function index()
    {
        $daftar_tipe = SoalPsikotes::select('tipe')
            ->selectRaw('COUNT(*) as jumlah')
            ->selectRaw('MAX(durasi) as durasi')
            ->groupBy('tipe')
            ->get();

    $pelamar = Auth::user()->pelamar; 
    $lamaran = Lamaran::where('pelamar_id', $pelamar->id)
        ->orderBy('id', 'desc')
        ->first();

    $psikotes_selesai = Psikotes::where('lamaran_id', $lamaran->id ?? 0)
        ->where('status', 'selesai')
        ->with('jawaban.soal') // load soal melalui jawaban
        ->get()
        ->pluck('jawaban.*.soal.tipe') // ambil semua tipe soal
        ->flatten() // gabungkan semua array
        ->unique() // hapus tipe duplikat
        ->toArray();

        return view('pelamar.psikotes', compact('daftar_tipe', 'lamaran', 'psikotes_selesai'));
    }

    /**
     * Menangani submit psikotes pelamar.
     */
    public function submit(Request $request, $psikotes_id)
    {
        $psikotes = Psikotes::findOrFail($psikotes_id);
        $jawaban_input = $request->input('jawaban', []);

        $totalNilai = 0;

        foreach ($jawaban_input as $soal_id => $jawaban) {
            $soal = SoalPsikotes::find($soal_id);

            if (!$soal) continue;

            // Cek benar atau salah
            $isBenar = strtoupper($jawaban) === strtoupper($soal->kunci_jawaban);

            // Ambil bobot nilai
            $nilai = $isBenar ? ($soal->bobot ?? 1) : 0;

            // Simpan jawaban
            JawabanPsikotes::updateOrCreate(
                [
                    'psikotes_id' => $psikotes->id,
                    'soal_id'     => $soal->id,
                ],
                [
                    'jawaban' => $jawaban,
                    'benar'   => $isBenar ? 1 : 0,
                    'nilai'   => $nilai,
                ]
            );

            $totalNilai += $nilai;
        }

        // Hitung rekomendasi otomatis
        $rekomendasi = $this->generateRekomendasi($totalNilai);

        // Update hasil akhir
        $psikotes->update([
            'selesai_at'       => Carbon::now(),
            'skor_kognitif'    => $totalNilai,
            'rekomendasi'      => $rekomendasi,
            'status'           => 'selesai',
        ]);

        return redirect()->route('pelamar.psikotes.selesai', $psikotes->id)
            ->with('success', 'Psikotes berhasil diselesaikan!');
    }

    /**
     * Halaman selesai psikotes.
     */
    public function selesai($id)
    {
        $psikotes = Psikotes::with('jawaban')->findOrFail($id);

        return view('pelamar.psikotes_selesai', compact('psikotes'));
    }

    /**
     * Logika menentukan rekomendasi.
     */
    private function generateRekomendasi($nilai)
    {
        if ($nilai >= 80)       return "sangat sesuai";
        if ($nilai >= 50)       return "cukup sesuai";
        return "kurang sesuai";
    }

    public function kerjakan($tipe)
{
        $pelamar = Auth::user()->pelamar; 
$lamaran = Lamaran::where('pelamar_id', $pelamar->id)
    ->orderBy('id', 'desc')
    ->first();

    if (!$lamaran) {
        return redirect()->back()->with('error', 'Lamaran tidak ditemukan.');
    }

    if ($lamaran->status !== 'psikotes') {
        return redirect()->back()->with('warning', 'Status anda masih diverifikasi oleh admin.');
    }

    // Soal berdasarkan tipe
    $soal = SoalPsikotes::where('tipe', $tipe)->get();

    if ($soal->isEmpty()) {
        return redirect()->back()->with('error', 'Soal tidak ditemukan.');
    }

    // Ambil tipe asli dari database
    $tipeFix = SoalPsikotes::where('tipe', $tipe)->value('tipe');

    // Ambil durasi
    $durasi = SoalPsikotes::where('tipe', $tipe)->max('durasi');

    // Buat record psikotes
    $psikotes = Psikotes::create([
        'lamaran_id' => $lamaran->id,
        'mulai_at'   => Carbon::now(),
        'status'     => 'berlangsung',
    ]);

    return view('pelamar.psikotes_kerjakan', [
        'soal'      => $soal,
        'durasi'    => $durasi,
        'psikotes'  => $psikotes,
        'tipe'       => $tipeFix
    ]);
}


}
