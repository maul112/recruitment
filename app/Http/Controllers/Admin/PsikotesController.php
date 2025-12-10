<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Psikotes;
use App\Models\Lamaran;
use App\Models\SoalPsikotes;
use App\Models\JawabanPsikotes;

class PsikotesController extends Controller
{
    // List semua psikotes
    public function index()
    {
        $psikotes = Psikotes::with('lamaran.pelamar')->paginate(5);
        $soal = SoalPsikotes::paginate(5);
        return view('admin.psikotes.index', compact('psikotes', 'soal'));
    }

    // Buat psikotes baru untuk lamaran tertentu
    public function create()
    {
        $lamaran = Lamaran::where('status', 'lolos_administrasi')->get();
        return view('admin.psikotes.create', compact('lamaran'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tipe'          => 'required|in:kepribadian,logika,numerik,verbal,analitis',
            'durasi'        => 'required|integer|min:1',
            'pertanyaan'    => 'required',
            'pilihan_a'     => 'nullable|string',
            'bobot_a'       => 'required|integer',
            'pilihan_b'     => 'nullable|string',
            'bobot_b'       => 'required|integer',
            'pilihan_c'     => 'nullable|string',
            'bobot_c'       => 'required|integer',
            'pilihan_d'     => 'nullable|string',
            'bobot_d'       => 'required|integer',
            'kunci_jawaban' => 'nullable|in:A,B,C,D',
            'bobot'         => 'nullable|integer',
        ]);

        // Simpan ke table soal_psikotes
        SoalPsikotes::create([
            'tipe'          => $request->tipe,
            'durasi'        => $request->durasi,
            'pertanyaan'    => $request->pertanyaan,
            'pilihan_a'     => $request->pilihan_a,
            'bobot_a'       => $request->bobot_a,
            'pilihan_b'     => $request->pilihan_b,
            'bobot_b'       => $request->bobot_b,
            'pilihan_c'     => $request->pilihan_c,
            'bobot_c'       => $request->bobot_c,
            'pilihan_d'     => $request->pilihan_d,
            'bobot_d'       => $request->bobot_d,
            'kunci_jawaban' => $request->kunci_jawaban,
            'bobot'         => $request->bobot ?? 1,
        ]);

        return redirect()->route('admin.psikotes.index')
            ->with('success', 'Soal psikotes berhasil ditambahkan.');
    }


    // Tampilkan detail psikotes beserta jawaban pelamar
    public function show($id)
    {
        $psikotes = Psikotes::with('lamaran.pelamar', 'jawaban.soal')->findOrFail($id);
        return view('admin.psikotes.show', compact('psikotes'));
    }

    // Nilai otomatis psikotes
    public function nilai(Psikotes $psikotes)
    {
        $jawaban = $psikotes->jawaban;
        $total_skor = 0;

        foreach ($jawaban as $j) {
            if($j->jawaban == $j->soal->kunci_jawaban) {
                $j->benar = 1;
                $j->nilai = $j->soal->bobot;
            } else {
                $j->benar = 0;
                $j->nilai = 0;
            }
            $j->save();
            $total_skor += $j->nilai;
        }

        $psikotes->skor_kognitif = $total_skor;

        // Contoh sederhana rekomendasi
        if($total_skor >= 80) {
            $psikotes->rekomendasi = 'Sangat Sesuai';
        } elseif($total_skor >= 50) {
            $psikotes->rekomendasi = 'Cukup Sesuai';
        } else {
            $psikotes->rekomendasi = 'Kurang Sesuai';
        }

        $psikotes->status = 'selesai';
        $psikotes->save();

        return redirect()->route('admin.psikotes.show', $psikotes->id)->with('success', 'Psikotes dinilai.');
    }

    public function editSoal($id)
    {
        $soal = SoalPsikotes::findOrFail($id);
        return view('admin.psikotes.edit', compact('soal'));
    }

    public function updateSoal(Request $request, $id)
    {
        $request->validate([
            'tipe'          => 'required|in:kepribadian,logika,numerik,verbal,analitis',
            'durasi'        => 'required|integer|min:1',
            'pertanyaan'    => 'required',
            'pilihan_a'     => 'nullable|string',
            'bobot_a'       => 'required|integer',
            'pilihan_b'     => 'nullable|string',
            'bobot_b'       => 'required|integer',
            'pilihan_c'     => 'nullable|string',
            'bobot_c'       => 'required|integer',
            'pilihan_d'     => 'nullable|string',
            'bobot_d'       => 'required|integer',
            'kunci_jawaban' => 'nullable|in:A,B,C,D',
            'bobot'         => 'nullable|integer',
        ]);
        $soal = SoalPsikotes::findOrFail($id);

        $soal->update([
            'tipe'          => $request->tipe,
            'durasi'          => $request->durasi,
            'pertanyaan'    => $request->pertanyaan,
            'pilihan_a'     => $request->pilihan_a,
            'bobot_a'       => $request->bobot_a,
            'pilihan_b'     => $request->pilihan_b,
            'bobot_b'       => $request->bobot_b,
            'pilihan_c'     => $request->pilihan_c,
            'bobot_c'       => $request->bobot_c,
            'pilihan_d'     => $request->pilihan_d,
            'bobot_d'       => $request->bobot_d,
            'kunci_jawaban' => $request->kunci_jawaban,
            'bobot'         => $request->bobot ?? 1,
        ]);

        return redirect()->route('admin.psikotes.index')
            ->with('success', 'Soal psikotes berhasil diperbarui.');
    }

    public function deleteSoal($id)
    {
        $soal = SoalPsikotes::findOrFail($id);
        $soal->delete();

        return redirect()->route('admin.psikotes.index')
            ->with('success', 'Soal psikotes berhasil dihapus.');
    }
}
