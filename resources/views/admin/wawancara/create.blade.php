@extends('layouts.admin')

@section('title','Buat Wawancara')

@section('content')
<h3>Buat Wawancara Baru</h3>

<form action="{{ route('admin.wawancara.store') }}" method="POST">
    @csrf
    <label>Lamaran Pelamar:</label>
    <select name="lamaran_id" required>
        @foreach($lamaran as $l)
        <option value="{{ $l->id }}">{{ $l->pelamar->nama }} - {{ $l->posisi }}</option>
        @endforeach
    </select>
    <br>

    <label>Tipe Wawancara:</label>
    <select name="tipe" required>
        <option value="HRD">HRD</option>
        <option value="Kepala Sekolah">Kepala Sekolah</option>
        <option value="Microteaching">Microteaching</option>
    </select>
    <br>

    <label>Jadwal:</label>
    <input type="datetime-local" name="jadwal">
    <br>

    <label>Lokasi:</label>
    <input type="text" name="lokasi">
    <br>

    <button type="submit">Simpan</button>
</form>
@endsection
