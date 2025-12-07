<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganController extends Controller
{
    // Tampilkan semua lowongan
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status');
    
        $query = Lowongan::query();
    
        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('posisi', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('kualifikasi_pendidikan', 'like', "%{$q}%");
            });
        }
    
        if ($status && in_array($status, ['draft','published','closed'])) {
            $query->where('status', $status);
        }
    
        // urut terbaru dulu
        $lowongans = $query->orderBy('created_at','desc')->paginate(8)->withQueryString();
    
        return view('admin.lowongan.index', compact('lowongans','q','status'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.lowongan.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kualifikasi_pendidikan' => 'nullable|string|max:150',
            'tanggal_buka' => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
            'dokumen_wajib' => 'nullable|string',
            'kuota' => 'nullable|integer|min:1',
            'status' => 'nullable|in:draft,published,closed'
        ]);

        Lowongan::create([
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'kualifikasi_pendidikan' => $request->kualifikasi_pendidikan,
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'dokumen_wajib' => $request->dokumen_wajib,
            'kuota' => $request->kuota ?? 1, // default 1 jika kosong
            'status' => $request->status ?? 'draft', // default draft
            'created_by' => auth()->user()->id
        ]);

        return redirect('/admin/lowongan')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    // Form Edit
    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);
    
        $request->validate([
            'posisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kualifikasi_pendidikan' => 'nullable|string|max:150',
            'tanggal_buka' => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
            'dokumen_wajib' => 'nullable|string',
            'kuota' => 'nullable|integer|min:1',
            'status' => 'nullable|in:draft,published,closed'
        ]);
    
        $lowongan->update([
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'kualifikasi_pendidikan' => $request->kualifikasi_pendidikan,
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'dokumen_wajib' => $request->dokumen_wajib,
            'kuota' => $request->kuota ?? 1,
            'status' => $request->status ?? 'draft',
            // jangan ubah created_by saat update, hanya bisa ubah jika memang perlu
        ]);
    
        return redirect('/admin/lowongan')->with('success','Lowongan berhasil diupdate!');
    }    

    // Hapus
    public function destroy($id)
    {
        Lowongan::findOrFail($id)->delete();
        return redirect('/admin/lowongan')->with('success','Lowongan berhasil dihapus!');
    }
}
