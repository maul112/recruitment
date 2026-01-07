@extends('layouts.admin')

@section('title','Wawancara')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;">Daftar Wawancara</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola semua data wawancara yang tersedia
            </p>
        </div>
        <a class="btn text-sm" href="{{ route('admin.wawancara.create') }}">+ Buat Wawancara Baru</a>
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
            @forelse($wawancara as $w)
            <tr>
                <td style="padding:12px;">{{ $w->id }}</td>
                <td style="padding:12px;">{{ $w->lamaran->pelamar->nama_lengkap }}</td>
                <td style="padding:12px;">{{ $w->lamaran->lowongan->posisi }}</td>
                <td style="padding:12px;">{{ $w->tipe }}</td>
                <td style="padding:12px;">{{ $w->jadwal ?? '-' }}</td>
                <td style="padding:12px;">{{ $w->nilai ?? '-' }}</td>
                <td style="padding:12px;">
                    <a class="btn text-sm" href="{{ route('admin.wawancara.show', $w->id) }}">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:45px;">
                    <div class="flex">
                        <div class="flex items-center gap-8 mx-auto">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                            <p style="margin-top:15px; color:#6b7280;">Belum ada data wawancara</p>
                        </div>
                    </div>
                </td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection
