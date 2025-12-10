@extends('layouts.admin')

@section('title','Kontrak')

@section('content')
<div class="w-full">
    <div class="flex justify-between mb-2">
        <h3 class="text-2xl mb-2">Daftar Kontrak</h3>
        <a class="py-2 px-4 rounded-lg bg-blue-600 text-white transition-all duration-300 hover:shadow-2xl" href="{{ route('admin.kontrak.create') }}">+ Tambah Kontrak</a>
    </div>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th style="padding: 12px;">ID</th>
            <th style="padding: 12px;">Pelamar</th>
            <th style="padding: 12px;">Posisi</th>
            <th style="padding: 12px;">Status</th>
            <th style="padding: 12px;">Aksi</th>
        </tr>
        @foreach($kontrak as $k)
        <tr>
            <td>{{ $k->id }}</td>
            <td>{{ $k->lamaran->pelamar->nama }}</td>
            <td>{{ $k->lamaran->posisi }}</td>
            <td>{{ $k->status }}</td>
            <td>
                <a href="{{ route('admin.kontrak.show', $k->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection
