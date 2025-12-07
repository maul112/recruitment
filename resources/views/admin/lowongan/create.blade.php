@extends('layouts.admin')

@section('title','Tambah Lowongan')

@section('content')
<form class="form-content" method="POST" action="/admin/lowongan/store">
    @csrf

    <label>Posisi</label>
    <input type="text" 
           name="posisi" 
           value="{{ old('posisi') }}" 
           required>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>

    <label>Kualifikasi Pendidikan</label>
    <input type="text" 
           name="kualifikasi_pendidikan" 
           value="{{ old('kualifikasi_pendidikan') }}">

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label>Tanggal Buka</label>
            <input type="date" 
                   name="tanggal_buka" 
                   value="{{ old('tanggal_buka') }}">
        </div>

        <div style="flex:1;">
            <label>Tanggal Tutup</label>
            <input type="date" 
                   name="tanggal_tutup" 
                   value="{{ old('tanggal_tutup') }}">
        </div>
    </div>

    <label>Dokumen Wajib</label>
    <textarea name="dokumen_wajib" rows="3">{{ old('dokumen_wajib') }}</textarea>

    <div style="display:flex; gap:15px;">
        <div style="flex:1;">
            <label>Kuota</label>
            <input type="number" 
                   name="kuota" 
                   min="1"
                   value="{{ old('kuota', 1) }}">
        </div>

        <div style="flex:1;">
            <label>Status</label>
            <select name="status">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="closed">Closed</option>
            </select>
        </div>
    </div>

    <!-- Tombol sejajar: Kembali kiri, Simpan kanan -->
    <div style="display:flex; width:100%; margin-top:10px; gap:5px;">
        <a href="{{ url('/admin/lowongan') }}" 
            class="btn" 
            style="flex:1; background:#f3f4f6; color:#111; padding:10px 0; border-radius:8px; text-align:center;">
            Kembali
        </a>

        <button type="submit" 
                class="btn" 
                style="flex:1; background:#2563eb; color:white; padding:10px 0; border-radius:8px; text-align:center;">
            Simpan Lowongan
        </button>
    </div>

</form>
@endsection
