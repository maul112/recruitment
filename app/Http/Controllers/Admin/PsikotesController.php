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
        $psikotes = Psikotes::with('lamaran.pelamar')->get();
        return view('admin.psikotes.index', compact('psikotes'));
    }

    // Buat psikotes baru untuk lamaran tertentu
    public function create()
    {
        $lamaran = Lamaran::where('status', 'lolos_administrasi')->get();
        return view('admin.psikotes.create', compact('lamaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lamaran_id' => 'required|exists:lamarans,id',
            'mulai_at' => 'nullable|date',
            'selesai_at' => 'nullable|date',
        ]);

        Psikotes::create($request->all());

        return redirect()->route('admin.psikotes.index')->with('success', 'Psikotes berhasil dibuat.');
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
}
