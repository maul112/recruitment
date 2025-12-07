@extends('layouts.admin')

@section('title','Kontrak')

@section('content')
<h3>Daftar Kontrak</h3>
<a href="{{ route('admin.kontrak.create') }}">Tambah Kontrak</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Pelamar</th>
        <th>Posisi</th>
        <th>Status</th>
        <th>Aksi</th>
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
@endsection
