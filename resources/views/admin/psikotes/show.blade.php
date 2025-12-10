@extends('layouts.admin')

@section('title','Detail Psikotes')

@section('content')
<div class="w-full">
    <div class="flex justify-between">
        <div>
            <h3>Detail Psikotes</h3>
        
            {{-- Info Pelamar --}}
            <div style="margin-bottom:20px;">
                <strong>Pelamar:</strong> {{ $psikotes->lamaran->pelamar->nama }} <br>
                <strong>Posisi Lamaran:</strong> {{ $psikotes->lamaran->posisi }} <br>
                <strong>Status Psikotes:</strong> {{ $psikotes->status }} <br>
                <strong>Mulai Tes:</strong> {{ $psikotes->mulai_at ?? '-' }} <br>
                <strong>Selesai Tes:</strong> {{ $psikotes->selesai_at ?? '-' }} <br>
            </div>
        </div>
        <div>
            {{-- Tombol Nilai Otomatis --}}
            @if($psikotes->status=='belum')
            <form action="{{ route('admin.psikotes.nilai',$psikotes->id) }}" method="POST">
                @csrf
                <button class="btn" type="submit">Nilai Otomatis</button>
            </form>
            @endif
        </div>
    </div>


    <hr>

    {{-- Daftar Soal dan Jawaban --}}
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th style="padding: 12px;">No</th>
            <th style="padding: 12px;">Soal</th>
            <th style="padding: 12px;">Jawaban Pelamar</th>
            <th style="padding: 12px;">Kunci Jawaban</th>
            <th style="padding: 12px;">Status</th>
            <th style="padding: 12px;">Nilai</th>
        </tr>
        @foreach($psikotes->jawaban as $index => $j)
        <tr>
            <td style="padding: 12px;">{{ $index+1 }}</td>
            <td style="padding: 12px;">{{ $j->soal->pertanyaan }}</td>
            <td style="padding: 12px;">{{ $j->jawaban ?? '-' }}</td>
            <td style="padding: 12px;">{{ $j->soal->kunci_jawaban }}</td>
            <td style="padding: 12px;">
                @if($j->benar === null)
                    -
                @elseif($j->benar)
                    Benar
                @else
                    Salah
                @endif
            </td>
            <td style="padding: 12px;">{{ $j->nilai ?? '-' }}</td>
        </tr>
        @endforeach
    </table>

    {{-- Hasil Akhir --}}
    <div style="margin-top:20px;">
        <strong>Total Skor Kognitif:</strong> {{ $psikotes->skor_kognitif ?? '-' }} <br>
        <strong>Profil Kepribadian:</strong> {{ $psikotes->profil_kepribadian ?? '-' }} <br>
        <strong>Rekomendasi:</strong> {{ $psikotes->rekomendasi ?? '-' }} <br>
    </div>

</div>
@endsection
