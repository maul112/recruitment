@extends('layouts.app')

@section('title', 'Ajukan Lamaran')

@section('content')
<div class="content-wrapper">
    <h3>Lamar Posisi: {{ $lowongan->posisi }}</h3>

    <form action="{{ url('/pelamar/lamaran/store') }}" method="POST" enctype="multipart/form-data" class="form-content">
        @csrf
        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">

        <label>CV / Daftar Riwayat Hidup</label>
        <input type="file" name="cv" required>

        <label>Ijazah & Transkrip Nilai</label>
        <input type="file" name="ijazah" required>

        <label>Sertifikat Pendukung (opsional)</label>
        <input type="file" name="sertifikat">

        <label>Pas Foto</label>
        <input type="file" name="foto" required>

        <button type="submit" class="btn">Kirim Lamaran</button>
    </form>
</div>
@endsection
