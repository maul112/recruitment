@extends('layouts.admin')

@section('title','Detail Kontrak')

@section('content')
<h3>Detail Kontrak</h3>

<div style="margin-bottom:20px;">
    <strong>Pelamar:</strong> {{ $kontrak->lamaran->pelamar->nama }} <br>
    <strong>Posisi:</strong> {{ $kontrak->lamaran->posisi }} <br>
    <strong>Status:</strong> {{ $kontrak->status }} <br>
    <strong>Tanggal Ditandatangani:</strong> {{ $kontrak->signed_at ?? '-' }} <br>
    <strong>File Kontrak:</strong> 
    @if($kontrak->file_kontrak_path)
        <a href="{{ asset('storage/'.$kontrak->file_kontrak_path) }}" target="_blank">Lihat</a>
    @endif
    <br>
    <strong>Signature:</strong> 
    @if($kontrak->signature_path)
        <img src="{{ asset('storage/'.$kontrak->signature_path) }}" alt="Signature" width="150">
    @endif
</div>

<hr>

<h4>Update Kontrak</h4>
<form action="{{ route('admin.kontrak.update', $kontrak->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Ganti File Kontrak:</label>
    <input type="file" name="file_kontrak">
    <br>

    <label>Ganti Signature:</label>
    <input type="file" name="signature">
    <br>

    <label>Tanggal Ditandatangani:</label>
    <input type="datetime-local" name="signed_at" value="{{ $kontrak->signed_at ? date('Y-m-d\TH:i', strtotime($kontrak->signed_at)) : '' }}">
    <br>

    <label>Status:</label>
    <select name="status">
        <option value="belum" {{ $kontrak->status=='belum'?'selected':'' }}>Belum</option>
        <option value="ditandatangani" {{ $kontrak->status=='ditandatangani'?'selected':'' }}>Ditandatangani</option>
    </select>
    <br>

    <button type="submit">Update Kontrak</button>
</form>
@endsection
