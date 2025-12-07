@extends('layouts.admin')

@section('title','Edit Lowongan')

@section('content')
<form class="form-content" method="POST" action="/admin/lowongan/update/{{ $lowongan->id }}">
    @csrf

    <label>Posisi</label>
    <input type="text" 
           name="posisi" 
           value="{{ old('posisi', $lowongan->posisi) }}" 
           required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="4">{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>

    <label>Kualifikasi Pendidikan</label>
    <input type="text" 
           name="kualifikasi_pendidikan" 
           value="{{ old('kualifikasi_pendidikan', $lowongan->kualifikasi_pendidikan) }}">

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label>Tanggal Buka</label>
            <input type="date" 
                   name="tanggal_buka" 
                   value="{{ old('tanggal_buka', $lowongan->tanggal_buka) }}">
        </div>

        <div style="flex:1;">
            <label>Tanggal Tutup</label>
            <input type="date" 
                   name="tanggal_tutup" 
                   value="{{ old('tanggal_tutup', $lowongan->tanggal_tutup) }}">
        </div>
    </div>

    <label>Dokumen Wajib</label>
    <textarea name="dokumen_wajib" rows="3">{{ old('dokumen_wajib', $lowongan->dokumen_wajib) }}</textarea>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label>Kuota</label>
            <input type="number" 
                   name="kuota" 
                   min="1"
                   value="{{ old('kuota', $lowongan->kuota) }}">
        </div>

        <div style="flex:1;">
            <label>Status</label>
            <select name="status">
                <option value="draft" {{ old('status', $lowongan->status)=='draft'?'selected':'' }}>Draft</option>
                <option value="published" {{ old('status', $lowongan->status)=='published'?'selected':'' }}>Published</option>
                <option value="closed" {{ old('status', $lowongan->status)=='closed'?'selected':'' }}>Closed</option>
            </select>
        </div>
    </div>

    <!-- Tombol sejajar: Kembali kiri, Update kanan -->
    <div style="display:flex; width:100%; margin-top:10px; gap:5px;">
        <a href="{{ url('/admin/lowongan') }}" 
           class="btn" 
           style="flex:1; background:#f3f4f6; color:#111; padding:10px 0; border-radius:8px; text-align:center;">
           Kembali
        </a>

        <button type="submit" 
                class="btn" 
                style="flex:1; background:#2563eb; color:white; padding:10px 0; border-radius:8px; text-align:center;">
            Update Data
        </button>
    </div>

</form>
@endsection
