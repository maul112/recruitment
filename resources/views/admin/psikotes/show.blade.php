@extends('layouts.admin')

@section('title','Detail Psikotes')

@section('content')
<h3>Detail Psikotes</h3>

{{-- Info Pelamar --}}
<div style="margin-bottom:20px;">
    <strong>Pelamar:</strong> {{ $psikotes->lamaran->pelamar->nama }} <br>
    <strong>Posisi Lamaran:</strong> {{ $psikotes->lamaran->posisi }} <br>
    <strong>Status Psikotes:</strong> {{ $psikotes->status }} <br>
    <strong>Mulai Tes:</strong> {{ $psikotes->mulai_at ?? '-' }} <br>
    <strong>Selesai Tes:</strong> {{ $psikotes->selesai_at ?? '-' }} <br>
</div>

{{-- Tombol Nilai Otomatis --}}
@if($psikotes->status=='belum')
<form action="{{ route('admin.psikotes.nilai',$psikotes->id) }}" method="POST">
    @csrf
    <button type="submit">Nilai Otomatis</button>
</form>
@endif

<hr>

{{-- Daftar Soal dan Jawaban --}}
<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Soal</th>
        <th>Jawaban Pelamar</th>
        <th>Kunci Jawaban</th>
        <th>Status</th>
        <th>Nilai</th>
    </tr>
    @foreach($psikotes->jawaban as $index => $j)
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $j->soal->pertanyaan }}</td>
        <td>{{ $j->jawaban ?? '-' }}</td>
        <td>{{ $j->soal->kunci_jawaban }}</td>
        <td>
            @if($j->benar === null)
                -
            @elseif($j->benar)
                Benar
            @else
                Salah
            @endif
        </td>
        <td>{{ $j->nilai ?? '-' }}</td>
    </tr>
    @endforeach
</table>

{{-- Hasil Akhir --}}
<div style="margin-top:20px;">
    <strong>Total Skor Kognitif:</strong> {{ $psikotes->skor_kognitif ?? '-' }} <br>
    <strong>Profil Kepribadian:</strong> {{ $psikotes->profil_kepribadian ?? '-' }} <br>
    <strong>Rekomendasi:</strong> {{ $psikotes->rekomendasi ?? '-' }} <br>
</div>
@endsection
