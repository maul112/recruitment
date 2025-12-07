<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontrak;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Storage;

class KontrakController extends Controller
{
    // List semua kontrak
    public function index()
    {
        $kontrak = Kontrak::with('lamaran.pelamar')->get();
        return view('admin.kontrak.index', compact('kontrak'));
    }

    // Form tambah kontrak
    public function create()
    {
        $lamaran = Lamaran::where('status', 'lolos_seleksi')->get();
        return view('admin.kontrak.create', compact('lamaran'));
    }

    // Simpan kontrak
    public function store(Request $request)
    {
        $request->validate([
            'lamaran_id' => 'required|exists:lamarans,id',
            'file_kontrak' => 'required|file|mimes:pdf,doc,docx',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $filePath = $request->file('file_kontrak')->store('kontrak','public');
        $signaturePath = $request->hasFile('signature') ? $request->file('signature')->store('signature','public') : null;

        Kontrak::create([
            'lamaran_id' => $request->lamaran_id,
            'file_kontrak_path' => $filePath,
            'signature_path' => $signaturePath,
            'signed_at' => $request->signed_at ?? null,
            'status' => $request->status ?? 'belum'
        ]);

        return redirect()->route('admin.kontrak.index')->with('success', 'Kontrak berhasil ditambahkan.');
    }

    // Detail kontrak
    public function show($id)
    {
        $kontrak = Kontrak::with('lamaran.pelamar')->findOrFail($id);
        return view('admin.kontrak.show', compact('kontrak'));
    }

    // Update kontrak
    public function update(Request $request, $id)
    {
        $kontrak = Kontrak::findOrFail($id);

        $request->validate([
            'file_kontrak' => 'nullable|file|mimes:pdf,doc,docx',
            'signature' => 'nullable|image|mimes:png,jpg,jpeg',
            'signed_at' => 'nullable|date',
            'status' => 'required|in:belum,ditandatangani'
        ]);

        if($request->hasFile('file_kontrak')){
            Storage::disk('public')->delete($kontrak->file_kontrak_path);
            $kontrak->file_kontrak_path = $request->file('file_kontrak')->store('kontrak','public');
        }

        if($request->hasFile('signature')){
            Storage::disk('public')->delete($kontrak->signature_path);
            $kontrak->signature_path = $request->file('signature')->store('signature','public');
        }

        $kontrak->signed_at = $request->signed_at;
        $kontrak->status = $request->status;
        $kontrak->save();

        return redirect()->route('admin.kontrak.show', $kontrak->id)->with('success','Kontrak berhasil diperbarui.');
    }
}
