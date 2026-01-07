@extends('layouts.admin')

@section('title','Detail Wawancara')

@section('content')
<div class="w-full">
    <a class="block border border-gray-300 py-2.5 px-4 rounded-xl mb-4 w-fit" href="{{ route('admin.wawancara.index') }}">&laquo; Kembali</a>
    <h3 class="mb-4">Detail Wawancara</h3>

        @php
            $type = session('success') ? 'success' : (session('error') ? 'error' : null);
            $config = [
                'success' => ['bg' => '#ecfdf5', 'border' => '#34d399', 'color' => '#065f46', 'icon' => '✅'],
                'error'   => ['bg' => '#fef2f2', 'border' => '#f87171', 'color' => '#991b1b', 'icon' => '❌']
            ][$type] ?? null;
        @endphp

        @if($config)
            <div style="
                background:{{ $config['bg'] }};
                border:1px solid {{ $config['border'] }};
                color:{{ $config['color'] }};
                padding:14px 18px;
                border-radius:12px;
                margin-bottom:18px;">
                {{ $config['icon'] }} {{ session('success') ?? session('error') }}
            </div>
        @endif
    
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
        {{-- <h4 class="mb-4">Penilaian Wawancara (Skala 10-100)</h4> --}}
        {{-- @foreach($aspek as $a)
            <label>{{ Str::headline($a) }}:</label>
            <input class="border rounded-md mb-4 ml-2 p-2" type="number" name="nilai_{{ $a }}" min="10" max="100" value="{{ $wawancara['nilai_' . $a] ?? '' }}" required>
            <br>
        @endforeach --}}
        <table class="mb-4">
            <tr>
                <th class="text-center">No</th>
                <th>Aspek yang Dinilai</th>
                <th>Deskripsi</th>
                <th>Skor (10-100)</th>
            </tr>
        @foreach($aspek as $a)
            <tr>
                <td class="p-2 text-center">{{ $loop->iteration }}</td>
                <td class="p-2">{{ Str::headline($a) }}</td>
                <td class="p-2">{{ $deskripsi[$loop->iteration - 1] }}</td>
                {{-- <td class="p-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt, necessitatibus?</td> --}}
                <td class="p-2">
                    <input class="rounded-md mb-4 ml-2 p-2" type="number" name="nilai_{{ $a }}" min="10" max="100" value="{{ $wawancara['nilai_' . $a] ?? '0' }}" required>
                </td>
            </tr>
        @endforeach
        </table>
    
        <label>Komentar:</label><br>
        <textarea class="border border-gray-300 rounded-md p-2 w-full" name="komentar" rows="4">{{ $wawancara->komentar }}</textarea>
        <br>
        <div class="flex gap-4 items-center">
            <a class="block border border-gray-300 py-2.5 px-4 rounded-xl" href="{{ route('admin.wawancara.index') }}">Kembali</a>
            <button class="btn" type="submit">Simpan Penilaian</button>
        </div>
    </form>
    
    {{-- Hasil Akhir --}}
    @if($wawancara->nilai)
    <div style="margin-top:20px;">
        <strong>Nilai Wawancara:</strong> {{ $wawancara->nilai }} (<span>{{ $wawancara->nilai > 75 ? 'Lulus' : 'Tidak Lulus' }}</span>) <br>
        <strong>Komentar:</strong> {{ $wawancara->komentar ?? '-' }}
    </div>
    @endif
</div>
@endsection
