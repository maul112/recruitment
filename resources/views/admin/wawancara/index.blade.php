@extends('layouts.admin')

@section('title','Wawancara')

@section('content')
<h3>Daftar Wawancara</h3>
<a href="{{ route('admin.wawancara.create') }}">Buat Wawancara Baru</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Pelamar</th>
        <th>Posisi</th>
        <th>Tipe</th>
        <th>Jadwal</th>
        <th>Nilai</th>
        <th>Aksi</th>
    </tr>
    @foreach($wawancara as $w)
    <tr>
        <td>{{ $w->id }}</td>
        <td>{{ $w->lamaran->pelamar->nama }}</td>
        <td>{{ $w->lamaran->posisi }}</td>
        <td>{{ $w->tipe }}</td>
        <td>{{ $w->jadwal ?? '-' }}</td>
        <td>{{ $w->nilai ?? '-' }}</td>
        <td>
            <a href="{{ route('admin.wawancara.show', $w->id) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
