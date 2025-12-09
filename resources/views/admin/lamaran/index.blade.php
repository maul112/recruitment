@extends('layouts.admin')

@section('title','Daftar Lamaran')

@section('content')
<div class="w-full">
    <h3 class="mb-2 text-2xl">Daftar Lamaran Pelamar</h3>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <!-- TABLE -->
    <div class="table-scroll" style="overflow-x:auto; width:100%;">
        <table>
            <thead style="background:#f3f4f6; text-align:left;">
                <tr>
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">Pelamar</th>
                    <th style="padding:12px;">Lowongan</th>
                    <th style="padding:12px;">Tanggal Daftar</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Total Nilai</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($lamarans as $l)
                <tr class="row-anim">
                    <td style="padding:12px;"><strong>{{ $l->id }}</strong></td>

                    <td style="padding:12px;">{{ $l->pelamar->nama_lengkap }}</td>

                    <td style="padding:12px;">{{ $l->lowongan->posisi }}</td>

                    <td style="padding:12px;">{{ $l->tanggal_daftar }}</td>

                    <td style="padding:12px;">{{ $l->status }}</td>

                    <td style="padding:12px;">{{ $l->total_nilai }}</td>

                    <td class="actions" style="padding:12px; display:flex; gap:8px; flex-wrap:wrap;">
                        <a class="btn" href="{{ route('admin.lamaran.edit', $l->id) }}">Edit</a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:45px;">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                        <p style="margin-top:15px; color:#6b7280;">Belum ada lowongan yang ditambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
