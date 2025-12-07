@extends('layouts.admin')

@section('title','Daftar Lamaran')

@section('content')
<h3>Daftar Lamaran Pelamar</h3>

@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelamar</th>
            <th>Lowongan</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
            <th>Total Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lamarans as $l)
        <tr>
            <td>{{ $l->id }}</td>
            <td>{{ $l->pelamar->nama }}</td>
            <td>{{ $l->lowongan->posisi }}</td>
            <td>{{ $l->tanggal_daftar }}</td>
            <td>{{ $l->status }}</td>
            <td>{{ $l->total_nilai }}</td>
            <td>
                <a href="{{ route('admin.lamaran.edit', $l->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
