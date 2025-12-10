@extends('layouts.admin')

@section('title','Wawancara')

@section('content')
<div class="w-full">
    <div class="flex justify-between mb-4">
        <h3 class="text-2xl">Daftar Wawancara</h3>
        <a class="py-2 px-4 rounded-lg bg-blue-600 text-white transition-all duration-300 hover:shadow-2xl" href="{{ route('admin.wawancara.create') }}">+ Buat Wawancara Baru</a>
    </div>
    <div class="table-scroll" style="overflow-x:auto; width:100%;">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th style="padding:12px;">ID</th>
                <th style="padding:12px;">Pelamar</th>
                <th style="padding:12px;">Posisi</th>
                <th style="padding:12px;">Tipe</th>
                <th style="padding:12px;">Jadwal</th>
                <th style="padding:12px;">Nilai</th>
                <th style="padding:12px;">Aksi</th>
            </tr>
            @foreach($wawancara as $w)
            <tr>
                <td style="padding:12px;">{{ $w->id }}</td>
                <td style="padding:12px;">{{ $w->lamaran->pelamar->nama_lengkap }}</td>
                <td style="padding:12px;">{{ $w->lamaran->lowongan->posisi }}</td>
                <td style="padding:12px;">{{ $w->tipe }}</td>
                <td style="padding:12px;">{{ $w->jadwal ?? '-' }}</td>
                <td style="padding:12px;">{{ $w->nilai ?? '-' }}</td>
                <td style="padding:12px;">
                    <a class="btn" href="{{ route('admin.wawancara.show', $w->id) }}">Detail</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
