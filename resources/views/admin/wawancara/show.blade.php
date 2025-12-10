@extends('layouts.admin')

@section('title','Detail Wawancara')

@section('content')
<div class="w-full">
    <h3 class="mb-4">Detail Wawancara</h3>
    
    {{-- Info Pelamar --}}
    <div style="margin-bottom:20px;">
        <strong>Pelamar:</strong> {{ $wawancara->lamaran->pelamar->nama_lengkap }} <br>
        <strong>Posisi Lamaran:</strong> {{ $wawancara->lamaran->lowongan->posisi }} <br>
        <strong>Tipe Wawancara:</strong> {{ $wawancara->tipe }} <br>
        <strong>Jadwal:</strong> {{ $wawancara->jadwal ?? '-' }} <br>
        <strong>Lokasi:</strong> {{ $wawancara->lokasi ?? '-' }} <br>
    </div>
    
    <hr>
    
    {{-- Form Penilaian --}}
    <form action="{{ route('admin.wawancara.update', $wawancara->id) }}" method="POST">
        @csrf
        <h4 class="mb-4">Penilaian Wawancara (Skala 10-100)</h4>
        @foreach($aspek as $a)
            <label>{{ $a }}:</label>
            <input class="border rounded-md mb-4 ml-2 p-2" type="number" name="nilai_{{ $a }}" min="10" max="100" value="{{ $wawancara->nilai ?? '' }}" required>
            <br>
        @endforeach
    
        <label>Komentar:</label><br>
        <textarea class="border rounded-md p-2 w-full" name="komentar" rows="4">{{ $wawancara->komentar }}</textarea>
        <br>
        <button class="btn" type="submit">Simpan Penilaian</button>
    </form>
    
    {{-- Hasil Akhir --}}
    @if($wawancara->nilai)
    <div style="margin-top:20px;">
        <strong>Nilai Wawancara:</strong> {{ $wawancara->nilai }} <br>
        <strong>Komentar:</strong> {{ $wawancara->komentar ?? '-' }}
    </div>
    @endif
</div>
@endsection
