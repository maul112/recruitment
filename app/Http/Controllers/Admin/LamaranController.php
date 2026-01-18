<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Pelamar;
use App\Models\Lowongan;

class LamaranController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status');

        $query = Lamaran::with(['pelamar', 'lowongan']);

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('tanggal_daftar', 'like', "%{$q}%");
            });
        }

        if ($status && in_array($status, ['terkirim','verifikasi','ditolak_adm','psikotes','wawancara','lulus','ditolak_akhir'])) {
            $query->where('status', $status);
        }

        $lamarans = $query->orderBy('tanggal_daftar', 'desc')->paginate(10)->withQueryString();

        return view('admin.lamaran.index', compact('lamarans', 'q', 'status'));
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

    public function report(Request $request)
    {
        $query = Lamaran::with(['pelamar', 'lowongan']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('lowongan_id') && $request->lowongan_id != '') {
            $query->where('lowongan_id', $request->lowongan_id);
        }

        $rekap = $query->latest()->get();
        $lowongans = Lowongan::all();

        return view('admin.lamaran.report', compact('rekap', 'lowongans'));
    }
}
