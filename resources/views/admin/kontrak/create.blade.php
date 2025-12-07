@extends('layouts.admin')

@section('title','Tambah Kontrak')

@section('content')
<h3>Tambah Kontrak</h3>

<form action="{{ route('admin.kontrak.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Lamaran Pelamar:</label>
    <select name="lamaran_id" required>
        @foreach($lamaran as $l)
        <option value="{{ $l->id }}">{{ $l->pelamar->nama }} - {{ $l->posisi }}</option>
        @endforeach
    </select>
    <br>

    <label>File Kontrak:</label>
    <input type="file" name="file_kontrak" required>
    <br>

    <label>Signature (opsional):</label>
    <input type="file" name="signature">
    <br>

    <label>Tanggal Ditandatangani (opsional):</label>
    <input type="datetime-local" name="signed_at">
    <br>

    <label>Status:</label>
    <select name="status">
        <option value="belum">Belum</option>
        <option value="ditandatangani">Ditandatangani</option>
    </select>
    <br>

    <button type="submit">Simpan Kontrak</button>
</form>
@endsection
