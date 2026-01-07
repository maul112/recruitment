@extends('layouts.admin')

@section('title','Daftar Lamaran')

@section('content')
<div class="w-full">
    <div style="margin-bottom:18px;">
        <h3 style="font-size:20px; margin-bottom:5px;">Daftar Lamaran Pelamar</h3>
        <p style="color:#6b7280; font-size:14px;">
            Kelola semua data lamaran pelamar yang tersedia
        </p>
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
                        <a class="btn text-sm" href="{{ route('admin.lamaran.edit', $l->id) }}">Edit</a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:45px;">
                        <div class="flex">
                            <div class="flex items-center gap-8 mx-auto">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80">
                                <p style="margin-top:15px; color:#6b7280;">Belum ada lowongan yang ditambahkan</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
