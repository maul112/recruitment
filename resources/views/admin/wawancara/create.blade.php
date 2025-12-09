@extends('layouts.admin')

@section('title','Buat Wawancara')

@section('content')
<div class="w-full">

    <h3 class="text-2xl mb-2">Buat Wawancara Baru</h3>

    <form action="{{ route('admin.wawancara.store') }}" method="POST">
        @csrf
        <label>Lamaran Pelamar:</label>
        <select name="lamaran_id" required>
            @foreach($lamaran as $l)
            <option value="{{ $l->id }}">{{ $l->pelamar->nama_lengkap }} - {{ $l->lowongan->posisi }}</option>
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

        <button class="bg-blue-600 text-white py-2 px-4 rounded-xl" type="submit">Simpan</button>
    </form>

</div>
@endsection
