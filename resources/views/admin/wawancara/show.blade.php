@extends('layouts.admin')

@section('title','Detail Wawancara')

@section('content')
<h3>Detail Wawancara</h3>

{{-- Info Pelamar --}}
<div style="margin-bottom:20px;">
    <strong>Pelamar:</strong> {{ $wawancara->lamaran->pelamar->nama }} <br>
    <strong>Posisi Lamaran:</strong> {{ $wawancara->lamaran->posisi }} <br>
    <strong>Tipe Wawancara:</strong> {{ $wawancara->tipe }} <br>
    <strong>Jadwal:</strong> {{ $wawancara->jadwal ?? '-' }} <br>
    <strong>Lokasi:</strong> {{ $wawancara->lokasi ?? '-' }} <br>
</div>

<hr>

{{-- Form Penilaian --}}
<form action="{{ route('admin.wawancara.update', $wawancara->id) }}" method="POST">
    @csrf
    <h4>Penilaian Wawancara (Skala 10-100)</h4>
    @foreach($aspek as $a)
        <label>{{ $a }}:</label>
        <input type="number" name="nilai_aspek[{{ $a }}]" min="10" max="100" value="{{ $wawancara->nilai ?? '' }}" required>
        <br>
    @endforeach

    <label>Komentar:</label><br>
    <textarea name="komentar" rows="4">{{ $wawancara->komentar }}</textarea>
    <br>
    <button type="submit">Simpan Penilaian</button>
</form>

{{-- Hasil Akhir --}}
@if($wawancara->nilai)
<div style="margin-top:20px;">
    <strong>Nilai Wawancara:</strong> {{ $wawancara->nilai }} <br>
    <strong>Komentar:</strong> {{ $wawancara->komentar ?? '-' }}
</div>
@endif
@endsection
