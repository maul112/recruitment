<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Pelamar;
use App\Models\Lowongan;

class LamaranController extends Controller
{
    public function index()
    {
        $lamarans = Lamaran::with(['pelamar', 'lowongan'])->orderBy('tanggal_daftar', 'desc')->get();
        return view('admin.lamaran.index', compact('lamarans'));
    }

    public function edit($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $pelamars = Pelamar::all();
        $lowongans = Lowongan::all();
        return view('admin.lamaran.edit', compact('lamaran', 'pelamars', 'lowongans'));
    }

    public function update(Request $request, $id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'nilai_administrasi' => $request->nilai_administrasi ?? 0,
            'nilai_psikotes' => $request->nilai_psikotes ?? 0,
            'nilai_wawancara' => $request->nilai_wawancara ?? 0,
            'total_nilai' => ($request->nilai_administrasi ?? 0) + ($request->nilai_psikotes ?? 0) + ($request->nilai_wawancara ?? 0)
        ]);

        return redirect()->route('admin.lamaran.index')->with('success', 'Lamaran berhasil diperbarui.');
    }
}
