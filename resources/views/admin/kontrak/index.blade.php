@extends('layouts.admin')

@section('title','Kontrak')

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 style="font-size:20px; margin-bottom:5px;"">Daftar Kontrak</h3>
            <p style="color:#6b7280; font-size:14px;">
                Kelola semua data kontrak yang tersedia
            </p>
        </div>
        <a class="h-fit btn text-sm" href="{{ route('admin.kontrak.create') }}">+ Tambah Kontrak</a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div style="
            background:#ecfdf5;
            border:1px solid #34d399;
            color:#065f46;
            padding:14px 18px;
            border-radius:12px;
            margin-bottom:18px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Pelamar</th>
            <th class="p-3">Posisi</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
        </tr>
        @forelse($kontrak as $k)
        <tr>
            <td class="p-3">{{ $k->id }}</td>
            <td class="p-3">{{ $k->lamaran->pelamar->nama_lengkap }}</td>
            <td class="p-3">{{ $k->lamaran->lowongan->posisi }}</td>
            <td class="p-3">{{ $k->status }}</td>
            <td class="p-3">
                <a class="btn text-sm" href="{{ route('admin.kontrak.show', $k->id) }}">Detail</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; padding:45px;">
                <div class="flex">
                            <div class="flex items-center gap-8 mx-auto">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                                <p style="margin-top:15px; color:#6b7280;">Belum ada data kontrak</p>
                            </div>
                        </div>
            </td>
        </tr>
        @endforelse
    </table>

</div>
@endsection
